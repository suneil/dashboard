<?php
declare(strict_types=1);

namespace Dashboard\Entity;

/**
 * Interface RepositoryInterface
 * @package Dashboard\EntityController
 */
interface RepositoryInterface
{
    public function getAllItems(): array;
    public function getItem(int $id): array;
    public function create(array $item): ?int;
}