<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Models\Company;
use App\Repositories\CompanyIndexRepository;
use App\Repositories\CompanyStoreRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyController extends Controller
{
    public function index(CompanyIndexRepository $companyIndexRepository, Request $request)
    {
        $companies = $companyIndexRepository->company_indexRepository($request);
        return response()->json(data: [
            'status' => true,
            'message' => 'all company read Successfully',
            'companies' => $companies,
        ], status: 200);

    }

    public function store(CompanyStoreRepository $companyStoreRepository, CompanyStoreRequest $request): object
    {
        try {
            $company = $companyStoreRepository->company_storeRepository($request);

            return response()->json(data: [
                'status' => true,
                'message' => 'company created Successfully',
                'company' => $company,
            ], status: 200);

        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    public function show(Company $company)
    {
        try {
            $companies = Company::query();
            $data = $companies->select(['id', 'title', 'description', 'address'])
                ->first($company);
            return response()->json(data: [
                'status' => true,
                'message' => 'company ' . $company->id . ' read Successfully',
                'company' => $data,
            ], status: 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
