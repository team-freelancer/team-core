@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    Cấu hình Website
    </h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a>
    </li>
    <li>
        <a href="{{ url('admin/config') }}"><i class="fa fa-dashboard"></i> Cấu hình Website</a>
    </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            {!! session('message') ? '<div class="alert alert-success">'.session('message').'</div>' : '' !!}
            <div class="box box-primary">
                {!! \Form::open(['url' => url('admin/config/create'), 'method' => 'post']) !!}
                    <div class="box-body">
                        @foreach($configs as $config)
                            <div class="form-group">
                                <label>{{ $config->name }}</label>
                                @if($config->_key == 'slider')
                                <input name="team_files" type="file" multiple class="file-loading team-file-upload" data="{{isset($config) ? $config->_value : ''}}" fieldName="{{$config->_key}}">
                                @elseif($config->_key == 'introduce')
                                {!! \Form::textarea($config->_key, old($config->_key, isset($config) ? $config->_value : ''), ['class' => 'form-control team-use-ck', 'id' => $config->_key]) !!}
                                @else
                                {!! \Form::text($config->_key, old($config->_key, isset($config) ? $config->_value : ''), ['class' => 'form-control']) !!}
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection