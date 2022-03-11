<?php

namespace App\Http\Resources;

use App\Models\ChMessage;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $getAttachment = ChMessage::where('id',$this->id)->first();
        $attachmentOBJ = json_decode($getAttachment->attachment);
        $attachmentOBJ ? ($attachment = $attachmentOBJ->new_name) : null;
        $attachmentOBJ ? ($attachment_title = htmlentities(trim($attachmentOBJ->old_name), ENT_QUOTES, 'UTF-8') ) : null;
        // return parent::toArray($request);
        return [
            'id'                    => $this->id,
            'from'                  => $this->FromUser,
            'to'                    => $this->ToUser,
            'message'               => $this->body,
            'attachment_path'       => $attachmentOBJ ? (site_base() . '/storage/attachments/' . $attachment) : null,
            'attachment_name'       => $attachmentOBJ ? ($attachment_title) : null,
            'time'                  => $this->created_at->diffForHumans(),
            'viewType'              => $this->from_id == auth()->user()->id ? ( 'sender' ) : 'default',
            'seen'                  => $this->seen
        ];
    }
}
