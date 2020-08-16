<?php

namespace App\Http\Resources;

use App\Models\History;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
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
            'value' => $this->resource->value / History::FACTOR ,
            'nominal' => $this->resource->nominal,
            'date' => $this->resource->date,
            'currency_id' => $this->resource->currency_id,
        ];
    }
}
