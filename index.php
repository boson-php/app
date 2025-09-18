<?php

declare(strict_types=1);

use Boson\Application;
use Boson\ApplicationCreateInfo;
use Boson\Component\Http\Response;
use Boson\Component\Http\Static\FilesystemStaticProvider;
use Boson\WebView\Api\Schemes\Event\SchemeRequestReceived;
use Boson\WebView\Api\WebComponents\WebComponentsExtensionProvider;
use Boson\WebView\WebViewCreateInfo;
use Boson\Window\WindowCreateInfo;
use Boson\Window\WindowDecoration;

require __DIR__ . '/vendor/autoload.php';

$app = new Application(new ApplicationCreateInfo(
    schemes: ['boson'],
    debug: false,
    window: new WindowCreateInfo(
        width: 800,
        height: 600,
        decoration: WindowDecoration::DarkMode,
        webview: new WebViewCreateInfo(
            extensions: [
                ...WebViewCreateInfo::DEFAULT_WEBVIEW_EXTENSIONS,
                new WebComponentsExtensionProvider(),
            ]
        ),
    ),
));

$static = new FilesystemStaticProvider([
    __DIR__ . '/assets',
]);

$app->on(static function (SchemeRequestReceived $e) use ($static): void {
    $e->response = $static->findFileByRequest($e->request);

    if ($e->response !== null) {
        return;
    }

    $e->response = new Response(
        body: file_get_contents(__DIR__ . '/assets/view/layout/main.html'),
    );
});

$app->webview->components->add('app-logo', \App\Components\Logo::class);
$app->webview->components->add('app-headlines', \App\Components\Headlines::class);

$app->webview->url = 'boson://index';
