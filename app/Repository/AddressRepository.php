<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Address;
use App\Repository\Interfaces\AddressRepositoryInterface;
use Illuminate\Support\Collection;

class AddressRepository implements AddressRepositoryInterface
{
    protected Address $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @inheritDoc
     */
    public function getMyAddresses($limit = 100, $offset = 0): Collection
    {
        return $this->address
            // if required Auth
            // ->where('user_id', \Auth::id())
            ->orderBy('name', 'desc')
            ->limit($limit)
            ->get();
    }
}
