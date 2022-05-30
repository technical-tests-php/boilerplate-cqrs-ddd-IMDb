<?php

declare(strict_types=1);

namespace BoilerPlate\Shared\Infrastructure\Elasticsearch;

use Elasticsearch\Client;

final class ElasticsearchClient
{
    public function __construct(private Client $client, private string $indexPrefix)
    {
    }

    public function persist(string $aggregateName, string $identifier, array $plainBody): void
    {
        $this->client->index(
            [
                'index' => sprintf('%s_%s', $this->indexPrefix, $aggregateName),
                'id'    => $identifier,
                'body'  => $plainBody,
            ]
        );
    }

    public function client(): Client
    {
        return $this->client;
    }

    public function indexPrefix(): string
    {
        return $this->indexPrefix;
    }
}