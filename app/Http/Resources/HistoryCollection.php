<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HistoryCollection extends ResourceCollection
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
            'data' => HistoryResource::collection($this->collection),
            'pagination' => [
                'size' => $this->perPage(),
                'total' => $this->total(),
                'current' => $this->currentPage(),
            ],

        ];
    }
}
