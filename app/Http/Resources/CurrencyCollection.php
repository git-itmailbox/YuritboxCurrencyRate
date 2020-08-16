<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CurrencyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => CurrencyResource::collection($this->collection),
            'pagination' => [
                'size' => $this->perPage(),
                'total' => $this->total(),
                'current' => $this->currentPage(),
            ],
        ];
    }
}
