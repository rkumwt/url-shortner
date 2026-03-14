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

        $urls = ShortUrl::select('short_urls.id', 'short_urls.url', 'short_urls.short_url_code', 'short_urls.hits', 'companies.name as client', 'short_urls.created_at')
            ->join('users', 'users.id', '=', 'short_urls.created_by')
            ->join('companies', 'companies.id', '=', 'users.company_id');

        if ($companyId) {
            $urls->where('short_urls.company_id', $companyId);
        }
        $urls = $urls->paginate($perPage);

        return $this->success('Short Urls fetched successfully', [
            'data'   => $urls->items(),
            'meta'      => [
                'current_page' => $urls->currentPage(),
                'last_page' => $urls->lastPage(),
                'per_page' => $urls->perPage(),
                'total' => $urls->total()
            ]
        ]);
    }
}
