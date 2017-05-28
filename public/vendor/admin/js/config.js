var config = {
    datatable: {
        "processing": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 25,
        "bLengthChange": true,
        "bFilter": false,
        "bInfo": false,
        "bSort": false,
        "oLanguage": {
            "oPaginate": {
                "sFirst": 'Đầu',
                "sLast": 'Cuối',
                "sNext": 'Sau',
                "sPrevious": 'Trước'
            },
            "sLengthMenu": "_MENU_ bản ghi",
            "sProcessing": '<center><img src="' + baseUrl + '/../vendor/admin/img/ellipsis.gif"/></center>',
            "sEmptyTable": '<center>Không tìm thấy dữ liệu</center>',
            "sSearch": "Lọc các từ _INPUT_ trong bảng",
            "sInfo": "Có tất cả _TOTAL_ sản phẩm, đang hiển thị từ _START_ đến _END_",
            "sInfoEmpty": "Không có dữ liệu để hiển thị"
        }
    }
}