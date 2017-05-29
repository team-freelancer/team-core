$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function applyIcheck(){
        $(document).find('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    }
    applyIcheck();
    $('#menu-type').on('change', function(){
        if($(this).val() == 1){
            if($('#menu-link_to')[0]){
                $('#menu-link_to').attr('disabled', '');
                $('#menu-link_to').parent().hide();
            }
        }
        if($(this).val() == 2){
            if($('#menu-link_to')[0]){
                $('#menu-link_to').removeAttr('disabled');
                $('#menu-link_to').parent().show();
            }else{
                $.ajax({
                    url: baseUrl + '/api/table',
                    type: 'POST',
                    dataType: 'html',
                    success: function(response){
                        $(response).insertAfter($('#menu-type').parent());
                    }
                });
            }
        }
    });
    $('.team-'+activeMenu).addClass('active');
    $('.team-child-' + activeChild).addClass('menu-open').css('display','block');

    $('.team-use-ck').each(function(i){
        CKEDITOR.replace($(this).attr('id'), {
            height: 350
        });
    });
    /*module*/
    $('.btn-add-field').click(function(){
        fieldNumb ++;
        var selectDataType = $('.form-inline').find('.select-dataType')[0].outerHTML;
        var selectFormElement = $('.form-inline').find('.select-formElement')[0].outerHTML;
        var html = '<div class="form-inline f-numb-'+fieldNumb+'">';
        html += '<input type="text" class="form-control" name="field['+fieldNumb+'][title]" placeholder="tiêu đề cột" required> ';
        html += '<input type="text" class="form-control" name="field['+fieldNumb+'][name]" placeholder="tên cột" required> ';
        html += selectDataType + ' ';
        html += '<input type="number" class="form-control" name="field['+fieldNumb+'][length]" placeholder="số ký tự"> ';
        html += '<input type="text" class="form-control" name="field['+fieldNumb+'][default]" placeholder="giá trị mặc định"> ';
        html += selectFormElement + ' ';

        html += '<div class="input-group">';
        html += '<div class="input-group-btn">';
        html += '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-caret-down"></span> option</button>';
        html += '<ul class="dropdown-menu">';
        html += '<li><input type="checkbox"  name="field['+fieldNumb+'][hidden]"> Ẩn </li>';
        html += '<li><input type="checkbox" name="field['+fieldNumb+'][filter]"> Bộ lọc </li>';
        html += '<li><input type="checkbox"  name="field['+fieldNumb+'][search]"> Tìm kiếm </li>';
        html += '<li><input type="checkbox"  name="field['+fieldNumb+'][manager]"> Quản lý </li>';
        html += '<li><input type="checkbox"  name="field['+fieldNumb+'][required]"> Required </li>';
        html += '<li><input type="checkbox"  name="field['+fieldNumb+'][unique]"> Unique </li>';
        html += '</ul></div></div> ';

        html += '<button type="button" class="btn btn-danger btn-remove-field"><i class="fa fa-trash"></i></button> ';
        html += '</div>';
        $(this).parent().append(html);
        $(this).parent().find('.f-numb-'+fieldNumb+' .select-dataType').val('').attr('name', "field["+fieldNumb+"][dataType]");
        $(this).parent().find('.f-numb-'+fieldNumb+' .select-formElement').val('').attr('name', "field["+fieldNumb+"][formElement]");
        applyIcheck();
    });
    $(document).on('click', '.btn-remove-field', function(){
        $(this).parent().remove();
    });
    $(document).on('click', '.btn-remove-field-exist', function(){
        var i = $(this).attr('fieldNumb');
        $(this).parent().append('<input type="hidden" name="field['+i+'][is_drop]" value="true"/>');
        $(this).parent().hide()
    });
    $('.team-file-upload').each(function(){
        $(this).parent().append('<input type="hidden" name="'+$(this).attr('fieldName')+'"/>');
        var input = $(this).parent().find('[type=hidden]');
        
        var defaultData = [], 
            initialPreview = [],
            initialPreviewConfig = [];
        if($(this).attr('data') != ''){
            defaultData = JSON.parse($(this).attr('data').replace("'", '"'));
        }
        input.val(JSON.stringify(defaultData));
        var result = input.val() == '' ? [] : JSON.parse(input.val());
        for (var i = 0; i < defaultData.length; i ++) {
            initialPreview.push(baseUrl + '/../' + defaultData[i].largest);
            initialPreviewConfig.push({
                caption : defaultData[i].largest,
                url : baseUrl + '/api/delete/file',
                key : "{'largest': '"+defaultData[i].largest+"', 'thumb': 'thumbs/"+ defaultData[i].thumb.replace('public/', '') +"'}",
                append : true
            });
        }

        if($(this).attr('data') != ''){
            defaultData = JSON.parse($(this).attr('data'));
        }
        $(this).fileinput({
            initialPreview: initialPreview,
            initialPreviewConfig: initialPreviewConfig,
            initialPreviewAsData: true,
            uploadUrl: baseUrl + "/api/upload",
            overwriteInitial: false,
            initialCaption: 'File uploader by Team',
            allowedFileTypes: ["image", "video"],
            maxFileSize: 4096,
            fileActionSettings: {
                showUpload:true
            }
        });
        $(this).on('fileuploaded', function(event, data, previewId, index) {
            var response = data.response.initialPreviewConfig;
            for (var i = 0; i < response.length; i ++) {
                var key = JSON.parse(response[i].key.replace(/'/g, '"'));
                result.push(key);
            }
            input.val(JSON.stringify(result));
        });
        $(this).on('filedeleted', function(event, data, jqXHR, key) {
            result = result.filter(function(ele){
                return ele.largest != jqXHR.responseJSON.largest
            });
            input.val(JSON.stringify(result));
        });
    });

    $(document).on('change', '.select-formElement', function(){
        if($(this).val() == 11){
            $(' <input type="text" class="form-control" name="field['+fieldNumb+'][link]" placeholder="table.key.value"/> ').insertAfter($(this));
        }else{
            $(document).find('[name="field['+fieldNumb+'][link]"]').remove();
        }
    });

    $(document).on('ifChecked', '.check-all-crud', function(){
        $(this).parent().parent().parent().find('[type=checkbox]').prop('checked',true).iCheck('update');
    });
    $(document).on('ifUnchecked', '.check-all-crud', function(){
        $(this).parent().parent().parent().find('[type=checkbox]').prop('checked',false).iCheck('update');
    });

    $(document).on('ifChecked', '.check-column', function(){
        var cl = $(this).attr('id');
        $('.'+cl).prop('checked',true).iCheck('update');
    });
    $(document).on('ifUnchecked', '.check-column', function(){
        var cl = $(this).attr('id');
        $('.'+cl).prop('checked',false).iCheck('update');
    });
    
});
