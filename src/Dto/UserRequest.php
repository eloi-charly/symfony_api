<?php

namespace App\Dto;

use App\Entity\User;
use Symfony\Component\ObjectMapper\Attribute\Map;
use Symfony\Component\Validator\Constraints as Assert;

#[Map(target: User::class)]
final readonly class UserRequest
{
    public function __construct(
        #[Assert\Email()]
        public string $email,

        #[Assert\NotBlank]
        #[Assert\Length(min: 4)]
        public string $password,
    ) {
    }
}