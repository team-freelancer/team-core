@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    MENU
    <small>Menu</small>
    </h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a>
    </li>
    <li class="active">
        <a href="{{ url('admin/menu') }}"><i class="fa fa-dashboard"></i> Quản lý Menu</a>
    </li>
    </ol>
</section>

<section class="content">
    Content
</section>

@endsection