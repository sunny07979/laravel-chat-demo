<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use DB;
use Auth;

class MessageController extends Controller
{
    public function load(Request $request){
        $user_id = Auth::id();
        $messages = Message::Where(function ($query) use($request, $user_id) {
            $query->where('sender_id', $request->sender_id)->where('receiver_id', $user_id);
        })
        ->orWhere(function ($query) use($request, $user_id) {
            $query->where('sender_id', $user_id)->where('receiver_id', $request->sender_id);
        })
        ->orderBy('id')
        ->get();
        
        return $messages;
    }

    public function send(Request $request){
        $user_id = Auth::id();
        $data = $request->all();
        $message = new Message();
        $message->sender_id = $user_id;
        $message->receiver_id  = $request->receiver_id;
        $message->text = $request->text;
        $message->save();
        return $message;
    }

    public function markAsRead(Request $request){
        Message::Where(function ($query) use($request) {
            $query->where('sender_id', $request->sender_id)->where('receiver_id', Auth::id());
        })->update(['status' =>'seen']);
    }

    public function check(Request $request){
        $user_id = Auth::id();
        $messages = Message::select(DB::raw('count(id) as message_count'), 'sender_id')
            ->where('status', 'new')
            ->where('receiver_id', $user_id)
            ->groupBy('sender_id')
            ->get();
        $delMessages = Message::select(DB::raw('count(id) as message_count'), 'sender_id')
            ->withTrashed()
            ->where('deleted_at', '>=', date('Y-m-d H:i:s', strtotime('-5 seconds')))
            ->where('receiver_id', $user_id)
            ->groupBy('sender_id')
            ->get();
        return ['new_messages' => $messages, 'deleted_messages' => $delMessages];
    }

    public function delete(Request $request){
        $messages = Message::where('id', $request->message_id)->delete();
        return 'true';
    }
}
