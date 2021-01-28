<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;

class NewsDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data[]   = [
            'id'            => $this->id,
            'author_image'  => find_image(@$this->imgAuthor),
            'image'         => find_image(@$this->img),
            'author_name'   => $this->authorName,
            'category_id'   => $this->category_id,
            'date'          => date("Y-m-d",strtotime($this->created_at)),
            'title'         => Session::get('app_locale')=='ar'? $this->title : $this->title,
        ];
        return $data;
    }
}
