<?php

namespace Src\User\Application\Query\Profile;

use Src\Shared\Domain\PdoConnection;
use Src\User\Domain\Dto\UserProfileDto;

final readonly class GetUserProfileQueryHandler
{
    public function __construct(
        private PdoConnection $connection
    ) {}

    public function handle(string $userId): GetUserProfileResponse
    {
        $response = new GetUserProfileResponse;
        $sql = "SELECT
                id,
                name,
                email,
                DATE_FORMAT(created_at, '%d/%m/%Y') as createdAt
                FROM users  WHERE id = ? AND deleted_at IS NULL ";

        $stmt = $this->connection->getPdo()->prepare($sql);
        $stmt->bindParam(1, $userId);
        $stmt->execute();

        $response->profile = $stmt->fetchObject(UserProfileDto::class);

        return $response;
    }
}
