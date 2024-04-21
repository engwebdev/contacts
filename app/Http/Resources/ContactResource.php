<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $first_name
 * @property mixed $last_name
 * @property mixed $companies
 */
class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
//            'companies' => $this->when($this->companies == null, function (){
//                CompanyResource::collection($this->whenLoaded('companies'));
//            }),
//            'details' => $this->whenNotNull('details'),
            'companies' => CompanyResource::collection($this->whenLoaded('companies')),
            'details' => DetailResource::collection($this->whenLoaded('details')),
        ];
//        return parent::toArray($request);
    }
}
