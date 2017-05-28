@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    Danh mục sản phẩm
    <small>{{ isset($action) ? $action : 'Thêm' }}</small>
    </h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a>
    </li>
    <li>
        <a href="{{ url('admin/category') }}"><i class="fa fa-dashboard"></i> Sản phẩm</a>
    </li>
    <li class="active">
        <a href="#"><i class="fa fa-dashboard"></i> {{ isset($action) ? $action : 'Thêm' }}</a>
    </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            {!! session('message') ? '<div class="alert alert-success">'.session('message').'</div>' : '' !!}
            <div class="box box-primary">
                <!-- form start -->
                {!! \Form::open(['url' => isset($product) ? url('admin/product/update/'.$product->id) : url('admin/product/create'), 'method' => 'post']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Mã SP</label>
                            {!! \Form::text('code', old('code', isset($product) ? $product->code : ''), ['class' => 'form-control']) !!}
                            {!! $errors->first('code') ?'<span class="text-error">'.$errors->first('code').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Tên</label>
                            {!! \Form::text('name', old('name', isset($product) ? $product->name : ''), ['class' => 'form-control', 'placeholder' => 'Nhập tên']) !!}
                            {!! $errors->first('name') ?'<span class="text-error">'.$errors->first('name').'</span>' : '' !!}
                        </div>
                        
                        <div class="form-group">
                            <label>Dòng xe</label>
                            {!! \Form::select('car_id', $cars, old('car_id', isset($product) ? $product->car_id : ''), ['class' => 'form-control', 'id' => 'car-select', 'placeholder' => '---Chọn dòng xe---']) !!}
                            {!! $errors->first('car_id') ?'<span class="text-error">'.$errors->first('car_id').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Nhóm</label>
                            {!! \Form::select('group_id', $groups, old('group_id', isset($product) ? $product->group_id : ''), ['class' => 'form-control', 'id' => 'group-select', 'placeholder' => '---Chọn nhóm---']) !!}
                            {!! $errors->first('group_id') ?'<span class="text-error">'.$errors->first('group_id').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Phụ tùng</label>
                            {!! \Form::select('adapter_id', [], old('type3', isset($product) ? $product->adapter_id : ''), ['class' => 'form-control', 'id' => 'adapter-select', 'placeholder' => '---Chọn phụ tùng---']) !!}
                            {!! $errors->first('adapter_id') ?'<span class="text-error">'.$errors->first('adapter_id').'</span>' : '' !!}
                        </div>

                        <div class="form-group">
                            <label>Giá</label>
                            {!! \Form::number('price', old('price', isset($product) ? $product->price : ''), ['class' => 'form-control', 'placeholder' => 'VND']) !!}
                            {!! $errors->first('price') ?'<span class="text-error">'.$errors->first('price').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Số lượng</label>
                            {!! \Form::number('numb', old('numb', isset($product) ? $product->numb : ''), ['class' => 'form-control', 'placeholder' => 'Chiếc']) !!}
                            {!! $errors->first('numb') ?'<span class="text-error">'.$errors->first('numb').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            {!! \Form::textarea('description', old('description', isset($product) ? $product->description : ''), ['class' => 'form-control team-use-ck', 'id' => 'description']) !!}
                            {!! $errors->first('description') ?'<span class="text-error">'.$errors->first('description').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            <input name="team_files" type="file" multiple class="file-loading team-file-upload" title="Upload ảnh sản phẩm" data="{{isset($product) ? $product->images : ''}}" fieldName="images">
                            {!! $errors->first('images') ?'<span class="text-error">'.$errors->first('images').'</span>' : '' !!}
                        </div>
                        <div class="form-group">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="is_active" @if(!isset($product) || @$product->is_active) {{'checked'}} @endif> Kích hoạt
                                </label>
                            </div>  
                        </div>
                        @if(!isset($product))
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
                    <button type="submit" class="btn btn-primary">{{ isset($action) ? $action : 'Thêm' }} sản phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $('#group-select').change(function(){
        var groupID = $(this).val();
        if(groupID == ''){
            return $('#adapter-select').html('<option>---Chọn phụ tùng---</option>');
        }
        getAdapter(groupID);
    });
    function getAdapter(groupID){
        $.ajax({
            url: baseUrl + '/get-adapter-by-group/' +groupID,
            type: 'GET',
            success: function(res){
                var html = '';
                for(var i = 0; i< res.length; i++){
                    if(res[i].id == '{{@$product->adapter_id}}'){
                        html += '<option value="'+res[i].id+'" selected>'+res[i].name+'</option>';
                    }else{
                        html += '<option value="'+res[i].id+'">'+res[i].name+'</option>';
                    }
                }
                return $('#adapter-select').html(html);
            }
        })
    }
    @if(isset($product))
    getAdapter('{{$product->group_id}}');
    @endif
</script>
@endsection