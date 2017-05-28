@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    Module
    <small>{{ isset($action) ? $action : 'Thêm' }} module</small>
    </h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a>
    </li>
    <li>
        <a href="{{ url('admin/category') }}"><i class="fa fa-dashboard"></i> Module</a>
    </li>
    <li class="active">
        <a href="#"><i class="fa fa-dashboard"></i> {{ isset($action) ? $action : 'Thêm' }}</a>
    </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        {!! session('message') ? '<div class="alert alert-success">'.session('message').'</div>' : '' !!}
        <div class=" col-lg-12">
            <div class="box box-primary">
                <!-- form start -->
                {!! \Form::open(['url' => isset($module) ? url('admin/module/update/'.$module->id) : url('admin/module/create'), 'method' => 'post']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Tên</label>
                            {!! \Form::text('name', isset($module) ? $module->name : '', ['class' => 'form-control', 'placeholder' => 'Nhập tên module', 'required']) !!}
                            {!! $errors->first('name') ?'<span class="text-error">'.$errors->first('name').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Path</label>
                            {!! \Form::text('path', isset($module) ? $module->path : '', ['class' => 'form-control', 'placeholder' => 'Nhập đường dẫn module']) !!}
                            {!! $errors->first('path') ?'<span class="text-error">'.$errors->first('path').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Icon (Suppost Bootstrap or FontAwesome)</label>
                            {!! \Form::text('icon', isset($module) ? $module->icon : '', ['class' => 'form-control', 'placeholder' => 'fa fa-example']) !!}
                            {!! $errors->first('icon') ?'<span class="text-error">'.$errors->first('icon').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Bảng dữ liệu</label>
                            {!! \Form::text('table_name', isset($module) ? $module->table_name : '', ['class' => 'form-control', 'placeholder' => 'Nhập tên bảng dữ liệu', isset($module) ? 'disabled' : '', 'required']) !!}
                            {!! $errors->first('table_name') ?'<span class="text-error">'.$errors->first('table_name').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Trường dữ liệu</label>
                            <br/>
                            <button type="button" class="btn btn-primary btn-add-field"><i class="fa fa-plus-square"></i></button>
                            @if(isset($module))
                                <?php $i = 0;?>
                                @foreach($elements as $element)
                                    <?php $i ++;?>
                                    <script>var fieldNumb = parseInt('{{$i}}');</script>
                                    <div class="form-inline">
                                        <input type="text" class="form-control" name="field[{{$i}}][title]" placeholder="tiêu đề cột" value="{{ $element->field_title }}" required>
                                        <input type="text" class="form-control" name="field[{{$i}}][name]" placeholder="tên cột" value="{{ $element->field_name }}" required>
                                        {!! \Form::select("field[".$i."][dataType]", config('admin.database.dataType'), $element->data_type, ['class' => 'form-control select-dataType', 'placeholder' => '---Kiểu dữ liệu---', ' required']) !!}
                                        <input type="number" class="form-control" name="field[{{$i}}][length]" placeholder="số ký tự" value="{{ $element->length }}">
                                        <input type="text" class="form-control" name="field[{{$i}}][default]" placeholder="giá trị mặc định" value="{{ $element->default }}">
                                        {!! \Form::select("field[".$i."][formElement]", config('admin.database.formElement'), $element->element, ['class' => 'form-control select-formElement', 'placeholder' => '---Form Element---', ' required']) !!}
                                        @if($element->link)
                                        {!! \Form::text("field[".$i."][link]", $element->link, ['class' => 'form-control select-link', 'placeholder' => 'table.key.value', ' required']) !!}
                                        @endif
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-caret-down"></span> option</button>
                                                <ul class="dropdown-menu">
                                                    <li><input type="checkbox"  name="field[{{$i}}][hidden]" {{ $element->is_hidden == 1 ? 'checked' : ''}}> Ẩn </li>
                                                    <li><input type="checkbox" name="field[{{$i}}][filter]" {{ $element->is_filter == 1 ? 'checked' : ''}}> Bộ lọc </li>
                                                    <li><input type="checkbox"  name="field[{{$i}}][search]" {{ $element->is_search == 1 ? 'checked' : ''}}> Tìm kiếm </li>
                                                    <li><input type="checkbox"  name="field[{{$i}}][manager]" {{ $element->is_manager == 1 ? 'checked' : ''}}> Quản lý </li>
                                                    <li><input type="checkbox"  name="field[{{$i}}][required]" {{ $element->is_required == 1 ? 'checked' : ''}}> Requỉed </li>
                                                    <li><input type="checkbox"  name="field[{{$i}}][unique]" {{ $element->is_unique == 1 ? 'checked' : ''}}> Unique </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <input type="hidden" name="field[{{$i}}][id]" value="{{ $element->id }}">
                                        <input type="hidden" name="field[{{$i}}][old_name]" value="{{ $element->field_name }}">
                                        @if($i != 1)
                                            <button type="button" class="btn btn-danger btn-remove-field-exist" fieldNumb="{{$i}}"><i class="fa fa-trash"></i></button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                            <script>var fieldNumb = 0;</script>
                            <div class="form-inline">
                                <input type="text" class="form-control" name="field[0][title]" placeholder="tiêu đề cột" required>
                                <input type="text" class="form-control" name="field[0][name]" placeholder="tên cột" required>
                                {!! \Form::select("field[0][dataType]", config('admin.database.dataType'), '', ['class' => 'form-control select-dataType', 'placeholder' => '---Kiểu dữ liệu---', 'required']) !!}
                                <input type="number" class="form-control" name="field[0][length]" placeholder="số ký tự">
                                <input type="text" class="form-control" name="field[0][default]" placeholder="giá trị mặc định">
                                {!! \Form::select("field[0][formElement]", config('admin.database.formElement'), '', ['class' => 'form-control select-formElement', 'placeholder' => '---Form Element---', 'required']) !!}
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Option <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><input type="checkbox"  name="field[0][hidden]"> Ẩn </li>
                                            <li><input type="checkbox" name="field[0][filter]"> Bộ lọc </li>
                                            <li><input type="checkbox"  name="field[0][search]"> Tìm kiếm </li>
                                            <li><input type="checkbox"  name="field[0][manager]"> Quản lý </li>
                                            <li><input type="checkbox"  name="field[0][required]"> Requỉed </li>
                                            <li><input type="checkbox"  name="field[0][unique]"> Unique </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                            {{ $errors->first('table_name') ?'<span class="text-error">'.$errors->first('table_name').'</span>' : '' }}
                        </div>
                        @if(!isset($module))
                        <div class="form-group">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="create_controller"> Tạo Controller
                                </label>
                            </div>  
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="is_active" @if(!isset($module) || @$module->is_active) {{'checked'}} @endif> Kích hoạt
                                </label>
                            </div>  
                        </div>
                        @if(!isset($module))
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