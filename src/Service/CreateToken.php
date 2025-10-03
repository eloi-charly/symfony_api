<?php 
declare(strict_types=1);

namespace App\Service;

use App\Entity\ApiToken;
use App\Entity\User;

final readonly class CreateToken
{

    public function createToken(User $user): string
    {
        return (new ApiToken())->setToken();
    }
}
