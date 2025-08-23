# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a **BosonPHP** application - a PHP framework for building cross-platform native desktop applications. BosonPHP allows you to create native Windows, Linux, and macOS applications using PHP, with a webview-based UI system.

## Key Commands

### Development
- `composer install` - Install PHP dependencies
- `php index.php` - Run the desktop application directly (no web server or browser needed)
- `composer compile` - Compile the application (runs `php vendor/bin/boson init` then `php vendor/bin/boson compile`)
- `php vendor/bin/boson init` - Initialize Boson configuration
- `php vendor/bin/boson compile` - Compile the application for distribution
- `vendor/bin/phpunit` - Run tests (PHPUnit is installed in require-dev)

### Running the Application
BosonPHP is a desktop application framework - run `php index.php` from the console to launch the native desktop application. No web server or browser is required.

### Compilation
After development, use `composer compile` to create native executables in the `build/` directory. Target platforms and architectures can be configured in `boson.json`.

### Project Structure
- `index.php` - Application entry point
- `boson.json` - Boson application configuration (platforms, architecture, build settings)
- `src/` - Application source code with PSR-4 autoloading under `App\` namespace
- `src/Components/` - WebComponent classes for UI components
- `public/` - Static assets (CSS, images) served via the static provider
- `tests/` - Test files (PSR-4 autoloaded under `Tests\` namespace)
- `build/` - Compiled application output directory
- `vendor/` - Composer dependencies

## Architecture

### Application Structure
The application follows a component-based architecture:

1. **Main Application** (`index.php`):
   - Creates a Boson Application instance with scheme handling
   - Sets up static file serving from the `public/` directory  
   - Registers WebComponents for the UI
   - Configures window properties (title, size)
   - Defines the HTML template with custom component tags

2. **WebComponents** (`src/Components/`):
   - Extend `Boson\WebView\Api\WebComponents\WebComponent`
   - Implement `render()` method returning HTML strings
   - Used as custom HTML tags in the main application template

3. **Static Assets**:
   - Served via `FilesystemStaticProvider` from the `public/` directory
   - Referenced in HTML using `static://localhost/` scheme URLs

### Key Dependencies
- `boson-php/runtime` - Core BosonPHP runtime
- `boson-php/http-static-provider` - Static file serving
- `boson-php/compiler` - Development compilation tools
- `phpunit/phpunit` - Testing framework

### Configuration
- `boson.json` defines target platforms (Windows, Linux, macOS), architectures (amd64, aarch64), and build settings
- Entry point is `index.php`
- Build output goes to `./build` directory
- Includes PHP memory limit and file finder configurations

## Common Issues

### PHP Extensions
- **FFI extension required**: BosonPHP requires the PHP FFI (Foreign Function Interface) extension to be enabled. Add `extension=ffi` to your php.ini file if not already enabled.

### SSL/TLS Certificates
- **cURL certificate issues**: If you encounter SSL certificate errors when making HTTP requests, you may need to configure cURL certificates. See the official cURL documentation for SSL certificates: https://curl.se/docs/sslcerts.html