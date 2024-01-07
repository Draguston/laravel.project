@extends('layouts.user')

@section('title', 'Пользователи')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>
                                    Имя
                                </th>
                                <th style="width: 25%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('messages.show', $user->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Отправить сообщение
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <div>
                {{ $users->links() }}
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
