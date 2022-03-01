<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetMessageRequest;
use App\Http\Resources\MessageResource;
use App\Http\Requests\SendMessageRequest;
use Chatify\Facades\ChatifyMessenger as Chatify;
use App\Models\ChMessage as Message;
use App\Models\User;
use App\Traits\GeneralTrait;

class ChatController extends Controller
{
    use GeneralTrait;
    public function sendMessage(SendMessageRequest $request)
    {
        // default variables
        $error = (object)[
            'status' => 0,
            'message' => null
        ];
        $attachment = null;
        $attachment_title = null;
        // if there is attachment [file]
        if ($request->hasFile('file')) {
            // allowed extensions
            $allowed_images = Chatify::getAllowedImages();
            $allowed_files  = Chatify::getAllowedFiles();
            $allowed        = array_merge($allowed_images, $allowed_files);
            $file = $request->file('file');
            // if size less than 150MB
            if ($file->getSize() < 150000000) {
                if (in_array($file->getClientOriginalExtension(), $allowed)) {
                    // upload attachment and store the new name
                    $attachment = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $Test = $file->move("chatApi/", $attachment);
                } else {
                    $error->status = 1;
                    $error->message = "File extension not allowed!";
                }
            } else {
                $error->status = 1;
                $error->message = "File extension not allowed!";
            }
        }
        if (!$error->status) {
            // send message to database
            $messageID = mt_rand(9, 999999999) + time();
            $message = Chatify::newMessage([
                'id'            => $messageID,
                'type'          => 'andriod_user',
                'from_id'       => $request->from_id,
                'to_id'         => $request->to_id,
                'body'       => $request->body,
                'attachment' => $attachment
            ]);
        }
        $msg = Message::where('id',$messageID)->first();
        // Chatify::fetchMessage($messageID)
        return $this->returnData('data',new MessageResource($msg),'Message has been sent');

    }

    public function fetchMessages(GetMessageRequest $request)
    {
        $Messages = Message::where('from_id',$request->from_id)->where('to_id',$request->to_id)->get();
        foreach ($Messages as $Message)
        {
            $Message->update([
                'seen' => 1
            ]);
        }
        return $this->returnData('data', MessageResource::collection($Messages), 'Messages Between ' . User::where('id', $request->from_id)->pluck('first_name') . ' and ' .User::where('id', $request->to_id)->pluck('first_name'));
    }
}
