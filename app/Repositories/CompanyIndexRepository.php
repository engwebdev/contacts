<?php

namespace App\Repositories;


use App\Models\Company;
use App\Models\Contact;
use App\Models\Product as ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CompanyIndexRepository extends RepositoryInterface
{
    public function __construct(Request $request)
    {
    }

    public function model()
    {
    }

    public function company_indexRepository($request)
    {
        $query = $request->query;
        $arr_sort = ['id', 'title'];
        if ($query->get('sort_by')) {
            $res_1 = in_array(strtoupper($query->get('order_by')), $arr_sort);
            if (!$res_1) {
                $sort_by = 'id';
            }
            else {
                $sort_by = $query->get('sort_by');
            }
        }
        else {
            $sort_by = 'id';
        }
        $arr_order = ['ASC', 'DESC'];
        if ($query->get('order_by')) {
            $res_2 = in_array(strtoupper($query->get('order_by')), $arr_order);
            if (!$res_2) {
                $order_by = 'asc';
            }
            else {
                $order_by = $query->get('order_by');
            }
        }
        else {
            $order_by = 'asc';
        }

        if (is_numeric($query->get('limit'))) {
            $limit = $query->get('limit');
        }
        else {
            $limit = '10';
        }

        if (is_numeric($query->get('page'))) {
            $page = $query->get('page');
        }
        else {
            $page = '1';
        }


        $companies = Company::query();
        $data = $companies->select(['id', 'title', 'description', 'address'])
            ->orderBy($sort_by, $order_by)
            ->paginate($limit, '*', 'page', $page);
//            ->get();
        return $data;
    }
}
