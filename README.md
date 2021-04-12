1) clone from https://github.com/ozznest/dz
2) run "make:build"
3) run "make:up"
4) go to container with project: make exec SERVICE=dz_back_dz_1
5) run composer:install    
6) run script for perform task: php bin/console app:parse input.csv
7) run unit test: php bin/phpunit
