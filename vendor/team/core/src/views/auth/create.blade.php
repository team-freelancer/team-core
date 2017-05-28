@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    Admin
    <small>{{ isset($action) ? $action : 'Thêm' }} danh mục</small>
    </h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a>
    </li>
    <li>
        <a href="{{ url('admin/manager') }}"><i class="fa fa-dashboard"></i> Quản lý Admin</a>
    </li>
    <li class="active">
        <a href="#"><i class="fa fa-dashboard"></i> {{ isset($action) ? $action : 'Thêm' }} admin</a>
    </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            {!! session('message') ? '<div class="alert alert-success">'.session('message').'</div>' : '' !!}
            <div class="box box-primary">
                <!-- form start -->
                {!! \Form::open(['url' => isset($adminUser) ? url('admin/manager/update/'.$adminUser->id) : url('admin/manager/create'), 'method' => 'post']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Tên</label>
                            {!! \Form::text('name', old('name', isset($adminUser) ? $adminUser->name : ''), ['class' => 'form-control', 'placeholder' => 'Nhập tên']) !!}
                            {!! $errors->first('name') ?'<span class="text-error">'.$errors->first('name').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            {!! \Form::text('email', old('email', isset($adminUser) ? $adminUser->email : ''), ['class' => 'form-control', 'placeholder' => 'Nhập email']) !!}
                            {!! $errors->first('email') ?'<span class="text-error">'.$errors->first('email').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            {{-- {!! \Form::password('password', old('email', isset($adminUser) ? $adminUser->password : ''), ['class' => 'form-control', 'placeholder' => 'Nhập password']) !!} --}}
                            <input type="password" name="password" class="form-control" {{ !isset($adminUser) ? 'required' : ''}}>
                            {!! $errors->first('password') ?'<span class="text-error">'.$errors->first('password').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Avatar</label>
                            <input name="team_files" type="file" class="file-loading team-file-upload" data="{{isset($adminUser) ? $adminUser->avatar : ''}}" fieldName="avatar">
                        </div>
                        <div class="form-group">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="active" @if(!isset($adminUser) || @$adminUser->active) {{'checked'}} @endif> Kích hoạt
                                </label>
                            </div>  
                        </div>
                        @if(!isset($adminUser))
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
                    <button type="submit" class="btn btn-primary">{{ isset($action) ? $action : 'Thêm' }} admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection