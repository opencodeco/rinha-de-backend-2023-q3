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

namespace App\Job;

use Hyperf\AsyncQueue\Job;
use Hyperf\DbConnection\Db;

class PersonJob extends Job
{
    public function __construct(
        public readonly array $params
    ) {
    }

    public function handle(): void
    {
        Db::table('person')->insert($this->params);
    }
}