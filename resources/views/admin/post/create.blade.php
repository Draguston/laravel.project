@extends('layouts.admin_layout')

@section('title', 'Добавить пост')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Добавить пост</h1>
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
                    <form action="{{ route('post.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Название поста</label>
                                <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Введите название поста" required>
                            </div>
                            <div class="form-group">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Выберите категорию</label>
                                    <select name="cat_id" class="form-control" required>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['title'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="text" class="edit"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="feature_image">Изображение</label>
                                <img src="" alt="" class="img-uploaded" style="display: block" width="400px">
                                <input type="text" name="image" class="form-control" id="feature_image" name="feature_image" value="" readonly>
                                <a href="" class="popup_selector" data-inputid="feature_image">Выбрать изображение</a>
                            </div>
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Добавить</button>
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