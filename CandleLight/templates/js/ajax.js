/**
 * Created by lenny on 20/05/15.
 */
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
