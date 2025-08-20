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
        debug: true,
    ),
);

$static = new FilesystemStaticProvider([__DIR__ . '/public']);

$app->on(function (SchemeRequestReceived $e) use ($static): void {
    $e->response = $static->findFileByRequest($e->request);
});

$app->webview->components->add('head-lines', Headlines::class);
$app->webview->components->add('logo-hero', Logo::class);

$app->window->title = 'BosonPHP';
$app->window->size->width = 1100;
$app->window->size->height = 700;

$app->webview->html = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero</title>
    <link href="static://localhost/css/app.css" rel="stylesheet" media="screen">
</head>
<body>
<section class="container">
    <div class="top">
        <div class="text">
            <head-lines></head-lines>

            <p class="description">
                Turn your PHP project into cross-platform, compact, fast, native applications for Windows, Linux and macOS.
            </p>

            <div class="buttons">
                <div class="button-wrapper">
                    <a href="https://bosonphp.com" class="button button-primary">
                        Official Website
                        <span class="icon"></span>
                    </a>
                </div>
            </div>
        </div>

        <logo-hero></logo-hero>
    </div>

    <aside class="bottom">
        <a href="https://bosonphp.com/doc" class="discover">
            <span class="discover-container">
                <span class="discover-text">
                    Documentation Guide
                </span>

                <svg class="discover-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 10L12 15L17 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        </a>
    </aside>
</section>
</body>
</html>
HTML;

