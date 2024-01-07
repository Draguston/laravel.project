<div class="container">
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
