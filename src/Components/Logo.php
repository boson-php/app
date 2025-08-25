<?php

declare(strict_types=1);

namespace App\Components;

use Boson\WebView\Api\WebComponents\WebComponent;

final class Logo extends WebComponent
{
    public function render(): string
    {
        return <<<'HTML'
            <img src="/img/logo.svg" alt="boson" />
            HTML;
    }
}
