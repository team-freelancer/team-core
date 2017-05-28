@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    {{ $name }}
    <small>{{ isset($action) ? $action : 'Thêm' }} {{ $name }}</small>
    </h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a>
    </li>
    <li>
        <a href="{{ url('admin/category') }}"><i class="fa fa-dashboard"></i> Quản lý {{ $name }}</a>
    </li>
    <li class="active">
        <a href="#"><i class="fa fa-dashboard"></i> {{ isset($action) ? $action : 'Thêm' }} {{ $name }}</a>
    </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            {!! session('message') ? '<div class="alert alert-success">'.session('message').'</div>' : '' !!}
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" method="POST" action="">
                {!! \Form::open(['url' => isset($category) ? url('admin/category/update/'.$category->id) : url('admin/category/create'), 'method' => 'post']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Tên</label>
                            {!! \Form::text('name', old('name', isset($category) ? $category->name : ''), ['required', 'class' => 'form-control', 'placeholder' => 'Nhập tiêu đề']) !!}
                            {{ $errors->first('name') ?'<span class="text-error">'.$errors->first('name').'</span>' : '' }}
                        </div>
                        @if(isset($groups))
                        <div class="form-group">
                            <label>Nhóm</label>
                            {!! \Form::select('group_id', $groups, old('group_id', isset($category) ? $category->group_id : ''), ['required', 'class' => 'form-control', 'placeholder' => '---Chọn nhóm---', 'id' => 'group-select']) !!}
                            {{ $errors->first('group_id') ?'<span class="text-error">'.$errors->first('group_id').'</span>' : '' }}
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="is_active" @if(!isset($category) || @$category->is_active) {{'checked'}} @endif> Kích hoạt
                                </label>
                            </div>  
                        </div>
                        @if(!isset($category))
                        <div class="form-group">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="much" checked> Thêm nhiều
                                </label>
                            </div>  
                        </div>
                        @endif
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{ isset($action) ? $action : 'Thêm' }} danh mục</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection