<?php

declare(strict_types=1);

use App\FrontController;
use Boson\Application;
use Boson\ApplicationCreateInfo;
use Boson\Component\Http\Static\FilesystemStaticProvider;
use Boson\WebView\Api\Schemes\Event\SchemeRequestReceived;
use Boson\WebView\Api\WebComponents\WebComponentsExtension;
use Boson\WebView\WebViewCreateInfo;
use Boson\Window\WindowCreateInfo;
use Boson\Window\WindowDecoration;

require __DIR__ . '/vendor/autoload.php';


/**
 * -----------------------------------------------------------------------------
 *   Boson Application
 * -----------------------------------------------------------------------------
 *
 * Creates a new Boson Application.
 *
 * Don't be afraid to modify the configuration!
 *
 */

$app = new Application(new ApplicationCreateInfo(
    /**
     * @link https://bosonphp.com/doc/master/schemes-api#registration
     */
    schemes: [ 'boson' ],
    /**
     * @link https://bosonphp.com/doc/master/application-configuration#debug-mode
     */
    debug: (bool) filter_var(getenv('BOSON_DEBUG'), \FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
    /**
     * @link https://bosonphp.com/doc/master/window-configuration
     */
    window: new WindowCreateInfo(
        /**
         * @link https://bosonphp.com/doc/master/window-configuration#window-size-width-and-height
         */
        width: 800,
        /**
         * @link https://bosonphp.com/doc/master/window-configuration#window-size-width-and-height
         */
        height: 600,
        /**
         * @link https://bosonphp.com/doc/master/window-configuration#window-decorations
         */
        decoration: WindowDecoration::DarkMode,
        webview: new WebViewCreateInfo(
            devTools: false,
            extensions: [
                /**
                 * Load default webview extensions.
                 */
                ...WebViewCreateInfo::DEFAULT_WEBVIEW_EXTENSIONS,
                /**
                 * Extend by the `WebComponentsExtensionProvider` from
                 * "boson-php/webview-ext-web-components" dependency.
                 */
                new WebComponentsExtension(),
            ],
        ),
    ),
));



/**
 * -----------------------------------------------------------------------------
 *   Add WebView Components
 * -----------------------------------------------------------------------------
 *
 * Adds support for the specified custom tags.
 *
 * @link https://bosonphp.com/doc/master/web-components-api
 *
 */

$app->webview->components->add('app-logo', \App\Components\Logo::class);
$app->webview->components->add('app-headlines', \App\Components\Headlines::class);


/**
 * -----------------------------------------------------------------------------
 *   FS Static Provider
 * -----------------------------------------------------------------------------
 *
 * Provides functionality for accessing files on the local
 * file system based on HTTP requests.
 *
 * You may also create an `override` directory next to the compiled binary to
 * override all assets.
 *
 * For example:
 * - build/windows/amd64/app.exe
 * - build/windows/amd64/assets/xxx
 *
 * Directory and file mounting rules settings are located in the `mount`
 * section of the `boson.json` config.
 *
 */

$static = new FilesystemStaticProvider([
    __DIR__ . '/assets/private',
    __DIR__ . '/assets/public',
]);



/**
 * -----------------------------------------------------------------------------
 *   Request Handler
 * -----------------------------------------------------------------------------
 *
 * Process all "request" events from Boson Application.
 *
 * @link https://bosonphp.com/doc/master/schemes-api#requests-interception
 *
 */

$controller = new FrontController($static);

$app->on(static function (SchemeRequestReceived $e) use ($controller): void {
    $e->response = $controller($e->request);
});



/**
 * -----------------------------------------------------------------------------
 *   Fire Request
 * -----------------------------------------------------------------------------
 *
 * Go to the specified address, which in turn initializes the
 * first event of the incoming request.
 *
 * @link https://bosonphp.com/doc/master/webview#url-navigation
 *
 */

$app->webview->url = 'boson://index';
