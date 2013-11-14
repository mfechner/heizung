./vendor/bin/doctrine-module orm:convert-mapping --namespace="Heating\\Entity\\" --force --from-database annotation ./module/Heating/src/

./vendor/doctrine/doctrine-module/bin/doctrine-module orm:generate-entities ./module/Heating/src/ --generate-annotations=true
