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

namespace App\Controller;

use App\Job\PersonJob;
use App\Model\Person;
use App\Request\PersonRequest;
use Hyperf\AsyncQueue\Driver\DriverInterface as QueueInterface;
use Hyperf\Cache\Cache as CacheInterface;
use Hyperf\Database\Model\Builder;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as MessageResponseInterface;

final readonly class PersonController
{
    public function __construct(
        private CacheInterface $cache,
        private QueueInterface $queue
    ) {
    }

    public function create(PersonRequest $request, ResponseInterface $response): MessageResponseInterface
    {
        $person = $request->toPerson();

        if ($this->cache->get($person['nick'])) {
            return $response->json(['message' => 'Esse apelido já existe'])->withStatus(422);
        }

        $this->queue->push(new PersonJob($person));

        $this->cache->set($person['nick'], '.');
        $this->cache->set($person['id'], json_encode($person));

        return $response->json($person)->withStatus(201)->withHeader('Location', "/pessoas/{$person['id']}");
    }

    public function show(RequestInterface $request, ResponseInterface $response, string $id): MessageResponseInterface
    {
        if ($cached = $this->cache->get($id)) {
            return $response->json(json_decode($cached));
        }

        return $response->raw('Not found')->withStatus(404);
    }

    public function search(RequestInterface $request, ResponseInterface $response): MessageResponseInterface
    {
        $term = $request->getQueryParams()['t'] ?? null;
        if ($term) {
            $list = Person::whereRaw('searchable like ?', [strtolower("%{$term}%")])->limit(50)->get();

            return $response->json($list);
        }

        return $response->json(['message' => 'Precisa de um termo na busca'])->withStatus(400);
    }

    public function count(RequestInterface $request, ResponseInterface $response): MessageResponseInterface
    {
        return $response->json(['count' => Person::count()]);
    }
}
