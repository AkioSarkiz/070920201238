<?php


declare(strict_types=1);

namespace App\Repository\Interfaces;

use Illuminate\Support\Collection;

interface AddressRepositoryInterface
{
    /**
     * Get collection with my addresses.
     *
     * @param int $limit
     * @param int $offset
     * @return Collection
     */
    public function getMyAddresses($limit = 100, $offset = 0): Collection;
}
