@extends('layouts.user')

@section('title_dashboard', 'Сообщения')

@section('header', 'Сообщения')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>Чат</h2>
                    <div id="message-container"></div>
                    @foreach ($messages as $message)
                        <div class="container" id="container">
                            <img src="" alt="" style="width:100%;">
                            <div id="message">
                                @if ($message->sender_name == Auth::user()->name)
                                    <p style="color: green">{{ $message->sender_name }}</p>
                                @else
                                    <p style="color: red">{{ $message->sender_name }}</p>
                                @endif
                                <p>{{ $message->text }}</p>
                            </div>
                            <span class="time-right">{{ $message->created_at }}</span>
                        </div>
                    @endforeach
                    <form id="messageInput" name="messageInput" method="POST" enctype="multipart/form-data">
                        <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <textarea name="message_text_area" id="message_text" class="form-control" rows="3"
                                    placeholder="Введите сообщение..."></textarea>
                            </div>
                        </div>
                        {{ $messages->links() }}
                        <input type="button" class="btn btn-secondary" style="background-color: #6c757d;"
                            value="Добавить сообщение" id="button" ,
                            onClick="sendRequest(document.forms.messageInput, 'message-container', {recipient_id: {{ $id }}, text: 'message_text'})">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
