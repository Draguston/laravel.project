@extends('layouts.admin_layout')

@section('title', 'Все пользователи')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все пользователи</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 2%">
                                    ID
                                </th>
                                <th>
                                    Имя
                                </th>
                                <th>
                                    Почта
                                </th>
                                <th>
                                    Дата регистрации
                                </th>
                                <th style="width: 25%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user['id'] }}
                                    </td>
                                    <td>
                                        {{ $user['name'] }}
                                    </td>
                                    <td>
                                        {{ $user['email'] }}
                                    </td>
                                    <td>
                                        {{ $user['created_at'] }}
                                    </td>

                                    <td class="project-actions text-right">
                                        <form action="{{ route('users.destroy', $user['id']) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                <i class="fas fa-trash">
                                                </i>
                                                Удалить
                                            </button>
                                        </form>
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
