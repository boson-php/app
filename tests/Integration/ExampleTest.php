<?php

declare(strict_types=1);

namespace App\Tests\Integration;

use Boson\ApplicationCreateInfo;

final class ExampleTest extends TestCase
{
    public function testDevToolsIsEnabled(): void
    {
        // Create an application
        $app = $this->createApplication(new ApplicationCreateInfo(
            debug: true,
        ));

        $isDevToolsEnabled = null;

        // Intercept internal "saucer_webview_set_dev_tools" call
        $app->saucer->onMethodCall('saucer_webview_set_dev_tools',
            function ($_, bool $enabled) use (&$isDevToolsEnabled): void {
                $isDevToolsEnabled = $enabled;
            });

        self::assertNull($isDevToolsEnabled);

        $app->run();

        self::assertTrue($isDevToolsEnabled);
    }
}
