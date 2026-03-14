<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\Admin\TeamMembers\TeamMembersIndexRequest;
use App\Http\Requests\Api\Admin\TeamMembers\TeamMembersInviteRequest;
use App\Mail\InviteMailClient;
use App\Mail\InviteMailTeamMember;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TeamMembersController extends ApiBaseController
{
    public function index(TeamMembersIndexRequest $request)
    {
        $user = $request->user();
        $perPage = $request->per_page ?? 10;

        $users = User::select('id', 'name', 'email', 'type', 'total_urls', 'total_url_hits')
            ->where('users.company_id', $user->company_id)
            ->paginate($perPage);

        return $this->success('Team members fetched successfully', [
            'data'   => $users->items(),
            'meta'      => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total()
            ]
        ]);
    }

    public function invite(TeamMembersInviteRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $company = $request->user()->company;
        $companyName = $company->name ?? '';

        Mail::to($email)->send(new InviteMailTeamMember($name, $companyName, 'https://google.com'));

        return $this->success('Invitation send successfully');
    }
}
