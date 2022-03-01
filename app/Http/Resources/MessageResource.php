<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'from'              => new UsersResource(User::where('id',$this->from_id)->get()),
            'to'                => new UsersResource(User::where('id',$this->to_id)->get()),
            'body'              => $this->body,
            'attachment'        => $this->attachment ? (site_base() . '/chatApi//' . $this->attachment) : null,
            'viewType'          => ($this->from_id == Auth::user()->id) ? 'sender' : 'reciver',
            'time'              => $this->created_at->diffForHumans(),
            'fullTime'          => $this->created_at,
            'seen'              => $this->seen,
        ];
    }
}
