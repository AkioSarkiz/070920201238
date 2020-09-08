<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsRequest;
use App\Models\Address;
use App\Repository\Interfaces\AddressRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use function response;

class AddressController extends Controller
{
    protected AddressRepositoryInterface $addressRepo;
    protected Address $address;

    public function __construct(AddressRepositoryInterface $addressRepo, Address $address)
    {
        $this->addressRepo = $addressRepo;
        $this->address = $address;
    }

    /**
     * Just show.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('settings', [
            'addresses' => $this->addressRepo->getMyAddresses(),
        ]);
    }

    /**
     * Update settings.
     *
     * @param UpdateSettingsRequest $request
     * @return RedirectResponse
     */
    public function handleSettings(UpdateSettingsRequest $request): RedirectResponse
    {
        /* Didn't use policy of model because app don't support Auth */

        $isUpdated = $this->insertAddress($request);
        $errorUpdate = '';

        return response()->redirectToRoute('settings.show')
            ->with(['isUpdate' => $isUpdated, 'errorUpdate' => $errorUpdate]);
    }

    /**
     * Adding new address from request obj.
     *
     * @param Request $request
     * @return bool
     */
    private function insertAddress(UpdateSettingsRequest $request): bool
    {
        return (bool) $this->address->create([
            'name' => $request->post('name'),
            'city' => $request->post('city'),
            'area' => $request->post('area'),
            'street' => $request->post('street'),
            'house' => $request->post('house'),
            'info' => $request->post('info'),
        ]);
    }

    /**
     * Delete the address from db if exists.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteAddress(Request $request): RedirectResponse
    {
        /* Didn't use policy of model because app don't support Auth */

        $address = $this->address->find($request->post('del-id'));
        $isUpdate = $address !== null && $address->delete();

        return response()->redirectToRoute('settings.show')
            ->with(['isUpdate' => $isUpdate, 'errorUpdate' => 'Not found address']);
    }
}
