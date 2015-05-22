/**
 * Created by lenny on 21/05/15.
 */

var ShoppingApp = (function () {

    //array in ShoppingApp scope voor opties url en userId, deze kan met alle submodules worden gebruikt.
    var config = [];

    // constructor: alle modules worden hier geinitializeerd
    var init = function(options){
        config.push(options);
        UserModule.init();
        UserModule.getUser();
        FriendsModule.getFriends();
    };

    // UserModule Module voor alle user interacties.
    var UserModule = (function(){

        // initatlizeren van events. Deze worden op deze manier geladen nadat de DOM is geladen.
        var init = function (){
            events();
        };

        // vangt alle events op dat met de User interactie te maken heeft.
        var events = function (){

            // update user form submit event.
            $('#update-user-form').submit(function (e) {
                var updatebtn = $('#update');
                _putUser().done(function (){

                }).always(function (){
                   UserModule.getUser();
                   disableInput();
                   $('#update').val('edit').removeAttr('disabled');
                });
                e.preventDefault();
            });

        };

        // private methode voor updaten van de user.
        var _putUser = function (){
            return $.ajax({
                    url: config[0].url + config[0].userId,
                    type: 'put',
                    dataType: 'text',
                    cache: false,
                    async: true,
                    data: $('#update-user-form').serialize()
                })
        };

        // private method in UserModule, haalt de ajax data op
        var _getUser = function () {
            return $.ajax({
                url: config[0].url + config[0].userId,
                type: 'GET',
                dataType: 'json',
                cache: false,
                async: true
            })
        };

        //public method wordt ajax data  doorgestuurd.
        var getUser = function () {
            return _getUser().done(function(data){
                $("#first-name").val(data.firstName);
                $("#last-name").val(data.lastName);
                $("#country").val(data.country);
                $("#email").val(data.email);
            })
        };

        // return van de public methodes van alle user interacties.
        return{
            init: init,
            getUser: getUser
        }
    })();

    var FriendsModule = (function (){

        // private function ajax request voor friends.
        var _getFriends = function (){
               return $.ajax({
                    url: config[0].friendUrl + config[0].userId,
                    type: 'GET',
                    dataType: 'json',
                    cache: false,
                    async: true
                })
        };

        // public methode om friends naar de DOM te sturen.
        var getFriends = function (){
            return _getFriends().done(function (data){
                $('#friends-list').html('');
                data.forEach(function (user) {
                    $('#friends-list').append('<p>' + user.firstName + ' ' + user.lastName +  '</p>');
                });
            })
        };

        // return public methods van friends module.
        return{
            getFriends: getFriends
        }
    })();

    // return van de public methoden om settings te initatlizeren.
    return {
        init: init
    };
})();