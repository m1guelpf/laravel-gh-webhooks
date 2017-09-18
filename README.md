# Laravel GitHub Webhooks

[![Latest Version on Packagist](https://img.shields.io/packagist/v/m1guelpf/github-webhooks.svg?style=flat-square)](https://packagist.org/packages/m1guelpf/github-webhooks)
[![Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/m1guelpf/github-webhooks.svg?style=flat-square)](https://packagist.org/packages/m1guelpf/github-webhooks)

Easy-to-use class to transform GitHub Webhooks to Laravel Events.

## Installation

You can install the package via composer using this command:

``` bash
composer require m1guelpf/github-webhooks
```

## Usage

``` php
use GHWebhooks;

public function handleWebhook()
{
  return GHWebhooks::handle();
}
```

## Contributing

Read our [CONTRIBUTING.md](CONTRIBUTING.md) for more details on how to help us.

## Security

If you find any security related issues, please send an email to soy@miguelpiedrafita.com instead of using the issue tracker.

## Credits

- [Miguel Piedrafita](https://github.com/m1guelpf)
- [All Contributors](../../contributors)

## License

This package is licensed under the MIT License. Please see [LICENSE.md](LICENSE.md) for more information.
