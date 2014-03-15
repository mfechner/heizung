# Heating visualization of a Waterkotte WPCU.C

### Whats new?

* First public version

## Introduction
Heating visualization is a tool that read/write values from a Waterkotte heating with a WPCU.C attached.
Values are visualized on a webpage and some values can even be changed from the website.

For details and screenshot see the website: http://fechner.net/content/visualisierung-einer-waterkotte-w%C3%A4rmepumpe-mit-ein-wpcuc-regelung

### Technology
Values are stored in a mysql database, even if you write values to the heating.

The webinterface is based on ZendFramework2, jQuery, PHP and Doctrine2.
The backend is written in C and Perl and is using libmodbus.

### Installation
Clone the repository using git.

## Setup the database
Create a new mysql database using phpmyadmin or the console. Replace the string to your liking:
mysql -u root -p
type your password

mysql> create database _heatingdb_;
Query OK, 1 row affected (0.00 sec)

mysql> grant all privileges on _heatingdb_.* to '_heatinguser_'@'localhost' identified by '_password_';
Query OK, 0 rows affected (0.02 sec)

mysql> quit

Now test if you can login:
mysql -u _heatinguser_ -p _heatingdb_
type your password

If you get a mysql prompt you are fine, if not you did something wrong the the create of database or user.
mysql> quit

To create the database structure execute:
mysql -u _heatinguser_ -p _heatingdb_ <db.sql
type youe password

## Setup the configfiles
Copy the file bin/config.dist to bin/config and edit it according your database settings.

Copy the file frontend/config/autoload/doctrine.local.php.dist to frontend/config/autoload/doctrine.local.php and edit it according your database settings.

## Compile backend
Make sure you install the libmodbus from: http://libmodbus.org/
I tested it with version 3.0.5. Just extract it, do a ./configure then make then make install.
On MacOSX I had the problem that the libmodbus.pc was installed in a wrong location. You can correct the with a symlink:
ln -s /usr/local/lib/pkgconfig/libmodbus.pc /opt/local/lib/pkgconfig/

Now got to the directory lib/ and execute:
make

Now go to the directory src/ and execute:
make

If everything is fine, you have now two executeable files readModbus and writeModbus.
To make sure everything is fine just execute
./readModbus -h

and you should see a help screen.

To make sure everything is fine you can execute in the folder bin:
$ ./WPgetVal.pl OutdoorTemp
./readModbus -f3 -a433 -s2 -t1
T outdoor = 8.244680&deg;C

If you get an error message like:
Cannot execute ./readModbus -f3 -a433 -s2 -t1

Make sure, the serial device is correct, permission are correct and you are connected to you heating currectly.
Also make sure if you have the MOXA serial LAN converter that the driver is installed correctly.
Maybe you have to enable the modbus protocol on your heating (mine had it enabled by default).

## Edit crontab to get heating read and written automatically
Just edit the file /etc/crontab and add the line:
*/1 * * * *     idefix  cd /home/idefix/heizung/bin/ && ./WPsetAllValues.pl; ./WPgetAllValues.pl

You maybe have to adapt the user and the path to the application. You must not run the application as root, but make sure that the user has access to the serial interface.
As I use a serial to LAN converter MOXA @TODO add specific type here.

Now the process should write every minutes a record into the database keeping all information.

## Setup the frontend
Go to folder frontend. Now we have to install all libraries why require, at first we installed composer.phar:
curl -sS https://getcomposer.org/installer | php
./composer.phar update

You should see now that some applications are installed in the frontend folder.

Now we have to configure apache to make the site visible.
On my local environment the URI would be: http://knx/heating

So we configure apache:
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

You have to adapt to path.
Restart apache and point your browser to:
http://_yourhostname_/heating

And you should see your heating on a web page.

Have fun.

