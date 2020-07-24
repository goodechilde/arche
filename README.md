# APIScaffold For Laravel

Built based on the great Cray package https://github.com/JunaidQadirB/cray

## Installation

```bash
composer require goodechilde/arche --dev
```

Then publish the stubs

```bash
php artisan vendor:publish --tag=arche
```

It will generate `stubs` to `resources/vendor/arche/stubs` directory.



## Usage

```bash
php artisan arche Post
```

Once done, it will show you the details of the files generated.

```bash
Factory created successfully in /database/factories/PostFactory.php
Created Migration: 2020_03_14_151409_create_posts_table
Model created successfully in /app/Post.php
Controller created successfully in /app/Http/Controllers/PostController.php
Request created successfully in /app/Http/Requests/PostStoreRequest.php
Request created successfully in /app/Http/Requests/PostUpdateRequest.php
```

Now add the necessary fields and run

```bash
php artisan migrate
```
### Changelog


## Credits

- [Junaid Qadir](https://github.com/junaidqadirb) - This is 100% based on his awesome package Cray
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
