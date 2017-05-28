@extends('admin::layout')

@section('content')

<section class="content-header">
    <h1>
    Đơn hàng
    {{-- <small>Control panel</small> --}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
    <li class="active">Đơn hàng</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        {!! session('message') ? '<div class="alert alert-success">'.session('message').'</div>' : '' !!}
        <div class="box-header">
            <h3 class="box-title">Danh sách đơn hàng</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <form class="form-inline filter-post" role="form" method="post">
                <?php
                    
                ?>
                {!! \Form::text('fullname', '', ['class' => 'form-control', 'id' => 'name-val', 'placeholder' => '---Tất cả khách hàng---'])!!}
                {!! \Form::select('status', ['Đang chờ duyệt', 'Đang giao hàng', 'Đã nhận hàng'], '', ['class' => 'form-control', 'id' => 'status-select', 'placeholder' => '---Tất cả---'])!!}
                <button class="btn btn-success" type="submit" id="filter"><i class="fa fa-search fa-fw"></i>Lọc</button>
            </form>
        </div>
        <div class="box-body">
            <table id="team-datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Địa chỉ</th>
                        <th>SĐT</th>
                        <th>Sản phẩm</th>
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
        url: "{{url('admin/api/cart')}}",
        type: 'POST',
        data: function(d){
            var filter = {
                fullname: $('#name-val').val(),
                status: $('#status-select').val(),
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
            data: 'fullname'
        },
        {
            data: 'address'
        },
        {
            data: 'mobile'
        },
        {
            data: 'products',
            render: function(data){
                try{
                    var html = '<table border="1" style="width: 100%">';
                    html += '<tr><td>ảnh</td><td>tên SP</td><td>SL</td><td>thành tiền</td></tr>';
                    var data = JSON.parse(data);
                    for(var i = 0; i < data.length; i++){
                        html += '<tr>';
                        html += '<td><img width="70" src="'+baseUrl+'/../storage/'+data[i].product_image+'" /></td>';
                        html += '<td>'+data[i].product_name+'</td>';
                        html += '<td>'+data[i].numb+'</td>';
                        if(data[i].product_price == 0){
                            html += '<td>Liên hệ</td>';
                        }else{
                            html += '<td>'+data[i].numb * data[i].product_price +'</td>';
                        }
                        html += '</tr>';
                    }
                    html += '</table>';
                    return html;
                }
                catch(e){
                    return 'Ko có sản phẩm';
                }
            }
        },
        {
            data: 'status',
            render: function(data, type, full){
                switch(data){
                    case 0:
                        return '<a class="btn btn-warning btn-xs" href="'+baseUrl+'/cart/'+full.id+'/status/1"><i class="fa fa-ellipsis-h"></i> Đang chờ duyệt</a>';
                        break;
                    case 1:
                        return '<a class="btn btn-info btn-xs" href="'+baseUrl+'/cart/'+full.id+'/status/2"><i class="fa fa-truck"></i> Đang chuyển hàng</a>';
                        break;
                    case 2:
                        return '<a class="btn btn-success btn-xs" href="#"><i class="fa fa-check"></i> Đã giao hàng</a>';
                        break;
                }
            }
        },
        {
            data: 'id',
            render: function(data, type, row){
                var html = '<div class="btn-group btn-group-sm" role="group" aria-label="...">'
                //html += '<a href="{{url("admin/cart/update")}}/'+data+'" class="btn btn-warning"><i class="fa fa-edit"></i></button>'
                html += '<a href="{{url("admin/cart/delete")}}/'+data+'"  class="btn btn-danger"><i class="fa fa-trash"></i></button>'
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