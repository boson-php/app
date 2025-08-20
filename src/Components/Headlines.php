<?php

declare(strict_types=1);

namespace App\Components;

use Boson\WebView\Api\WebComponents\WebComponent;

final class Headlines extends WebComponent
{
    public function render(): string
    {
        return <<<'HTML'
            <div class="headlines">
                <hgroup>
                    <h1>Go Native.</h1>
                    <h2>Stay PHP</h2>
                </hgroup>
            </div>
        HTML;
    }
}
