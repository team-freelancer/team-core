@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    Tin tức
    {{-- <small>Control panel</small> --}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
    <li class="active">Tin tức</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        {!! session('message') ? '<div class="alert alert-success">'.session('message').'</div>' : '' !!}
        <div class="box-header">
            <h3 class="box-title">Danh sách Tin tức</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <form class="form-inline filter-post" role="form" method="post">
                <input class="form-control" name="title" placeholder="Tìm kiếm theo tiêu đề" type="text" id="title-val">
                <button class="btn btn-success" type="submit" id="filter"><i class="fa fa-search fa-fw"></i>Lọc</button>
                <a href="{{ url('admin/new/create') }}" class="btn btn-info"><i class="fa fa-plus fa-fw"></i>Thêm tin tức</a>
            </form>
        </div>
        <div class="box-body">
            <table id="team-datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section>
<script type="text/javascript">
    config.datatable.serverSide = true;
    config.datatable.ajax = {
        url: "{{url('admin/api/new')}}",
        type: 'POST',
        data: function(d){
            var filter = {
                title: $('#title-val').val(),
                _token: '{{ csrf_token() }}'
            };
            return $.extend( {}, d, filter);
        }
    };
    config.datatable.fnDrawCallback = function (oSettings) {
        
    };
    config.datatable.columns = [
        {
            data: 'id',
            render: function(data, type, row){
                return '<input class="checkdel" del-id="'+data+'" type="checkbox"/>';
            }
        },
        {
            data: 'image',
            render: function(data){
                try{
                    var data = JSON.parse(data);
                    return '<img src="'+baseUrl + '/../storage/' + data[0].thumb+'" width="100"/>'
                }
                catch(e){
                    return 'No Image';
                }
            }
        },
        {
            data: 'title'
        },
        {
            data: 'is_active',
            render: function(data){
                if(data == 1){
                    return '<i class="fa fa-check-circle text-success"></i>';
                }
                return '<i class="fa fa-lock text-danger"></i>'
            }
        },
        {
            data: 'id',
            render: function(data, type, row){
                var html = '<div class="btn-group btn-group-sm" role="group" aria-label="...">'
                html += '<a href="{{url("admin/new/update")}}/'+data+'" class="btn btn-warning"><i class="fa fa-edit"></i></button>'
                html += '<a href="{{url("admin/new/delete")}}/'+data+'"  class="btn btn-danger"><i class="fa fa-trash"></i></button>'
                html += '</div>'
                return html;
            }
        }
    ];
    
    var table = $('#team-datatable').DataTable(config.datatable);
    $('.filter-post').on('submit', function(e){
        e.preventDefault();
        table.ajax.reload();
    });
</script>
@endsection