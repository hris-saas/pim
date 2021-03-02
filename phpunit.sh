#!/usr/bin/env sh

export XDEBUG_MODE=coverage
./vendor/bin/phpunit -c phpunit.xml
./vendor/bin/php-coverage-badger build/logs/clover.xml coverage.svg
