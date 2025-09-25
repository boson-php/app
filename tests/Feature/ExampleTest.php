<?php

declare(strict_types=1);

namespace App\Tests\Feature;

use Boson\WebView\Event\WebViewDomReady;

final class ExampleTest extends TestCase
{
    public function testFooFunctionCalledAfterButtonClicked(): void
    {
        $app = $this->createApplication('<button onclick="foo(42)" id="btn">BUTTON</button>');

        $app->webview->bindings->bind('foo', function (int $argument) use ($app) {
            $this->assertSame(42, $argument);

            $app->quit();
        });

        $app->webview->on(function (WebViewDomReady $e): void {
            $e->subject->scripts->eval('document.getElementById("btn").click();');
        });

        $app->run();
    }
}
