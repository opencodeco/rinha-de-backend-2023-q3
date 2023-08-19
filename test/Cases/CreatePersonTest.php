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

namespace Test\Cases;

use Hyperf\HttpMessage\Server\Response;
use Test\HttpTestCase;

use function PHPUnit\Framework\assertSame;

/**
 * @internal
 * @coversNothing
 */
final class CreatePersonTest extends HttpTestCase
{
    public function testCreatePersonWithEmptyNickname(): void
    {
        /** @var Response $response */
        $response = $this->request('POST', '/pessoas', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'apelido' => '',
                'nome' => 'OpenCodeCo',
                'nascimento' => '2023-07-01',
            ],
        ]);

        assertSame(422, $response->getStatusCode());
    }

    public function testCreatePersonWithNullNickname(): void
    {
        /** @var Response $response */
        $response = $this->request('POST', '/pessoas', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'apelido' => null,
                'nome' => 'OpenCodeCo',
                'nascimento' => '2023-07-01',
            ],
        ]);

        assertSame(422, $response->getStatusCode());
    }

    public function testCreatePersonWithEmptyName(): void
    {
        /** @var Response $response */
        $response = $this->request('POST', '/pessoas', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'apelido' => $this->randString(),
                'nome' => '',
                'nascimento' => '2023-07-01',
            ],
        ]);

        assertSame(422, $response->getStatusCode());
    }

    public function testCreatePersonWithNullName(): void
    {
        /** @var Response $response */
        $response = $this->request('POST', '/pessoas', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'apelido' => $this->randString(),
                'nome' => null,
                'nascimento' => '2023-07-01',
            ],
        ]);

        assertSame(422, $response->getStatusCode());
    }

    public function testCreatePersonWithEmptyBirthDate(): void
    {
        /** @var Response $response */
        $response = $this->request('POST', '/pessoas', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'apelido' => $this->randString(),
                'nome' => 'OpenCodeCo',
                'nascimento' => '',
            ],
        ]);

        assertSame(422, $response->getStatusCode());
    }

    public function testCreatePersonWithNullBirthDate(): void
    {
        /** @var Response $response */
        $response = $this->request('POST', '/pessoas', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'apelido' => $this->randString(),
                'nome' => 'OpenCodeCo',
                'nascimento' => null,
            ],
        ]);

        assertSame(422, $response->getStatusCode());
    }

    public function testCreatePersonWithInvalidBirthDate(): void
    {
        /** @var Response $response */
        $response = $this->request('POST', '/pessoas', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'apelido' => $this->randString(),
                'nome' => 'OpenCodeCo',
                'nascimento' => '01-07-2023',
            ],
        ]);

        assertSame(422, $response->getStatusCode());
    }

    public function testCreatePersonWithNullStack(): void
    {
        /** @var Response $response */
        $response = $this->request('POST', '/pessoas', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'apelido' => $this->randString(),
                'nome' => 'OpenCodeCo',
                'nascimento' => '2023-07-01',
            ],
        ]);

        assertSame(201, $response->getStatusCode(), $response->getBody()->getContents());
    }

    public function testCreatePersonWithSomeStack(): void
    {
        /** @var Response $response */
        $response = $this->request('POST', '/pessoas', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'apelido' => $this->randString(),
                'nome' => 'OpenCodeCo',
                'nascimento' => '2023-07-01',
                'stack' => ['PHP', 'Swoole', 'Hyperf'],
            ],
        ]);

        assertSame(201, $response->getStatusCode(), $response->getBody()->getContents());
    }

    protected function randString(): string
    {
        return str_pad(bin2hex(random_bytes(10)), 10);
    }
}
