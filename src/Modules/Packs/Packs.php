<?php

namespace App\Modules\Packs;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use PDO;

class Packs
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getPacks(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $sql = "SELECT DISTINCT pack FROM `products`;";

        $statement = $this->connection->query($sql);
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(200);
    }
}
