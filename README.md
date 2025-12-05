<a href="https://github.com/boson-php/boson">
    <img align="center" src="https://habrastorage.org/webt/-8/h1/5o/-8h15o6klbga13kzsltqqmk8jlm.png" />
</a>

---

## Installation

Boson package is available as Composer repository and can 
be installed using the following command in a root of your project:

```bash
composer create-project boson-php/app boson --prefer-dist
```

After installation, navigate to your project directory and run the application:

```bash
php index.php
```

The desktop application will open.

<div align="center">

| <img src="https://habrastorage.org/webt/6z/uy/7n/6zuy7nzopxkjq83nnmlpafhiupq.png" /> | <img src="https://habrastorage.org/webt/jb/39/la/jb39laksyaksq4nhrhazchuw33o.png" /> | <img src="https://habrastorage.org/webt/y8/6f/hz/y86fhz4e1vwv0rx2wnlwcfmprmo.png" /> |
|:------------------------------------------------------------------------------------:|:------------------------------------------------------------------------------------:|:------------------------------------------------------------------------------------:|
|                                        Linux                                         |                                        macOS                                         |                                       Windows                                        |

</div>

Note that BosonPHP is a tool for creating desktop applications, 
so you don't need a web server or browser - just run the PHP 
script directly from the console.

## Compilation

Once you've finished developing your application, you can 
compile it into a native executable:

```bash
php vendor/bin/boson compile
```

The compiled executable will be available in the `build/` directory
for your platform. You can configure which platforms to compile
for in the `boson.json` file.

## Other Commands

**Tests**

```bash
composer test:unit
composer test:feature
composer test:integration

# or all tests:
composer test
```

**Code Analyse**

```bash
composer linter
```

**Code Style Analyse**

```bash
composer phpcs:fix

# or check only:
composer phpcs:check
```

## Links

- [Boson repository](https://github.com/boson-php/boson).
- [Documentation](https://bosonphp.com/doc).

## Community

- Any questions left? You can ask them 
  [in the chat `t.me/boson_php`](https://t.me/boson_php)!

## Contributing

Boson is an Open Source, [community-driven project](https://github.com/boson-php/boson/graphs/contributors). 
Join them [contributing code](https://bosonphp.com/contribution.html).

