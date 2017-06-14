@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    Admin
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
    <li class="active">index</li>
    </ol>
</section>

<section class="content">
    {!! session('message') ? '<div class="alert alert-'.(session('messageType') ? session('messageType') : 'success').'">'.session('message').'</div>' : '' !!}
    @if(isset($statist))
    <div class="row">
        <?php 
            $bg = ['aqua', 'green', 'yellow', 'red'];
        ?>
        @foreach($statist as $name => $data)
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-{{$bg[rand(0, 3)]}}">
                <div class="inner">
                    <h3>{{$data['count']}}</h3>
                    <p>{{$name}}</p>
                </div>
                <div class="icon">
                    <i class="{{$data['icon']}}"></i>
                </div>
                <a href="{{url($data['path'])}}" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
        @endforeach
    </div>
    @endif
</section>

@endsection