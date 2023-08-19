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

use App\Controller\PersonController;
use Hyperf\HttpServer\Router\Router;

Router::post('/pessoas', [PersonController::class, 'create']);
Router::get('/pessoas/{id}', [PersonController::class, 'show']);
Router::get('/pessoas', [PersonController::class, 'search']);
Router::get('/contagem-pessoas', [PersonController::class, 'count']);
