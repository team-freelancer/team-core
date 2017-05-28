@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    Danh mục sản phẩm
    <small>{{ isset($action) ? $action : 'Thêm' }} danh mục</small>
    </h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a>
    </li>
    <li>
        <a href="{{ url('admin/new') }}"><i class="fa fa-dashboard"></i> Quản lý danh mục</a>
    </li>
    <li class="active">
        <a href="#"><i class="fa fa-dashboard"></i> {{ isset($action) ? $action : 'Thêm' }} danh mục</a>
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
                {!! \Form::open(['url' => isset($new) ? url('admin/new/update/'.$new->id) : url('admin/new/create'), 'method' => 'post']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            {!! \Form::text('title', old('title', isset($new) ? $new->title : ''), ['class' => 'form-control', 'placeholder' => 'Nhập tiêu đề']) !!}
                            {{ $errors->first('title') ?'<span class="text-error">'.$errors->first('title').'</span>' : '' }}
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            {!! \Form::textarea('description', old('description', isset($new) ? $new->description : ''), ['class' => 'form-control', 'placeholder' => 'Nhập mô tả']) !!}
                            {{ $errors->first('description') ?'<span class="text-error">'.$errors->first('description').'</span>' : '' }}
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            {!! \Form::textarea('content', old('content', isset($new) ? $new->content : ''), ['class' => 'form-control team-use-ck', 'id' => 'content']) !!}
                            {{ $errors->first('content') ?'<span class="text-error">'.$errors->first('content').'</span>' : '' }}
                        </div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            <input name="team_files" type="file" multiple class="file-loading team-file-upload" title="Upload ảnh tin tức" data="{{isset($new) ? $new->image : ''}}" fieldName="image">
                        </div>
                        <div class="form-group">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="is_active" @if(!isset($new) || @$new->is_active) {{'checked'}} @endif> Kích hoạt
                                </label>
                            </div>  
                        </div>
                        @if(!isset($new))
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
                    <button type="submit" class="btn btn-primary">{{ isset($action) ? $action : 'Thêm' }} tin tức</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection