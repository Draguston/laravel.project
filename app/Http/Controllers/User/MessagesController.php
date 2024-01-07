<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Readline\Hoa\Console;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        dd($request);
        return view('user.messages');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = new Messages;
        $message->sender_id = Auth::id(); // sender_id - это ID отправителя
        $message->recipient_id = $request->recipient_id;
        $message->text = $request->message_text_area;

        // сохраняем изображение, если оно есть
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $message->image = $filename;
        }

        $message->save();

        return response($message->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $messages = Messages::where(function ($query) use ($id) {
            $query->where('recipient_id', $id)
                ->where('sender_id', Auth::id());
        })
            ->orWhere(function ($query) use ($id) {
                $query->where('sender_id', $id)
                    ->where('recipient_id', Auth::id());
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        foreach ($messages as $message) {
            $message = $message->sender_name = User::where('id', '=', $message->sender_id)->value('name');
        }
        return view('user.messages', [
            'id' => $id,
            'messages' => $messages
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $message = Messages::find($id);

        $message->sender_name = User::where('id', '=', $message->sender_id)->value('name');
        return view('user.message_response', [
            'message' => $message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}