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

namespace Test;

use Hyperf\DbConnection\Db;
use Hyperf\Testing\Client;
use PHPUnit\Framework\TestCase;

/**
 * Class HttpTestCase.
 *
 * @method get($uri, $data = [], $headers = [])
 * @method post($uri, $data = [], $headers = [])
 * @method json($uri, $data = [], $headers = [])
 * @method file($uri, $data = [], $headers = [])
 * @method request($method, $path, $options = [])
 */
abstract class HttpTestCase extends TestCase
{
    protected Client $client;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = \Hyperf\Support\make(Client::class);
    }

    public function __call($name, $arguments)
    {
        return $this->client->{$name}(...$arguments);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Db::beginTransaction();
    }

    protected function tearDown(): void
    {
        Db::rollBack();
        parent::tearDown();
    }
}
