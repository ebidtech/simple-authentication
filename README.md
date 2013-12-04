# Simple Authentication #

A simple authentication library using a key and secret

[![Latest Stable Version](https://poser.pugx.org/ebidtech/simple-authentication/v/stable.png)](https://packagist.org/packages/ebidtech/simple-authentication) [![Build Status](https://travis-ci.org/ebidtech/simple-authentication.png?branch=v0.2.4)](https://travis-ci.org/ebidtech/simple-authentication) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/ebidtech/simple-authentication/badges/quality-score.png?s=f145cac9cf41aff7dfde44a276ab7b03e92c4981)](https://scrutinizer-ci.com/g/ebidtech/simple-authentication/) [![Dependency Status](https://www.versioneye.com/user/projects/529f55ab632bac8452000002/badge.png)](https://www.versioneye.com/user/projects/529f55ab632bac8452000002)

## Requirements ##

* PHP >= 5.4

## Installation ##

The recommended way to install is through composer.

Just create a `composer.json` file for your project:

``` json
{
    "require": {
        "ebidtech/simple-authentication": "@stable"
    }
}
```

**Tip:** browse [`ebidtech/simple-authentication`](https://packagist.org/packages/ebidtech/simple-authentication) page to choose a stable version to use, avoid the `@stable` meta constraint.

And run these two commands to install it:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ composer install
```

Now you can add the autoloader, and you will have access to the library:

```php
<?php

require 'vendor/autoload.php';
```

## Usage ##

## Contributing ##

See CONTRIBUTING file.

## Credits ##

* Ebidtech developer team, compress Lead developer [Eduardo Oliveira](https://github.com/entering) (eduardo.oliveira@ebidtech.com).
* [All contributors](https://github.com/ebidtech/simple-authentication/contributors)

## License ##

Compress library is released under the MIT License. See the bundled LICENSE file for details.

