<?php

declare(strict_types=1);

namespace App\Components;

use Boson\WebView\Api\WebComponents\WebComponent;

final class Headlines extends WebComponent
{
    private const array HEADLINE_TITLES = [
        'Go Native',
        'Create Incredible Things',
        'Think Different',
        'Improve Experience',
    ];

    private int $headlineTitleId = 0;

    private int|string $timerId;

    public function onConnect(): void
    {
        $this->timerId = $this->webview->window->app->poller
            ->timer(2, function () {
                ++$this->headlineTitleId;

                $this->refresh();
            });

        parent::onConnect();
    }

    public function onDisconnect(): void
    {
        $this->webview->window->app->poller
            ->cancel($this->timerId);

        parent::onDisconnect();
    }

    public function render(): string
    {
        $title = self::HEADLINE_TITLES[$this->headlineTitleId % \count(self::HEADLINE_TITLES)];

        $this->webview->window->title = $title;

        return <<<HTML
            <em>{$title}.</em>
            Stay PHP
            HTML;
    }
}
