@extends('layouts.admin_layout') 

@section('title', 'Главная')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Главная</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i
                            class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Лайков</span>
                        <span class="info-box-number" style="color: red">Не задействованы</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Постов</span>
                        <span class="info-box-number">{{ $posts_count }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Категорий</span>
                        <span class="info-box-number">{{ $category_count }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Сообщений</span>
                        <span class="info-box-number" style="color: red">Не задействованы</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Участников</span>
                        <span class="info-box-number"> {{ $users_count }} </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->
@endsection