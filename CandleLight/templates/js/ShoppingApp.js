/**
 * Created by lenny on 21/05/15.
 */

'use strict'

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
            createModal('password', 'modal');
        };

        var createModal = function (button, modalId) {

            //local variables modal

            //div with modal Id
            var modal = document.getElementById(modalId);
            var children = modal.children;

            // div with fadeID for black overlay.
            var fade = document.getElementById('fade');

            // close button to close modal
            var btn = document.createElement('button');
            btn.innerHTML = 'close';
            btn.classList.add('close');

            // set all the childelements from the modal on display none
            for (var i = 0; children[i]; i ++) {
                children[i].style.display = 'none';
            }

            //creates the modal when clicked on the button
            document.getElementById(button).addEventListener('click', function (e) {

                e.preventDefault();

                // insert close button
                modal.insertBefore(btn, modal.childNodes[0]);

                // set content of modal on display block;
                for (var i = 0; children[i]; i ++) {
                    children[i].style.display = 'block';
                }

                modal.classList.remove('modal-close');
                fade.classList.remove('modal-close');
                modal.classList.add('modal');
                fade.classList.add('overlay');

                btn.addEventListener('click', function (e) {

                    e.preventDefault();

                    modal.classList.add('modal-close');
                    fade.classList.add('modal-close');

                    setTimeout(function () {
                        modal.style.display = 'none';
                        modal.classList.remove('modal');
                        fade.classList.remove('overlay');
                        modal.style.display = 'block';
                        modal.removeChild(btn);
                        for (var i = 0; children[i]; i ++) {
                            children[i].style.display = 'none';
                        }
                    }, 200);
                });
            });
        }

        function tabClick(event) {

            event.preventDefault();

            if (event.target.nodeName === 'A') {
                $.sidr('close', 'sidr');
                var child = document.querySelector('.material-design-hamburger__icon').childNodes[1].classList;
                child.remove('material-design-hamburger__icon--to-arrow');
                child.add('material-design-hamburger__icon--from-arrow');
                var id = event.target.getAttribute('href');
                var parent = document.querySelector('.tab-content').children;
                var i = parent.length;
                while (i--) {
                    parent[i].style.display = 'none';
                }
                var test = document.querySelector('.tab-content').querySelectorAll(id);
                test[0].style.display = 'block';
            }
        }

        var events = function(){

            // sidr menu
            $('#responsive-menu-button').sidr();

            // touchwipe voor swipe opening van menu
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

            // local variables van tabs
            var tablinks = document.querySelectorAll('.tab-links li');
            var j = tablinks.length;

            while (j--) {
                tablinks[j].addEventListener('click', tabClick, false);
            }

            // hamburger menu design
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
                   $('#update').val('Edit Info').removeAttr('disabled');
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
            document.getElementById('search-users').addEventListener('keyup', function(e){
                var keyword = this.value;
                if (keyword.length >= 3){
                    _searchFriends(keyword).done(function (data){
                        document.getElementById('results').innerHTML =  '';
                        var results = document.getElementById('results');
                        if (data.length === 0) {
                            var tr = document.createElement('tr');
                            tr.innerHTML = '<td>User not found</td>';
                            results.appendChild(tr);
                        };
                        data.forEach(function (user){
                            var div = document.createElement('div');
                            div.classList.add('search-results');
                            div.innerHTML = '<p>' + user.firstName + ' ' + user.lastName +'<br>' + user.email +  '</p> <button class="button-flat button-green" id="add-friend-btn" type="submit" value="'+ user.userId +'">Add friend</button>';
                            results.appendChild(div);
                        });
                    });
                } else {
                    document.getElementById('results').innerHTML = '';
                }
            });

            document.getElementById("friends-requests-list").addEventListener("click", function(e) {
                if(e.target.id === "accept-request-btn"){
                    var friendId = e.target.value;
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
                } else if(e.target.id === "decline-request-btn"){
                    var friendId = e.target.value;
                    _deleteFriend(friendId).done(function(data){
                        getFriendsRequests();
                        getFriends();
                    })
                }
            });

            document.getElementById("friends-list").addEventListener("click", function(e) {
                if(e.target.id === "decline-request-btn"){
                    var friendId = e.target.value;
                    _deleteFriend(friendId).done(function(data){
                        getFriendsRequests();
                        getFriends();
                    })
                }
            });

            document.getElementById('results').addEventListener("click", function(e){
                if(e.target.id === "add-friend-btn"){
                    var friendId = e.target.value;
                    _addFriend(friendId).done(function(data){
                        var $message = $('#add-friend-message').html('');
                        $message.append(data);
                        setTimeout(function () {
                            $message.fadeOut('slow');
                            $message.empty();
                        }, 2800);
                        getFriendsRequests();
                    })
                };
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
            return _getFriends().done(function (data) {
                    document.getElementById('friends-list').innerHTML = '';
                    document.getElementById('friends').innerHTML = '';
                    var friendsList = document.getElementById('friends-list');
                    var friends = document.getElementById('friends');
                    var friendsCount = 0;
                    data.forEach(function (user) {
                        var div = document.createElement('div');
                        div.classList.add('friends-list');
                        div.innerHTML = '<p>' + user.firstName + ' ' + user.lastName + '</p><button class="button-flat" id="decline-request-btn" type="submit" value="' + user.userId + '">Delete Friend</button>';
                        friendsList.appendChild(div);
                        friendsCount++
                    });
                    if (friendsCount === 0) {
                        friends.style.display = 'none';
                    } else {
                        friends.innerHTML = friendsCount;
                    }
                })
        };

        var getFriendsRequests = function (){
                return _getFriendsRequests().done(function (data) {
                    document.getElementById('friends-requests-list').innerHTML = '';
                    document.getElementById('requests').innerHTML = '';
                    var friendRequestList = document.getElementById('friends-requests-list');
                    var requests = document.getElementById('requests');
                    var requestCount = 0;
                        data.forEach(function (request) {
                            var div = document.createElement('div');
                            div.classList.add('friend-requests');
                            div.innerHTML = '<p>' + request.firstName + ' ' + request.lastName + ' wants to add you to his/her friend list </p><button class="button-raised accept-button" id="accept-request-btn" type="submit" value="' + request.userId + '">accept</button><button class="button-raised decline-button" id="decline-request-btn" type="submit" value="' + request.userId + '">decline</button>';
                            friendRequestList.appendChild(div);
                            requestCount++;
                    });
                    if (requestCount === 0) {
                        requests.style.display = 'none';
                    } else {
                        requests.innerHTML = requestCount;
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