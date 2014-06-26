# Heating visualization of a Waterkotte WPCU.C

## Whats new?

* First public version

## Introduction
Heating visualization is a tool that read/write values from a Waterkotte heating with a WPCU.C attached.
Values are visualized on a webpage and some values can even be changed from the website.

For details and screenshot see the website: http://fechner.net/content/visualisierung-einer-waterkotte-w%C3%A4rmepumpe-mit-ein-wpcuc-regelung

## Technology
Values are stored in a mysql database, even if you write values to the heating.

The webinterface is based on ZendFramework2, jQuery, PHP and Doctrine2.
The backend is written in C and Perl and is using libmodbus.

## Required Hardware
* Waterkotte (in may case a DS010312AI) with WPCU.C controller
* Moxa NPort 5110A (to get the RS232 port from the heating to LAN)
* Linux/Unix/FreeBSD machine with compiler, apache, mysql, php

## Configuration of Moxa NPort 5110A
I had to upgrade the firmware to version 1.1 Build 11080114.
Serial Settings:
````
Port alias: heizung
Baud rate: 9600
Data bits: 8
Stop bits: 1
Parity: None
Flow control: DTR/DSR
FIFO: enable
Interface: RS-232
````
Operating Settings:
````
Operation mode: RealCOM
TCP alive check time: 1
Max connection: 4
Ignore jammed IP: No
Allow driver control: Yes
Packing length: 0
Delimiter 1: 00 (enabled not checked)
Delimiter 2: 00 (enabled not checked)
Delimeter process: Do Nothing
Force transmit: 0
````

Accessible IP Settings:
Put your IP range in here, e.g. for rule 1:
````
Activate the rule: Checked
IP Address: 192.168.0.0
Netmask: 255.255.255.0
````
If you have more networks you would like to access the serial port, add them on the following numbers.

## Moxa Driver Installation
For the driver I had to ask on Moxa directly to get a current beta driver that fixed my problems. I use the file npreal2_1.18.1_Build_12051018.tgz. I added it to the repository to have everything you require together.
To install follow the manual I did something like (it is to long ago to remember everything):
````
cd moxa-driver
tar xzvf npreal2_1.18_Build_12020919.tgz  -C /
cd /tmp/moxa
/tmp/moxa/mxinst
... maybe more steps to configure the IP address of your moxa device ...
````
To load the driver manually, I had to add on my gentoo linux in the file /etc/conf.d/local.start the lines:
````
modprobe npreal2 ttymajor=33 calloutmajor=38 verbose=0
/usr/lib/npreal2/driver/mxloadsvr
````
If the driver is loaded you should see a new device:
````
ls -las /dev/ttyr00
````
If you can see the device the driver should be fine and you can continue.

## Required Libraries
Make sure the perl library Config::General is installed.
On gentoo:
````
emerge -av dev-perl/config-general
````

## Installation
Clone the repository using git.

### Setup the database
Create a new mysql database using phpmyadmin or the console. Replace the string to your liking:
```
mysql -u root -p
type your password
```
```
mysql> create database _heatingdb_;
Query OK, 1 row affected (0.00 sec)

mysql> grant all privileges on _heatingdb_.* to '_heatinguser_'@'localhost' identified by '_password_';
Query OK, 0 rows affected (0.02 sec)

mysql> quit
```

Now test if you can login:
```
mysql -u _heatinguser_ -p _heatingdb_
type your password
```

If you get a mysql prompt you are fine, if not you did something wrong the the create of database or user.
```
mysql> quit
```

To create the database structure execute:
```
mysql -u _heatinguser_ -p _heatingdb_ <db.sql
type yout password
```

### Setup the configfiles
Copy the file bin/config.dist to bin/config and edit it according your database settings.

Copy the file frontend/config/autoload/doctrine.local.php.dist to frontend/config/autoload/doctrine.local.php and edit it according your database settings.

### Compile backend
Make sure you install the libmodbus from: http://libmodbus.org/
I tested it with version 3.0.5. Just extract it, do a ./configure then make then make install.
On MacOSX I had the problem that the libmodbus.pc was installed in a wrong location. You can correct the with a symlink:
```
ln -s /usr/local/lib/pkgconfig/libmodbus.pc /opt/local/lib/pkgconfig/
```

Now type in the main root directory of the application:
```
make
```

That will install the two required files readModbus and writeModbus into the folder bin/.
To make sure everything is fine just execute
```
cd bin
./readModbus -h
```

and you should see a help screen.

To make sure everything is fine you can execute in the folder bin:
```
$ ./WPgetVal.pl OutdoorTemp
./readModbus -f3 -a433 -s2 -t1
T outdoor = 8.244680&deg;C
```

If you get an error message like:
```
Cannot execute ./readModbus -f3 -a433 -s2 -t1
```

Make sure, the serial device is correct, permission are correct and you are connected to you heating currectly.
Also make sure if you have the MOXA serial LAN converter that the driver is installed correctly.
Maybe you have to enable the modbus protocol on your heating (mine had it enabled by default).

### Edit crontab to get heating read and written automatically
Just edit the file /etc/crontab and add the line:
```
*/1 * * * *     idefix  cd /home/idefix/heizung/bin/ && ./WPsetAllValues.pl; ./WPgetAllValues.pl
```

You maybe have to adapt the user and the path to the application. You must not run the application as root, but make sure that the user has access to the serial interface.
As I use a serial to LAN converter MOXA @TODO add specific type here.

Now the process should write every minutes a record into the database keeping all information.

### Setup the frontend
Go to folder frontend. Now we have to install all libraries why require, at first we installed composer.phar:
```
curl -sS https://getcomposer.org/installer | php
./composer.phar update
```

You should see now that some applications are installed in the frontend folder.

Now we have to configure apache to make the site visible.
On my local environment the URI would be: http://knx/heating

So we configure apache:
```
DocumentRoot "/home/idefix/heizung/frontend/public"

SetEnv APPLICATION_ENV "development"
# This should be changed to whatever you set DocumentRoot to.
<Directory "/home/idefix/heizung/frontend/public">
        # Possible values for the Options directive are "None", "All",
        # or any combination of:
        #   Indexes Includes FollowSymLinks SymLinksifOwnerMatch ExecCGI MultiViews
        #
        # Note that "MultiViews" must be named *explicitly* --- "Options All"
        # doesn't give it to you.
        #
        # The Options directive is both complicated and important.  Please see
        # http://httpd.apache.org/docs/2.2/mod/core.html#options
        # for more information.
        Options Indexes FollowSymLinks

        # AllowOverride controls what directives may be placed in .htaccess files.
        # It can be "All", "None", or any combination of the keywords:
        #   Options FileInfo AuthConfig Limit
        AllowOverride All

        # Controls who can get stuff from this server.
        Order allow,deny
        Allow from all
</Directory>

Alias /phpmyadmin /var/www/localhost/htdocs/phpmyadmin
<Directory "/var/www/localhost/htdocs/phpmyadmin">
        Options Indexes FollowSymLinks
        AllowOverride All
        Order allow,deny
        Allow from all
</Directory>
```

You have to adapt to path.
Restart apache and point your browser to:
http://_yourhostname_/heating

And you should see your heating on a web page.

Have fun.
Matthias Fechner <idefix at fechner.net>

