<?php

namespace App\Repositories;


use App\Models\Contact;
use App\Models\Product as ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchRepository extends RepositoryInterface
{
    public function __construct(Request $request)
    {
    }

    public function model()
    {
    }

    public function search($keyword)
    {
        $searchQuery = Contact::query();

        $data = $searchQuery
            ->where('first_name', 'like', '%' . $keyword . '%')
            ->orwhere('last_name', 'like', '%' . $keyword . '%')
            ->orWhereHas('companies', function ($q) use ($keyword) {
                return $q->where('title', 'like', '%' . $keyword . '%');
            })
            ->get();
        return $data;
    }
}
