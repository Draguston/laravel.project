@extends('layouts.admin_layout')

@section('title', 'Редактирование категории')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Редактирование категории: {{ $category['title'] }}</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        @if (session('success'))
                <div class="col-lg-7">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                    </div>
                </div>
            @endif
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-lg-7">
                <div class="card card-primary">
                    <!-- form start -->
                    <form action="{{ route('category.update', $category['id']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Название категории</label>
                                <input type="text" value="{{ $category['title'] }}" name="title" class="form-control" placeholder="Введите название категории" required>
                            </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Обновить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->
@endsection