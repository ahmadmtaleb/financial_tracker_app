<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Currency extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
     public function toArray($request)
    {
        // return [
        //     'id' => $this->id,
        //     'symbol' => $this->symbol,
        //     'name' => $this->name,
        //     'code' => $this->code
        // ];
    }
}
