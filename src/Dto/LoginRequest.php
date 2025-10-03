<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class LoginRequest
{
    public function __construct(
        #[Assert\Email()]
        public string $email,

        public string $password,
    ) {
    }
}