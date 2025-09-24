<?php

declare(strict_types=1);

namespace App;

use Boson\Component\Http\Component\StatusCode;
use Boson\Component\Http\Response;
use Boson\Component\Http\Static\StaticProviderInterface;
use Boson\Contracts\Http\RequestInterface;
use Boson\Contracts\Http\ResponseInterface;

final readonly class FrontController
{
    public function __construct(
        private StaticProviderInterface $static,
    ) {}

    public function __invoke(RequestInterface $request): ?ResponseInterface
    {
        $response = $this->static->findFileByRequest($request);

        if ($response !== null) {
            return $response;
        }

        return new Response(
            body: file_get_contents(__DIR__ . '/../assets/view/layout/main.html'),
            status: StatusCode::Ok,
        );
    }
}