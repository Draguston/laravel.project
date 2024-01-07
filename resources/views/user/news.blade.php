@extends('layouts.user')

@section('title_dashboard', 'Новости')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                @if (isset($posts))
                    @foreach ($posts as $post)
                    <div class="header-h3">
                        <h3>{{ $post->title }}</h3>
                    </div>
                    <br>
                    <p>Пользователь: {{ $post->username }} </p>

                    <div style="margin-left: 50px">
                        <br>
                        <?php echo htmlspecialchars_decode($post->text);?>
                        <br>

                        <img style="width: 1000px; margin-bottom: 100px;" src={{ asset($post->image) }} alt="">
                        <br>
                        <p style="margin-bottom: 50px">Дата добавления: {{ $post->created_at }}</p>
                    </div>
                    @endforeach
                @endif
                <div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection