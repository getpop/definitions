# Definitions

[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Software License][ico-license]](LICENSE.md)

<!--
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Total Downloads][ico-downloads]][link-downloads]
-->

Enables to define a name for an element (such as modules, resources, etc) through different strategies

## Install

Via Composer

``` bash
composer require getpop/definitions
```

## Usage

Initialize the component:

``` php
\PoP\Root\ComponentLoader::initializeComponents([
    \PoP\Definitions\Component::class,
]);
```

## PHP versions

Allowed PHP code:

- PHP 7.2
- Typed properties from PHP 7.4

The code can be downgraded from PHP 7.4 to PHP 7.2 to run in production:

| | Development | Production |
| --- | --- | --- |
| **Min PHP version** | 7.4 | 7.2 (After removing typed properties) |

### Downgrading PHP code

Dry run to downgrade the code, via [Rector](https://github.com/rectorphp/rector):

```bash
composer downgrade-code
```

## Standards

[PSR-1](https://www.php-fig.org/psr/psr-1), [PSR-4](https://www.php-fig.org/psr/psr-4) and [PSR-12](https://www.php-fig.org/psr/psr-12).

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
composer test
```

## Static Analysis

Execute [phpstan](https://github.com/phpstan/phpstan) with level 8:

``` bash
composer analyse
```

To run checks for level 0 (or any level from 0 to 8):

``` bash
./vendor/bin/phpstan analyse -l 0 src tests
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email leo@getpop.org instead of using the issue tracker.

## Credits

- [Leonardo Losoviz][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/getpop/definitions.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/getpop/definitions/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/getpop/definitions.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/getpop/definitions.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/getpop/definitions.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/getpop/definitions
[link-travis]: https://travis-ci.org/getpop/definitions
[link-scrutinizer]: https://scrutinizer-ci.com/g/getpop/definitions/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/getpop/definitions
[link-downloads]: https://packagist.org/packages/getpop/definitions
[link-author]: https://github.com/leoloso
[link-contributors]: ../../contributors
