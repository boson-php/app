<a href="https://github.com/boson-php/boson">
    <img align="center" src="https://habrastorage.org/webt/-8/h1/5o/-8h15o6klbga13kzsltqqmk8jlm.png" />
</a>

---

## Installation

Boson package is available as Composer repository and can 
be installed using the following command in a root of your project:

```bash
composer create-project boson-php/app my-project --stability=dev --prefer-dist
```

After installation, navigate to your project directory and run the application:

```bash
cd my-project
php index.php
```

The desktop application will open.

Note that BosonPHP is a tool for creating desktop applications, so you don't need a web server or browser - just run the PHP script directly from the console.

## Compilation

Once you've finished developing your application, you can compile it into a native executable:

```bash
composer compile
```

The compiled executable will be available in the `build/` directory for your platform. You can configure which platforms to compile for in the `boson.json` file.

## Links

- [BosonPHP repository](https://github.com/boson-php/boson).
- [Documentation](https://bosonphp.com/doc).

## Community

- Any questions left? You can ask them 
  [in the chat `t.me/boson_php`](https://t.me/boson_php)!

## Contributing

Boson is an Open Source, [community-driven project](https://github.com/boson-php/boson/graphs/contributors). 
Join them [contributing code](https://bosonphp.com/contribution.html).

