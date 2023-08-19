<?php

declare(strict_types=1);

/**
 * This file is part of OpenCodeCo.
 *
 * @link     https://github.com/opencodeco/rinha-de-backend-2023-q3
 * @document https://github.com/opencodeco/rinha-de-backend-2023-q3/wiki
 * @contact  https://github.com/opencodeco/rinha-de-backend-2023-q3/discussions
 * @license  https://github.com/opencodeco/rinha-de-backend-2023-q3/blob/dev/LICENSE
 */

namespace App\Exception\Handler;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    public function __construct(protected StdoutLoggerInterface $logger)
    {
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());
        return $response->withHeader('Server', 'Hyperf')->withStatus(500)->withBody(new SwooleStream('Internal Server Error.'));
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
