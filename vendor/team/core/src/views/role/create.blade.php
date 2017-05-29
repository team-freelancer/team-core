@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    Quyền
    <small>{{ isset($action) ? $action : 'Thêm' }} quyền</small>
    </h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a>
    </li>
    <li class="active">
        <a href="{{ url('admin/menu') }}"><i class="fa fa-dashboard"></i> Quản lý quyền hạn</a>
    </li>
    <li class="active">
        <a href="{{ url('admin/menu') }}"><i class="fa fa-dashboard"></i> {{ isset($action) ? $action : 'Thêm' }} quyền</a>
    </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="box box-primary">
                <!-- form start -->
                {!! \Form::open(['url' => isset($role) ? url('admin/role/update/'.$role->id) : url('admin/role/create'), 'method' => 'post']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Tên</label>
                            {!! \Form::text('name', old('name', isset($role) ? $role->name : ''), ['class' => 'form-control', 'placeholder' => 'Nhập tên']) !!}
                            {!! $errors->first('name') ?'<span class="text-error">'.$errors->first('name').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="super_admin" @if(@$role->super_admin) {{'checked'}} @endif> Super Admin
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Quản lý</label>
                            <table class="table table-striped table-hover table-bordered">
							<thead>
								<tr class="active">
									<th width="3%">No.</th><th width="60%">Tên module</th><th>&nbsp;</th><th>Xem</th><th>Thêm</th><th>Sửa</th><th>Xóa</th>
								</tr>
								<tr class="info">
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<td align="center"><input title="Check all vertical" type="checkbox" id="is_view" class="check-column"></td>
									<td align="center"><input title="Check all vertical" type="checkbox" id="is_create" class="check-column"></td>
									<td align="center"><input title="Check all vertical" type="checkbox" id="is_update" class="check-column"></td>
									<td align="center"><input title="Check all vertical" type="checkbox" id="is_delete" class="check-column"></td>
								</tr>
							</thead>
							<tbody>
                                <?php $i = 0;?>
                                @foreach($modules as $module)
                                <?php $i ++;?>
								<tr>
									<td>{{$i}}</td>
									<td>{{$module->name}}</td>
                                    <input type="hidden" name="map[{{$i}}][module_id]" value="{{$module->id}}">
									<td class="info" align="center"><input type="checkbox" title="Check All Horizontal" class="check-all-crud"></td>
									<td class="active" align="center"><input type="checkbox" class="is_view" name="map[{{$i}}][is_view]" value="1" {{@$maps[$module->id]['is_view']?'checked':'' }}></td>
									<td class="warning" align="center"><input type="checkbox" class="is_create" name="map[{{$i}}][is_create]" value="1" {{@$maps[$module->id]['is_create']?'checked':'' }}></td>								
									<td class="success" align="center"><input type="checkbox" class="is_update" name="map[{{$i}}][is_update]" value="1" {{@$maps[$module->id]['is_update']?'checked':'' }}></td>
									<td class="danger" align="center"><input type="checkbox" class="is_delete" name="map[{{$i}}][is_delete]" value="1" {{@$maps[$module->id]['is_delete']?'checked':'' }}></td>
								</tr>
                                @endforeach
							</tbody>
						</table>
                        </div>
                        <div class="form-group">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="is_active" @if(!isset($role) || @$role->is_active) {{'checked'}} @endif> Kích hoạt
                                </label>
                            </div>  
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{ isset($action) ? $action : 'Thêm' }} quyền</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection