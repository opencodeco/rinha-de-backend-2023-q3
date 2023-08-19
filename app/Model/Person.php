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

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class Person extends Model
{
    public bool $timestamps = false;

    protected ?string $table = 'person';

    protected array $fillable = [
        'id',
        'nick',
        'name',
        'birth',
        'stack',
    ];

    protected array $casts = [
        'id' => 'string',
        'stack' => 'array'
    ];

    protected array $attributes = [
        'stack' => '[]',
    ];
}
