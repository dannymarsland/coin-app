# coin-app
For a live demo please visit : http://coin-app.elasticbeanstalk.com/

This app was written using the Hamlet Php Framework https://github.com/vasily-kartashov/hamlet-core

## Files of note

The main files are

- src/Application/Controller/RootController.php - routing the incoming request
- src/Application/Entity/HomePageEntity.php - preparing data for template
- src/Application/Entity/templates/home-page.tpl - template file
- src/Application/Service/* - all the service files and related classes
- test/Application/Service/* - test files

- public/static/js/app.ts - TypeScript file ( frontend logic )
- public/static/js/app.js - Javascript file produced from TypeScript file. ( TypeScript pretty much maps 1 -> 1 to Javascript )

## Run the application

```
$ vagrant up
```
Take your browser to http://192.168.66.170

Please note, sometimes apache does not start correctly on vagrant, if so please ssh into the vagrant box and restart apache

## Run tests

Run from vagrant to ensure correct php environment

```
$ sh run.sh test
```

## Frontend development

Please note, for speed of development no task runners have been used on this project - files are edited directly from where they are served.

## Issues

The task took longer than the allocated 3 hours. This was mainly to do with file encoding and character encoding problems with the '£' symbol, and oversight of accuracy issues when dealing with floats: http://php.net/manual/en/language.types.float.php . In hindsight dealing with floats may not have been the best choice. Originally it was chosen to do so to keep validity of the CurrencyValue object - with the value being the correct value for the currency code provided, and not a value of a lower currency unit - eg pence to GBP.

