function escapeRegExp(string) {
  return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

function replaceAll(str, find, replace) {
  return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

function load_users(){

    $.ajax({
        url: 'fetch-userlist',
        method: "GET",
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            $('#user-list').html('');

            if(typeof data[0] != 'undefined' && $('#selected-user-id').val() == ''){
               $('#selected-user-id').val(data[0].id)
               $('#selected-user-name').html(data[0].name)
               fetchUserMesssages()
            }
            for(var j in data){
                var user = data[j]

                var html = $('#user-template').html()
                for(var i in user){
                    html = replaceAll(html,"##"+i+"##", user[i])
                }
                $('#user-list').append(html);
            }
            userEvents()
            fetchNewMessages()
        }
    });
}

function userEvents(){
    $('.user-item').click(function(){
        $('#selected-user-id').val($(this).data('id'))
        $('#selected-user-name').text($(this).data('name'))
        fetchUserMesssages()
        $('#selected-user-id').val($(this).data('id'))
    })
}

function fetchUserMesssages(){
    var userId = $('#selected-user-id').val()
    $.ajax({
        url: 'fetch-messages?sender_id='+userId,
        method: "GET",
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            $('#message-box').html('')
            for(var j in data){
                var message = data[j]
                var templateName = message.sender_id == userId ? 'received-message' : 'sent-message'

                var html = $('#'+templateName).html()
                for(var i in message){
                    html = replaceAll(html,"##"+i+"##", message[i])
                }
                $('#message-box').append(html)
            }
            markAsReadMessage()
        }
    });
}

function markAsReadMessage(){
    var userId = $('#selected-user-id').val()
    $.ajax({
        url: 'notification-status-read',
        method: "POST",
        data: { _token : $('meta[name="csrf-token"]').attr('content'), sender_id : userId},
        success: function (data) {
        }
    });
}

function fetchNewMessages(){
    $.ajax({
        url: 'check-messages',
        method: "GET",
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            if(data['new_messages']){
                for(var j in data['new_messages']){
                    var update = data['new_messages'][j]
                    if(update.sender_id == $('#selected-user-id').val()){
                        fetchUserMesssages()
                    }
                }
            }
            if(data['deleted_messages']){
                for(var j in data['deleted_messages']){
                    var deleted = data['deleted_messages'][j]
                    if(deleted.sender_id == $('#selected-user-id').val()){
                        fetchUserMesssages()
                    }
                }
            }
        }
    });
}

function deleteMessage(messageId){
    $.ajax({
        url: 'delete-message',
        method: "POST",
        data: { _token : $('meta[name="csrf-token"]').attr('content'), message_id : messageId},
        success: function (data) {
            if(data){
                $('#message_'+messageId).remove()
            }
        }
    });
}

$(function(){
    
    load_users()

    setInterval(fetchNewMessages, 1000)

    $('#sendMessage').click(function(){
        $.ajax({
            url: 'send-message',
            method: "POST",
            data: { _token : $('meta[name="csrf-token"]').attr('content'), receiver_id : $('#selected-user-id').val(), text : $('#message').val()},
            success: function (data) {
                $('#message').val('')
                fetchUserMesssages()
            }
        });
    })

})
