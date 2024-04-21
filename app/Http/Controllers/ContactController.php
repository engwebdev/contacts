<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactCollection;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Models\Detail;
use App\Models\Type;
use App\Repositories\ShowAnyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::query();
        $data = $contact
            ->select(['id', 'first_name', 'last_name'])
            ->with(['details', 'companies'])
            ->get();

        return response()->json(data: [
            'status' => true,
            'message' => 'contact show all',
            'contact' => new ContactCollection($data),
        ], status: 200);
    }

    public function store(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(),
                [
                    'company_id' => 'required|exists:companies,id',
                    'first_name' => 'required',
                    'last_name' => 'nullable',
                ]);

            $resultValidate = $validateData->attributes();

            $typeQuery = Type::query();
            $typeModel = $typeQuery->select(['id', 'title'])->get();
            $types = collect($typeModel)->map(
                function ($item) use ($resultValidate, $request) {
                    $key = $item->title;
                    if (array_key_exists($key, $resultValidate)) {
                        if ($resultValidate[$key] === null) {
                            throw ValidationException::withMessages(['The ' . $key . ' field is required']);
                        }
                        $item['value'] = $resultValidate[$key];
                        return $item;
                    }
                }
            )->toArray();
            $types = array_filter($types);

            if ($validateData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateData->errors()
                ], 401);
            }

//            dd($types);
            $contact = Contact::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);

            $contact->companies()->attach($request->company_id);

            $details = [];
            foreach ($types as $item) {
                $details[] = new Detail(
                    [
                        'type_id' => $item['id'],
                        'type_title' => $item['title'],
                        'detail_value' => $item['value'],
                    ]
                );
            }

            $contact_data = $contact->details()->saveMany($details);

            return response()->json(data: [
                'status' => true,
                'message' => 'contact created Successfully',
                'contact' => $contact,
                'contact data' => $contact_data,
            ], status: 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    public function store_all(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(),
                [
                    'company_id' => 'required|exists:companies,id',
                    'contacts.*' => 'required',
                ]);

            $result = $validateData->attributes();
            $resultValidates = $result['contacts'];

            $typeQuery = Type::query();
            $typeModel = $typeQuery->select(['id', 'title'])->get();
            foreach ($resultValidates as $resultValidate) {
                $types = collect($typeModel)->map(
                    function ($item) use ($resultValidate) {
                        $key = $item->title;
                        if (array_key_exists($key, $resultValidate)) {
                            if ($resultValidate[$key] === null) {
                                throw ValidationException::withMessages(['The ' . $key . ' field is required']);
                            }
                            $item['value'] = $resultValidate[$key];
                            return $item;
                        }
                    }
                )->toArray();
                $types = array_filter($types);

                if ($validateData->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validateData->errors()
                    ], 401);
                }

                $first_name = $resultValidate['first_name'] ?? null;
                $last_name = $resultValidate['last_name'] ?? null;
                $contact = Contact::create([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                ]);

                $contact->companies()->attach($request->company_id);
                $details = [];
                foreach ($types as $item) {
                    $details[] = new Detail(
                        [
                            'type_id' => $item['id'],
                            'type_title' => $item['title'],
                            'detail_value' => $item['value'],
                        ]
                    );
                }

                $contact_data = $contact->details()->saveMany($details);

            }
            return response()->json(data: [
                'status' => true,
                'message' => 'contact created Successfully',
                'contacts' => $resultValidates,
            ], status: 200);

        }

        catch
        (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    // view all of company id
    public function show_any(ShowAnyRepository $showAnyRepository ,string $id)
    {
        $data = $showAnyRepository->show_any_owen_contacts($id);

        return response()->json(data: [
            'status' => true,
            'message' => 'contact show all',
            'contact' => new ContactCollection($data),
        ], status: 200);
    }

    public function show(string $id)
    {
        try {
            $contacts = Contact::query();
            $data = $contacts
                ->select(['id', 'first_name', 'last_name'])
                ->with(['details', 'companies'])
                ->first($contacts);
            return response()->json(data: [
                'status' => true,
                'message' => 'contact ' . $data->id . ' read Successfully',
//                'contact' => $data,
                'contact' => new contactResource($data),
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
        try {
            $validateData = Validator::make($request->all(),
                [
                    'first_name' => 'required',
                    'last_name' => 'nullable',
                ]);

            $resultValidate = $validateData->attributes();

            $typeQuery = Type::query();
            $typeModel = $typeQuery->select(['id', 'title'])->get();
            $types = collect($typeModel)->map(
                function ($item) use ($resultValidate, $request) {
                    $key = $item->title;
                    if (array_key_exists($key, $resultValidate)) {
                        if ($resultValidate[$key] === null) {
                            throw ValidationException::withMessages(['The ' . $key . ' field is required']);
                        }
                        $item['value'] = $resultValidate[$key];
                        return $item;
                    }
                }
            )->toArray();
            $types = array_filter($types);

            if ($validateData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateData->errors()
                ], 401);
            }

            $contact = Contact::query();
            $data = $contact
                ->select(['id', 'first_name', 'last_name'])
                ->with(['details'])
                ->findOrFail($id);
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->save();


            $details = [];
            foreach ($types as $item) {
                $details[] = new Detail(
                    [
                        'type_id' => $item['id'],
                        'type_title' => $item['title'],
                        'detail_value' => $item['value'],
                    ]
                );
            }

            $contact_data = $contact->details()->saveMany($details);

            return response()->json(data: [
                'status' => true,
                'message' => 'contact created Successfully',
                'contact' => $contact,
                'contact data' => $contact_data,
            ], status: 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        $contact = Contact::where('id', '=', $id)->delete();
        $detail = Detail::where('contact_id', '=', $id)->delete();

        return response()->json(data: [
            'status' => true,
            'message' => 'contact deleted Successfully',
            'contact' => $contact,
            'contact data' => $detail,
        ], status: 200);

    }

    public function destroy_detail(string $id)
    {
        $detail = Detail::where('id', '=', $id)->delete();

        return response()->json(data: [
            'status' => true,
            'message' => 'contact detail deleted Successfully',
            'detail' => $detail,
        ], status: 200);
    }
}
