@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    {{ $module->name }}
    <small>{{ isset($action) ? $action : 'Thêm' }} {{ $module->name }}</small>
    </h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a>
    </li>
    <li>
        <a href="{{ url('admin/module') }}"><i class="fa fa-dashboard"></i> Module</a>
    </li>
    <li>
        <a href="{{ url('admin/module/'.$module->path) }}"><i class="fa fa-dashboard"></i> {{ $module->name }}</a>
    </li>
    <li class="active">
        <a href="#"><i class="fa fa-dashboard"></i> {{ isset($action) ? $action : 'Thêm' }}</a>
    </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class=" col-lg-12">
            {!! session('message') ? '<div class="alert alert-success">'.session('message').'</div>' : '' !!}
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" method="POST" action="">
                {!! \Form::open(['url' => isset($record) ? url('admin/module/'.$module->path.'\/update/'.$record->id) : url('admin/module/'.$module->path.'/create'), 'method' => 'post']) !!}
                    <div class="box-body">
                        {!! $form !!}
                        @if(!isset($model))
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
                    <button type="submit" class="btn btn-primary">{{ isset($action) ? $action : 'Thêm' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection