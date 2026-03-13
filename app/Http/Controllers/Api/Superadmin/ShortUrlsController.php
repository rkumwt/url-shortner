<?php

namespace App\Http\Controllers\Api\Superadmin;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\Superadmin\ShortUrls\ShortUrlsIndexRequest;
use App\Models\ShortUrl;

class ShortUrlsController extends ApiBaseController
{
    public function index(ShortUrlsIndexRequest $request)
    {
        $perPage = $request->per_page ?? 10;
        $companyId = $request->company_id ?? null;

        $users = ShortUrl::select('id', 'name');
        if ($companyId) {
            $users->where('company_id', $companyId);
        }
        $users->paginate($perPage);

        return $this->success('Short Urls fetched successfully', [
            'urls'   => $users->items(),
            'meta'      => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total()
            ]
        ]);
    }
}
