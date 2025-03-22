<?php

namespace Src\User\Domain\Dto;

readonly class UserProfileDto
{
    public string $id;

    public string $name;

    public string $email;

    public string $createdAt;
}
