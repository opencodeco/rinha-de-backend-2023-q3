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

use Hyperf\AsyncQueue\Driver\DriverFactory;
use Psr\Container\ContainerInterface;

return [
    Hyperf\AsyncQueue\Driver\DriverInterface::class =>
        fn (ContainerInterface $c) => $c->make(DriverFactory::class)->get('default')
];
