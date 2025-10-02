<?php

declare(strict_types=1);

namespace App\Dto;

final class CocktailQueryDto {
    public function __construct(
        public ?string $name = null,
        public ?bool $isAlcoholic = null,
        public ?int $difficulty = null,
        public int $page = 1,
        public int $itemsPerPage = 10,
    ){}
}