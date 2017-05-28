var _cs = window._cs || {};
_cs.chatBox = "";
_cs.chatBox += "<div class=\"chat-window col-xs-5 col-md-3\" id=\"chat_window_1\">";
_cs.chatBox += "    <div class=\"col-xs-12 col-md-12\">";
_cs.chatBox += "    	<div class=\"panel panel-default\">";
_cs.chatBox += "            <div class=\"panel-heading top-bar\">";
_cs.chatBox += "                <div class=\"col-md-8 col-xs-8\">";
_cs.chatBox += "                    <span class=\"glyphicon glyphicon-comment\"><\/span>  <span class=\"panel-title\">Chat Service<\/span>";
_cs.chatBox += "                <\/div>";
_cs.chatBox += "                <div class=\"col-md-4 col-xs-4\" style=\"text-align: right;\">";
_cs.chatBox += "                    <a href=\"#\"><span id=\"minim_chat_window\" class=\"glyphicon glyphicon-minus icon_minim\"><\/span><\/a>";
_cs.chatBox += "                    <a href=\"#\"><span class=\"glyphicon glyphicon-remove icon_close\" data-id=\"chat_window_1\"><\/span><\/a>";
_cs.chatBox += "                <\/div>";
_cs.chatBox += "            <\/div>";
_cs.chatBox += "            <div class=\"panel-body msg_container_base\">";
_cs.chatBox += "                ";
_cs.chatBox += "            <\/div>";
_cs.chatBox += "            <div class=\"panel-footer\">";
_cs.chatBox += "                <div class=\"input-group\">";
_cs.chatBox += "                    <input id=\"btn-input\" type=\"text\" class=\"form-control input-sm chat_input\" placeholder=\"Write your message here...\" \/>";
_cs.chatBox += "                    <span class=\"input-group-btn\">";
_cs.chatBox += "                    <button class=\"btn btn-primary btn-sm\" id=\"btn-chat\">Send<\/button>";
_cs.chatBox += "                    <\/span>";
_cs.chatBox += "                <\/div>";
_cs.chatBox += "            <\/div>";
_cs.chatBox += "		<\/div>";
_cs.chatBox += "    <\/div>";
_cs.chatBox += "<\/div>";
_cs.styleCommon = '<link rel="stylesheet" href="http://localhost:4200/assets/css/chatbox.css">';
_cs.styleBootstrap = '<link rel="stylesheet" href="http://localhost:4200/assets/css/bootstrap.min.css">';
(function() {
    var script = document.createElement("SCRIPT");
    script.src = 'http://localhost:4200/assets/js/require.js';
    script.type = 'text/javascript';
    script.onload = function() {
        requirejs.config({
            paths: {
                jquery: 'http://code.jquery.com/jquery',
                io: 'http://localhost:3000/socket.io/socket.io.js'
            }
        });
        requirejs(['jquery', 'io'], function($, io) {
            $('body').append(_cs.styleBootstrap);
            $('body').append(_cs.styleCommon);
            $('body').append(_cs.chatBox);
            $(document).on('click', '.panel-heading span.icon_minim', function(e) {
                var $this = $(this);
                if (!$this.hasClass('panel-collapsed')) {
                    $this.parents('.panel').find('.panel-body').slideUp();
                    $this.addClass('panel-collapsed');
                    $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
                } else {
                    $this.parents('.panel').find('.panel-body').slideDown();
                    $this.removeClass('panel-collapsed');
                    $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
                }
            });
            $(document).on('focus', '.panel-footer input.chat_input', function(e) {
                var $this = $(this);
                if ($('#minim_chat_window').hasClass('panel-collapsed')) {
                    $this.parents('.panel').find('.panel-body').slideDown();
                    $('#minim_chat_window').removeClass('panel-collapsed');
                    $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
                }
            });
            $(document).on('click', '#new_chat', function(e) {
                var size = $(".chat-window:last-child").css("margin-left");
                size_total = parseInt(size) + 400;
                alert(size_total);
                var clone = $("#chat_window_1").clone().appendTo(".container");
                clone.css("margin-left", size_total);
            });
            $(document).on('click', '.icon_close', function(e) {
                //$(this).parent().parent().parent().parent().remove();
                $("#chat_window_1").remove();
            });
            _cs.ClientID = Math.floor((Math.random() * 1000000));
            _cs.AdminID = '587da2551c2cea1274504908';
            _cs.socket = io('http://localhost:3000/chat_service', {
                query: 'AdminID=' + _cs.AdminID + '&ClientID=' + _cs.ClientID + '&isClient=true'
            });
            $('#btn-chat').click(function() {
                var message = {
                    timer: _cs.currentTimer(),
                    text: $('#btn-input').val()
                }
                _cs.socket.emit('ClientSendMessage' + _cs.ClientID, message, function(msg) {
                    _cs.appendMessage('send', msg);
                    $('#btn-input').val('');
                });
            });
            _cs.socket.on('ClientReceivedMessage' + _cs.ClientID, function(msg) {
                _cs.appendMessage('receive', msg);
            });
            _cs.socket.on('AdminStatus' + _cs.AdminID, function(info) {
                $('.panel-title').text(info.status == 0 ? 'Offline' : 'Online');
                if (info.status == 1) {
                    _cs.AdminName = info.AdminName;
                    _cs.AdminAvatar = info.AdminAvatar;
                    $('.msg_container_base').html('<div class="row msg_container base_receive"><div class="col-md-2 col-xs-2 avatar"><img src="' + info.AdminAvatar + '" class=" img-responsive "></div><div class="col-md-10 col-xs-10"><div class="messages msg_sent"><p>Hello! I\'m ' + info.AdminName + '.Can i help you?</p><time datetime="2009-11-13T20:00">' + _cs.currentTimer() + '</time></div></div></div>');
                } else {
                    $('.msg_container_base').html('<div class="row msg_container base_receive"><div class="col-md-12 col-xs-12"><div class="messages msg_sent"><p>Sorry guy!Now, we are offine, please leave a message for us!</p></div></div>');
                }
            })
            _cs.appendMessage = function(type, msg) {
                var htmlMsg = '';
                if (type == 'send') {
                    htmlMsg += '<div class="row msg_container base_sent">'
                    htmlMsg += '<div class="col-md-10 col-xs-10">'
                    htmlMsg += '<div class="messages msg_sent">'
                    htmlMsg += '<p>' + msg.text + '</p>'
                    htmlMsg += '<time datetime="2009-11-13T20:00">' + msg.timer + '</time>'
                    htmlMsg += '</div>'
                    htmlMsg += '</div>'
                    htmlMsg += '<div class="col-md-2 col-xs-2 avatar">'
                    htmlMsg += '<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">'
                    htmlMsg += '</div>'
                    htmlMsg += '</div>'
                } else {
                    htmlMsg += '<div class="row msg_container base_receive">'
                    htmlMsg += '<div class="col-md-2 col-xs-2 avatar">'
                    htmlMsg += '<img src="' + _cs.AdminAvatar + '" class=" img-responsive ">'
                    htmlMsg += '</div>'
                    htmlMsg += '<div class="col-md-10 col-xs-10">'
                    htmlMsg += '<div class="messages msg_receive">'
                    htmlMsg += '<p>' + msg.text + '</p>'
                    htmlMsg += '<time datetime="2009-11-13T20:00">' + msg.timer + '</time>'
                    htmlMsg += '</div>'
                    htmlMsg += '</div>'
                    htmlMsg += '</div>'
                }
                $('.msg_container_base').append(htmlMsg);
                $('.msg_container_base').animate({
                    scrollTop: $('.msg_container_base').prop("scrollHeight")
                }, 'fast');
            }
            _cs.currentTimer = function() {
                var d = new Date();
                var timer = (d.getHours().toString().length == 1 ? '0' + d.getHours() : d.getHours()) + ':' + (d.getMinutes().toString().length == 1 ? '0' + d.getMinutes() : d.getMinutes()) + ':' + (d.getSeconds().toString().length == 1 ? '0' + d.getSeconds() : d.getSeconds());
                return timer;
            }
        });
    }
    document.getElementsByTagName("head")[0].appendChild(script);
})();