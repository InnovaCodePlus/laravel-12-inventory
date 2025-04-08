<?php

namespace App\Http\Resources\Sale;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{

    public static $wrap = "sale";

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $client = Sale::find($this->id)->client;
        $user = Sale::find($this->id)->user;
        $details = Sale::find($this->id)->products;

        return [
            "id" => $this->id,
            "client" => [
                "name" => $client->name,
                "documentNumber" => $client->document_number,
            ], 
            "user" => [
                "name" => $user->name,
                "email" => $user->email,
            ],
            "details" => new DetailsCollection($details),
            "total" => $this->total,
            "createdAt" => $this->created_at,
        ];
    }
}
