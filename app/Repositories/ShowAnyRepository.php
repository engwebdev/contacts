<?php

namespace App\Repositories;


use App\Models\Contact;
use App\Models\Product as ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShowAnyRepository extends RepositoryInterface
{
    public function __construct(Request $request)
    {
    }

    public function model()
    {
    }

    public function show_any_owen_contacts($keyword)
    {
        $contact = Contact::query();
        $data = $contact
            ->whereHas('companies', function ($query) use ($id) {
                $query->where('id', '=', $id);
            })
            ->select(['id', 'first_name', 'last_name'])
            ->with(['details', 'companies'])
            ->get();

        return $data;
    }
}
