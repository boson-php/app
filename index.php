<?php

declare(strict_types=1);

use Boson\Application;
use Boson\ApplicationCreateInfo;
use Boson\Component\Http\Response;
use Boson\Component\Http\Static\FilesystemStaticProvider;
use Boson\WebView\Api\Schemes\Event\SchemeRequestReceived;
use Boson\Window\WindowCreateInfo;

require __DIR__ . '/vendor/autoload.php';

$app = new Application(new ApplicationCreateInfo(
    schemes: ['boson'],
    debug: false,
    window: new WindowCreateInfo(
        width: 800,
        height: 600,
    ),
));

$static = new FilesystemStaticProvider([__DIR__ . '/assets']);

$app->on(static function (SchemeRequestReceived $e) use ($static): void {
    $e->response = $static->findFileByRequest($e->request);

    if ($e->response !== null) {
        return;
    }

    $e->response = new Response(
        body: file_get_contents(__DIR__ . '/assets/view/layout/main.html'),
    );
});

foreach (require __DIR__ . '/src/components.php' as $name => $component) {
    $app->webview->components->add($name, $component);
}

$app->webview->url = 'boson://index';
