<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Repositories\SearchRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(SearchRepository $searchRepository, string $keyword)
    {
        $result = $searchRepository->search($keyword);

        return $result;
    }
}
