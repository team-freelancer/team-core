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
    Content
</section>

@endsection