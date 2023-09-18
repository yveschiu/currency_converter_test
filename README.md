# About this repo

API Implementation Test

# See
- app/Services/CurrencyConvertService.php
- app/Http/Controllers/CurrencyConverterController.php
- tests/Feature/CurrencyConvertTest.php
- routes/api.php
- app/Http/Requests/CurrencyConvertRequest.php

# Environment
- php version: 8.2

This project uses `sail` to build up the development environment. If you do not have `php@8.2` on your machine and do not want to mess up your environment, you can have `docker` installed, run, and just execute  `./vendor/bin/sail up -d` in the project root in terminal to boot up the development environment.

As the development environment is up, to test, type:
- `./vendor/bin/sail artisan test`

To shutdown the development environment, type:
- `./vendor/bin/sail down`

To test this api manually, try:
- `curl --request GET 'http://localhost/api/convert?source=USD&target=TWD&amount=$100'
--header 'Accept: application/json'`
- Or open `http://localhost/api/convert?source=USD&target=TWD&amount=$100` on a webbrowser.
