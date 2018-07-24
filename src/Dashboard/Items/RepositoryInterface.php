<?php
declare(strict_types=1);

namespace Dashboard\Items;

/**
 * Interface RepositoryInterface
 * @package Dashboard\Items
 */
interface RepositoryInterface
{
    public function getAllItems(): array;
    public function getItem(int $id): array;
    public function create(array $item): ?int;
}