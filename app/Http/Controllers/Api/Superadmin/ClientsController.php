<?php

namespace App\Http\Controllers\Api\Superadmin;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\Superadmin\Clients\ClientsIndexRequest;
use App\Http\Requests\Api\Superadmin\Clients\ClientsInviteRequest;
use App\Mail\InviteMailClient;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;

class ClientsController extends ApiBaseController
{
    public function index(ClientsIndexRequest $request)
    {
        $perPage = $request->per_page ?? 10;

        $users = Company::select('id', 'name')->paginate($perPage);

        return $this->success('Clients fetched successfully', [
            'clients'   => $users->items(),
            'meta'      => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total()
            ]
        ]);
    }

    public function invite(ClientsInviteRequest $request)
    {
        $name = $request->name;
        $email = $request->email;

        Mail::to($email)->send(new InviteMailClient($name, 'https://google.com'));

        return $this->success('Invitation send successfully');
    }
}
