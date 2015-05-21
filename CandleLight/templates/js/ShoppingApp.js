/**
 * Created by lenny on 21/05/15.
 */

var ShoppingApp = (function () {

    //private array voor opties url en userId
    var config = [];

    // constructor
    var init = function(options){
        config.push(options);
        ShoppingApp.getUser();
        ShoppingApp.getFriends();
    }

    //private method
    var _getUser = function () {
        return $.ajax({
            url: config[0].url + config[0].userId,
            type: 'GET',
            dataType: 'json',
            cache: false,
            async: true
        })
    };
    var _getFriends = function (){
       return $.ajax({
            url: config[0].friendUrl + config[0].userId,
            type: 'GET',
            dataType: 'json',
            cache: false,
            async: true
        })
    };

    //public method
    var getUser = function () {
        return _getUser().done(function(data){
            $("#first-name").val(data.firstName);
            $("#last-name").val(data.lastName);
            $("#country").val(data.country);
            $("#email").val(data.email);
        })
    };

    var getFriends = function (){
        return _getFriends().done(function (data){
            $('#friends-list').html('');
            data.forEach(function (user) {
                $('#friends-list').append('<p>' + user.firstName + ' ' + user.lastName +  '</p>');
            });
        })
    };

    // return van de publuc methode.
    return {
        init: init,
        getUser: getUser,
        getFriends: getFriends
    };
})();