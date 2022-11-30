![banner](.github/assets/banner.png?raw=true)

Laravel Assets management
============
A highly opinionated assets management library for the Laravel framework.

Requirements
============

To be able to use this package you need to meet the following minimum requirements:
1. Laravel framework >= v9
2. PHP >= v8

## Installation

```bash
composer require simtabi/laravel-assets
```

For version <= 5.4:

Add to section `providers` of `config/app.php`:

```php
// config/app.php
'providers' => [
    ...
    Simtabi\Assets\Providers\AssetsServiceProvider::class,
];
```

And add to the `aliases` section:

```php
// config/app.php
'aliases' => [
    ...
    'Assets' => Simtabi\Assets\Facades\AssetsFacade::class,
];
```

All assets resource will be manage in config file, so we need to publish config to use.

```bash
php artisan vendor:publish --provider="Simtabi\Assets\Providers\AssetsServiceProvider" --tag=config
```

Add to your master layout view, in `head` tag:

```php
{!! \Assets::renderHeader() !!}
```

and before `body` tag close:

```php
{!! \Assets::renderFooter() !!}
```

## Methods

### Add scripts

```php
\Assets::addScripts(['key-of-assets-in-config-file']);
```

Example:

```php
\Assets::addScripts(['app', 'bootstrap', 'jquery']);
```

### Add styles

```php
\Assets::addStyles(['key-of-assets-in-config-file']);
```

Example:

```php
\Assets::addStyles(['bootstrap', 'font-awesome']);
```

### Remove scripts

```php
\Assets::removeScripts(['key-of-assets-in-config-file']);
```

Example:

```php
\Assets::removeScripts(['bootstrap']);
```

### Remove styles

```php
\Assets::removeStyles(['key-of-assets-in-config-file']);
```

Example:

```php
\Assets::removeStyles(['font-awesome']);
```

### Others

- Set version for assets. Add to `.env`

```bash
ASSETS_VERSION=1.0
```

Then all assets will be added `?v=1.0`

- Change to online mode

```bash
ASSETS_OFFLINE=false
```

Then assets will be loaded from CDN if it's defined in config file.

- To disable versioning:

```bash
ASSETS_ENABLE_VERSION=false
```

## Contributors

- [Imani Manyara](https://github.com/imanimanyara)
- [Easter Mukora](https://github.com/eastermukora)

## License
[MIT](LICENSE) © Simtabi LLC
