<?php

namespace App\Repositories;


use App\Models\Company;
use App\Models\Contact;
use App\Models\Product as ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CompanyStoreRepository extends RepositoryInterface
{
    public function __construct(Request $request)
    {
    }

    public function model()
    {
    }

    public function company_storeRepository($request)
    {
        $data = Company::create([
            'title' => $request->title,
            'description' => $request->description,
            'address' => $request->address,
        ]);
        return $data;
    }
}
