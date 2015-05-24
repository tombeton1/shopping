/**
 * Created by lenny on 21/05/15.
 */

var ShoppingApp = (function () {
    //array in ShoppingApp scope voor opties url en userId, deze kan met alle submodules worden gebruikt.
    var config = [];

    // constructor: alle modules worden hier geinitializeerd
    var init = function(options){
        config.push(options);
        UserInterfaceModule.init();
        UserModule.init();
        FriendsModule.init();
        UserModule.getUser();
        FriendsModule.getFriends();
        FriendsModule.getFriendsRequest();
    };

    // user interface
    var UserInterfaceModule = (function(){

        var init = function(){
            events();
        };

        var events = function(){
            $('#responsive-menu-button').sidr();
            $('li a').click(function(){
                $.sidr('close', 'sidr');
                $('#simple-menu').show();
                var child = document.querySelector('.material-design-hamburger__icon').childNodes[1].classList;
                child.remove('material-design-hamburger__icon--to-arrow');
                child.add('material-design-hamburger__icon--from-arrow');

            });
            $('#simple-menu').click(function(){
                $('#simple-menu').hide();
                //document.querySelector('.material-design-hamburger__icon').childNodes[1].classList.remove('material-design-hamburger__icon--from-arrow');
                //child.remove('material-design-hamburger__icon--from-arrow');
                //child.add('material-design-hamburger__icon--to-arrow');
            });
            $('.tabs .tab-links a').on('click', function (e) {
                var currentAttrValue = $(this).attr('href');
                $('.tabs ' + currentAttrValue).show().siblings().hide();
                $(this).parent('li').addClass('active').siblings().removeClass('active');
                e.preventDefault();
            });
            $(window).touchwipe({

                wipeLeft: function() {
                    $.sidr('close', 'sidr');
                    var child = document.querySelector('.material-design-hamburger__icon').childNodes[1].classList;
                    child.remove('material-design-hamburger__icon--to-arrow');
                    child.add('material-design-hamburger__icon--from-arrow');
                },
                wipeRight: function() {
                    $.sidr('open', 'sidr');
                },
                preventDefaultEvents: false
            });

            document.querySelector('.material-design-hamburger__icon').addEventListener(
                'click',
                function() {
                    var child = this.childNodes[1].classList;
                    if (child.contains('material-design-hamburger__icon--to-arrow')) {
                        child.remove('material-design-hamburger__icon--to-arrow');
                        child.add('material-design-hamburger__icon--from-arrow');
                    } else {
                        child.remove('material-design-hamburger__icon--from-arrow');
                        child.add('material-design-hamburger__icon--to-arrow');
                    }
                });
        };
        return{
            init: init
        }
    })();
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
                    getUser();
                   _disableInput();
                   $('#update').val('Edit').removeAttr('disabled');
                });
                e.preventDefault();
            });

            $(document).on('click', '#update', function(){
                if (document.getElementById("update").type === "submit") {
                    document.getElementById("update").type = "button";
                    document.getElementById("update").value = "Update";
                    document.getElementById("first-name").disabled = false;
                    document.getElementById("last-name").disabled = false;
                    document.getElementById("country").disabled = false;
                    document.getElementById("email").disabled = false;
                } else if (document.getElementById("update").type === "button") {
                    document.getElementById("update").type = "submit";
                }
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

        var  _disableInput = function() {
            document.getElementById("first-name").disabled = true;
            document.getElementById("last-name").disabled = true;
            document.getElementById("country").disabled = true;
            document.getElementById("email").disabled = true;
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

        var init = function (){
            events();
        };

        var events = function(){

            //search friends event
            $('#search-users').keyup(function (e) {
                var keyword = $(this).val();
                if (keyword.length >= 3){
                    _searchFriends(keyword).done(function (data){
                        var $results = $('#results').html('');
                        if (data.length === 0) {
                            $($results).append('<tr><td>User not found</td></tr>');
                        };
                        data.forEach(function (user){
                            $($results).append('<div class="search-results"><p>' + user.firstName + ' ' + user.lastName +'<br>' + user.email +  '</p> <button class="button-flat button-green" id="add-friend-btn" type="submit" value="'+ user.userId +'">Add friend</button></div>');
                        });
                    });
                } else {
                    $('#results').html('');
                };
            });

            // accept button friends requests
            $(document).on('click', '#accept-request-btn', function () {
                var friendId = ($(this).attr("value"));
                _acceptRequest(friendId).done(function(data){
                    var $message = $('#request-friend-message').html('');
                    $message.append(data);
                    setTimeout(function () {
                        $message.fadeOut('slow');
                        $message.empty();
                    }, 2800);
                    getFriends();
                    getFriendsRequests();
                });
            });

            $(document).on('click', '#decline-request-btn', function(){
                var friendId =($(this).attr("value"));
                _deleteFriend(friendId).done(function(data){
                   getFriendsRequests();
                   getFriends();
                })
            });

            $(document).on('click', '#add-friend-btn', function(){
                var friendId =($(this).attr("value"));
                _addFriend(friendId).done(function(data){
                    var $message = $('#add-friend-message').html('');
                    $message.append(data);
                    setTimeout(function () {
                        $message.fadeOut('slow');
                        $message.empty();
                    }, 2800);
                    getFriendsRequests();
                })
            });
        };

        // private function ajax request voor friends.
        var _getFriends = function (){
               return $.ajax({
                    url: config[0].url + 'friends/' + config[0].userId,
                    type: 'GET',
                    dataType: 'json',
                    cache: false,
                    async: true
                })
        };

        // private function aajx request voor friendsrequests
        var _getFriendsRequests = function (){
            return $.ajax({
                url: config[0].url + 'friends/requests/' + config[0].userId,
                type: 'GET',
                dataType: 'json',
                cache: false,
                async: true
            })
        };

        var _searchFriends = function (keyword){
            return $.ajax ({
                url: config[0].url + 'friends/search/' + keyword,
                type: 'GET',
                dataType: 'json',
                cache: false,
                async: true
            })
        };

        var _acceptRequest = function (friendId){
            return $.ajax({
                url: config[0].url + 'friends/requests/' + config[0].userId + '/' + friendId + '/' ,
                type: 'PUT',
                dataType: 'json',
                cache: false,
                async: true
            })
        };
        var _deleteFriend = function (friendId){
            return $.ajax({
                url: config[0].url + 'friends/requests/' + config[0].userId + '/' + friendId + '/' ,
                type: 'DELETE',
                dataType:'json',
                cache: false,
                async: true
            })
        };

        // private method add friend
         var _addFriend = function(friendId){
             return $.ajax({
                 url: config[0].url + 'friends/requests/' + config[0].userId + '/' + friendId + '/' ,
                 type: 'POST',
                 dataType: 'text',
                 cache: false,
                 async: true
             })
         };

        // public methode om friends naar de DOM te sturen.
        var getFriends = function (){
            return _getFriends().done(function (data){
                $('#friends-list').html('');
                var $friends = $('#friends').html('');
                var friends = 0;
                data.forEach(function (user) {
                    $('#friends-list').append('<div class="friends-list"><p>' + user.firstName + ' ' + user.lastName +  '</p><button class="button-flat" id="decline-request-btn" type="submit" value="'+ user.userId +'">Delete Friend</button></div>');
                    friends++
                });
                if(friends === 0){
                    $friends.append('');
                    $('.sidebar-grey-badge').hide();
                } else {
                    $friends.append(friends);
                }
            })
        };

        var getFriendsRequests = function (){
            return _getFriendsRequests().done(function (data){
                $('#friends-requests-list').html('');
                var $requests = $('#requests').html('');
                var requests = 0;
                data.forEach(function(request){
                    $('#friends-requests-list').append('<div class="friend-requests"><p>' + request.firstName + ' ' + request.lastName + ' wants to add you to his/her friend list </p><button class="button-raised accept-button" id="accept-request-btn" type="submit" value="'+ request.userId +'">accept</button><button class="button-raised decline-button" id="decline-request-btn" type="submit" value="'+ request.userId +'">decline</button></div>');
                    requests++;
                });
                if(requests === 0){
                    $requests.append('');
                    $('.sidebar-badge').hide();
                } else {
                    $requests.append(requests);
                }
            });
        };

        // return public methods van friends module.
        return{
            init: init,
            getFriends: getFriends,
            getFriendsRequest: getFriendsRequests
        }
    })();

    // return van de public methoden om settings te initatlizeren.
    return {
        init: init
    };
})();