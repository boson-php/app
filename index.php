<?php

declare(strict_types=1);

use App\Components\Headlines;
use App\Components\Logo;
use Boson\ApplicationCreateInfo;
use Boson\Component\Http\Static\FilesystemStaticProvider;
use Boson\WebView\Api\Schemes\Event\SchemeRequestReceived;

require __DIR__ . '/vendor/autoload.php';

$app = new Boson\Application(
    info: new ApplicationCreateInfo(
        schemes: ['static'],
        debug: false,
    ),
);

$static = new FilesystemStaticProvider([__DIR__ . '/public']);

$app->on(static function (SchemeRequestReceived $e) use ($static): void {
    $e->response = $static->findFileByRequest($e->request);
});

$app->webview->components->add('head-lines', Headlines::class);
$app->webview->components->add('logo-hero', Logo::class);

$app->window->title = 'BosonPHP';
$app->window->size->width = 1100;
$app->window->size->height = 700;

$app->webview->html = file_get_contents(__DIR__ . '/templates/layout/main.php');
