/**
 * Created by lenny on 20/05/15.
 */
function loadUser(userId) {
    $.ajax({
        url: '/CandleLight/api/users/'+ userId,
        type: 'GET',
        dataType: 'json',
        cache: false,
        async: true
    }).done(function (data) {
        $("#first-name").val(data.firstName);
        $("#last-name").val(data.lastName);
        $("#country").val(data.country);
        $("#email").val(data.email);
    });
};

function getFriends(userId){
    $.ajax({
        url:'/CandleLight/api/users/friends/'+ userId,
        type: 'GET',
        dataType: 'json',
        cache: false,
        async: true
    }).done(function (data){
        $('#friends-list').html('');
        data.forEach(function (user) {
            $('#friends-list').append('<p>' + user.firstName + ' ' + user.lastName +  '</p>');
        });
    })
};


///////// DOCUMENT READY ///////////////
$(document).ready(function(){

    $('#update-user-form').submit(function (e) {
        var updatebtn = $('#update');
        $.ajax({
            url: '/CandleLight/api/users/',
            type: 'put',
            dataType: 'text',
            cache: false,
            async: true,
            data: $('#update-user-form').serialize(),
            beforeSend: function () {
                updatebtn.val('updating').attr('disabled', 'disabled');
            }
        }).done(function (data) {

        }).always(function () {
            loadUser();
            disableInput();
            updatebtn.val('edit').removeAttr('disabled');
        });
        e.preventDefault();
    });
});
