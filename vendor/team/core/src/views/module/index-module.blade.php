@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    {{ $module->name }}
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
    <li class="active">Module</li>
    <li class="active">{{ $module->name }}</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        {!! session('message') ? '<div class="alert alert-success">'.session('message').'</div>' : '' !!}
        <div class="box-header">
            <h3 class="box-title">Danh sách {{ $module->name }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <form class="form-inline filter-post" role="form" method="post">
                @foreach($elements['search'] as $s)
                    <input class="form-control" name="{{$s->field_name}}" placeholder="Tìm kiếm theo {{$s->field_title}}" type="text" id="{{$s->field_name}}-val">
                @endforeach

                @foreach($elements['filter'] as $f)
                    {!! \Form::select($f->field_name, $f->data, '', ['class' => 'form-control', 'id' => $f->field_name.'-val', 'placeholder' => '---Hiển thị tất cả---']) !!}
                @endforeach

                <button class="btn btn-success" type="submit" id="filter"><i class="fa fa-search fa-fw"></i>Lọc</button>
                <a href="{{ url('admin/module/'.$module->path.'/create') }}" class="btn btn-info"><i class="fa fa-plus fa-fw"></i>Thêm</a>
            </form>
        </div>
        <div class="box-body">
            <table id="team-datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        @foreach($elements['dtColumns'] as $k => $v)
                            <th>{{ $v }}</th>
                        @endforeach
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section>

<script type="text/javascript">
    var elements = JSON.parse('{{json_encode($elements)}}'.replace(/&quot;/g, '"'));
    config.datatable.serverSide = true;
    config.datatable.deferRender = true;
    config.datatable.ajax = {
        url: "{{url('admin/api/module/'.$module->path)}}",
        type: 'POST',
        data: function(d){
            var filter = {
                _token: '{{ csrf_token() }}'
            };
            for(var i = 0; i < elements.search.length; i ++){
                filter[elements.search[i].field_name] = $('#'+elements.search[i].field_name+'-val').val();
            }
            for(var i = 0; i < elements.filter.length; i ++){
                filter[elements.filter[i].field_name] = $('#'+elements.filter[i].field_name+'-val').val();
            }
            return $.extend( {}, d, filter);
        }
    };
    
    config.datatable.fnDrawCallback = function (oSettings) {
        
    };
    config.datatable.columns = [
        {
            data: 'id',
            render: function(data){
                return '<input type="checkbox"/>';
            }
        }
    ];
    for(let key in elements.dtColumns){
        config.datatable.columns.push({
            data: key,
            render: function(data, type, full, meta){
                for(let i = 0; i < elements.filter.length; i++){
                    if(key == elements.filter[i].field_name){
                        if(elements.filter[i].data[data]){
                            return elements.filter[i].data[data];
                        }
                    }
                }
                switch(elements.dtElements[key]){
                    case 0:
                        return data;
                        break;
                    case 6:
                        return data == 1 ? '<span class="fa fa-check-circle-o text-success"></span>' : '<span class="fa fa-ban text-danger"></span>';
                        break;
                    case 9:
                    case 10:
                        return '<img width="100" src="'+baseUrl+'/../'+JSON.parse(data)[0].thumb+'"/>';
                        break;
                    default:
                        return data;
                        break;
                }
            }
        });
    }
    config.datatable.columns.push(
        {
            data: 'id',
            render: function(data, type, row){
                var html = '<div class="btn-group btn-group-sm" role="group" aria-label="...">'
                html += '<a href="{{url("admin/module/$module->path/update")}}/'+data+'" class="btn btn-warning"><i class="fa fa-edit"></i></button>'
                html += '<a href="{{url("admin/module/$module->path/delete")}}/'+data+'"  class="btn btn-danger"><i class="fa fa-trash"></i></button>'
                html += '</div>'
                return html;
            }
        }
    );
    var table = $('#team-datatable').DataTable(config.datatable);
    $('.filter-post').on('submit', function(e){
        e.preventDefault();
        table.ajax.reload();
    });
</script>
@endsection