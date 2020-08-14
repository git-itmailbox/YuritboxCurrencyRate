<?php

namespace App\Http\Resources;

use App\Models\History;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'numcode' => $this->resource->numcode,
            'charcode' => $this->resource->charcode,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'rateValue' => $this->resource->latestRate->value / History::FACTOR ,
            'rate' => $this->resource->latestRate,
        ];
    }
}
