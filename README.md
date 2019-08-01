# Octo

A composer package to simple use music service API.


![Travis (.org)](https://img.shields.io/travis/teakowa/octo?style=flat-square)
[![StyleCI](https://github.styleci.io/repos/199823129/shield?branch=master)](https://github.styleci.io/repos/199823129)
![PHP from Packagist](https://img.shields.io/packagist/php-v/teakowa/octo?style=flat-square)
[![Packagist Version](https://img.shields.io/packagist/v/teakowa/octo?style=flat-square)](https://packagist.org/packages/teakowa/octo)
[![LICENSE](https://img.shields.io/badge/License-Anti%20996-blue.svg?style=flat-square)](https://github.com/996icu/996.ICU/blob/master/LICENSE)
[![LICENSE](https://img.shields.io/badge/License-Apache--2.0-green.svg?style=flat-square)](https://www.apache.org/licenses/LICENSE-2.0)
[![996.icu](https://img.shields.io/badge/Link-996.icu-red.svg?style=flat-square)](https://996.icu)


## Installation

```sh
composer require teakowa/octo
```

## Usage

```php
$headers = new Teakowa\Octo\Adapter\Headers();
$adapter = new Teakowa\Octo\Adapter\Guzzle($headers);
$kugou   = new Teakowa\Octo\Provider\Kugou($adapter);
    
echo $kugou->artist()->list();
```

## LICENSE
The code in this repository, unless otherwise noted, is under the terms of both the [Anti 996](https://github.com/996icu/996.ICU/blob/master/LICENSE) License and the [Apache License (Version 2.0)](https://www.apache.org/licenses/LICENSE-2.0).