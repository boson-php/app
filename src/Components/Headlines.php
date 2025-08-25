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

    private function updateTitle(): void
    {
        $poller = $this->webview->window->app->poller;

        $this->timerId = $poller->delay(2, function () {
            $this->headlineTitleId++;

            $this->refresh();

            $this->updateTitle();
        });
    }

    public function onConnect(): void
    {
        $this->updateTitle();

        parent::onConnect();
    }

    public function onDisconnect(): void
    {
        $poller = $this->webview->window->app->poller;

        $poller->cancel($this->timerId);

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
