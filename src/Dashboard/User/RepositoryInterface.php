<?php
declare(strict_types=1);

namespace Dashboard\User;

/**
 * Interface RepositoryInterface
 * @package Dashboard\User
 */
interface RepositoryInterface
{
    public function get(int $id): ?array;
    public function create(array $item): ?int;
}