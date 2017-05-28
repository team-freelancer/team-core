@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    MENU
    <small>{{ isset($action) ? $action : 'Thêm' }} Menu</small>
    </h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a>
    </li>
    <li class="active">
        <a href="{{ url('admin/menu') }}"><i class="fa fa-dashboard"></i> Quản lý Menu</a>
    </li>
    <li class="active">
        <a href="{{ url('admin/menu') }}"><i class="fa fa-dashboard"></i> {{ isset($action) ? $action : 'Thêm' }} Menu</a>
    </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" method="POST" action="">
                {!! \Form::open(['url' => isset($menu) ? url('admin/menu/update/'.$menu->id) : url('admin/menu/create'), 'method' => 'post']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            {!! \Form::text('title', old('title', isset($menu) ? $menu->title : ''), ['class' => 'form-control', 'placeholder' => 'Nhập tiêu đề']) !!}
                            {{ $errors->first('title') ?'<span class="text-error">'.$errors->first('title').'</span>' : '' }}
                        </div>
                        <div class="form-group">
                            <label>Icon (Suppost Bootstrap or FontAwesome)</label>
                            {!! \Form::text('icon', old('icon', isset($menu) ? $menu->icon : ''), ['class' => 'form-control', 'placeholder' => 'fa fa-example']) !!}
                            {{ $errors->first('icon') ?'<span class="text-error">'.$errors->first('icon').'</span>' : '' }}
                        </div>
                        <div class="form-group">
                            <label>Style (Javascript Object)</label>
                            {!! \Form::textarea('style', old('style', isset($menu) ? $menu->style : ''), ['class' => 'form-control', 'placeholder' => "{background: 'red', color: '#FF0000'}"]) !!}
                            {{ $errors->first('style') ?'<span class="text-error">'.$errors->first('style').'</span>' : '' }}
                        </div>
                        <div class="form-group">
                            <label>Kiểu</label>
                            {!! \Form::select('type', [1 => 'Landing Page', 2 => 'Liên kết đến bảng'], old('type', isset($menu) ? $menu->type : ''), ['class' => 'form-control', 'id' => 'menu-type']) !!}
                            {{ $errors->first('type') ?'<span class="text-error">'.$errors->first('type').'</span>' : '' }}
                        </div>
                        <div class="form-group">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="is_active" @if(!isset($menu) || @$menu->is_active) {{'checked'}} @endif> Kích hoạt
                                </label>
                            </div>  
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{ isset($action) ? $action : 'Thêm' }} menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection