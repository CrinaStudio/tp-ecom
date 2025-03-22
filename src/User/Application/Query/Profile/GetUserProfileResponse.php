<?php

namespace Src\User\Application\Query\Profile;

use Src\User\Domain\Dto\UserProfileDto;

class GetUserProfileResponse
{
    public ?UserProfileDto $profile = null;
}
