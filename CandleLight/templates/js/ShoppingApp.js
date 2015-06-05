/**
 * Created by lenny on 21/05/15.
 */

    'use strict';

var ShoppingApp = (function () {

    //Config array, with settings (api url, userId, apikey) accesable for all modules.
    var config = [];

    // initatilizating from shopping app. All the modules get initiated here. and gets the options as param.
    // to push it to config array.
    var init = function (options) {
        config.push(options);
        UserModule.init();
        FriendsModule.init();
        ShoppinglistModule.init();
        UserInterfaceModule.init();
    };

    /*----------------------------------------------------------------------
    * User InterFace Module
    * All functions without identity for user interaction gets loaded here.
    * SideMenu, Modals, TabInterface.
    * ---------------------------------------------------------------------*/
    var UserInterfaceModule = (function () {

        var init = function () {
            menu();
            createModal('password', 'modal');
            createModal('add-grocery-list', 'add-grocery-modal');
            createDynamicModal('groceries-list','edit-list-btn', 'list-modal');
            createDynamicModal('groceries-list', 'grocery-list', 'view-modal');
            tabInterface();
            showDate();
        };

        // gets the buttonId and the id from the div for the modal.
        var createModal = function (button, modalId) {

            //local variables modal
            //div with modal Id
            var modal = document.getElementById(modalId);
            var children = modal.children;

            // div with fadeID for black overlay.
            var fade = document.getElementById('fade');

            // close button to close modal
            var btn = document.createElement('button');
            btn.innerHTML = '<span class="material-icons md-black md-36">cancel</span>';
            btn.classList.add('close-btn');

            // set all the childelements from the modal on display none
            for (var i = 0; children[i]; i++) {
                children[i].style.display = 'none';
            }

            //creates the modal when clicked on the button
            document.getElementById(button).addEventListener('click', function (e) {

                e.preventDefault();

                // add css clases for animation
                modal.classList.add('modal-open');
                fade.classList.add('overlay-open');

                // setting all children frm modal visible
                    for (var i = 0; children[i]; i++) {
                        children[i].style.display = 'block';
                    }

                // insert close btn before content
                modal.insertBefore(btn, modal.childNodes[0]);
                // close button handler
                btn.addEventListener('click', function (e) {

                    e.preventDefault();

                    // add classes for close animation
                    modal.classList.add('modal-close');
                    fade.classList.add('modal-close');
                    fade.classList.remove('overlay-open');

                    // sets display on none when animation is finished otherwise it closes too abrubt.
                    setTimeout(function () {
                        for (var i = 0; children[i]; i++) {
                            children[i].style.display = 'none';
                        }
                        modal.classList.remove('modal-close');
                        fade.classList.remove('modal-close');
                        modal.classList.remove('modal-open');
                    }, 300);
                });
            });
        };
        var showDate = function (){
            var days = ['Mon','Thu','Wed','Thu', 'Sat','Sun'];
            var d = new Date();
            var m = days[d.getDate()-1] + ' ' + d.getDate() + '/' + d.getMonth() + '/' + d.getFullYear();
            document.getElementById('date').innerHTML = m;
        };

        var createDynamicModal = function(div,button, modalId) {

            //local variables modal
            //div with modal Id
            var modal = document.getElementById(modalId);
            var children = modal.children;

            // div with fadeID for black overlay.
            var fade = document.getElementById('fade');

            // close button to close modal
            var btn = document.createElement('button');
            btn.innerHTML = '<span class="material-icons md-black md-36">cancel</span>';
            btn.classList.add('close-btn');

            // set all the childelements from the modal on display none
            for (var i = 0; children[i]; i++) {
                children[i].style.display = 'none';
            }

            //creates the modal when clicked on the button
            document.getElementById(div).addEventListener('click', function (e) {
                console.log(e.target);
                if (e.target.id === button) {
                    // add css clases for animation
                    modal.classList.add('modal-open');
                    fade.classList.add('overlay-open');

                    // setting all children frm modal visible
                    for (var i = 0; children[i]; i++) {
                        children[i].style.display = 'block';
                    }

                    // insert close btn before content
                    modal.insertBefore(btn, modal.childNodes[0]);
                    // close button handler
                    btn.addEventListener('click', function (e) {

                        e.preventDefault();

                        // add classes for close animation
                        modal.classList.add('modal-close');
                        fade.classList.add('modal-close');
                        fade.classList.remove('overlay-open');

                        // sets display on none when animation is finished otherwise it closes too abrubt.
                        setTimeout(function () {
                            for (var i = 0; children[i]; i++) {
                                children[i].style.display = 'none';
                            }
                            modal.classList.remove('modal-close');
                            fade.classList.remove('modal-close');
                            modal.classList.remove('modal-open');
                        }, 300);
                    });
                }
            });
        };

        // tab interface
        var tabInterface = function () {

            var tablinks = document.querySelectorAll('.tab-links li');
            var j = tablinks.length;

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
                    if(id.indexOf("#") > -1){
                        var content = document.querySelector('.tab-content').querySelector(id);
                        content.style.display = 'block';
                    } else {
                        window.location.href = id;
                    }
                }
            }

            // add events to all the anchors in the navigation.
            while (j--) {
                tablinks[j].addEventListener('click', tabClick, false);
            }
        };

        //
        var menu = function () {

            // sidr menu
            $('#responsive-menu-button').sidr();

            // touchwipe for swipe opening menu on smarthpones
            $(window).touchwipe({
                wipeLeft: function () {
                    $.sidr('close', 'sidr');
                    var child = document.querySelector('.material-design-hamburger__icon').childNodes[1].classList;
                    child.remove('material-design-hamburger__icon--to-arrow');
                    child.add('material-design-hamburger__icon--from-arrow');
                },
                wipeRight: function () {
                    $.sidr('open', 'sidr');
                },
                preventDefaultEvents: false
            });


            // hamburger menu animation
            document.querySelector('.material-design-hamburger__icon').addEventListener(
                'click',
                function () {
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

        return {
            init: init,
        }
    })();

    /*--------------------------------------------------------------------
    * Module loads ajax calls for User all the user data (Settings panel).
    *Get user info, Update user info
    * --------------------------------------------------------------------*/
    var UserModule = (function () {

        // initialize functions.
        var init = function () {
            events();
            getUser();
        };

        // EventListeners
        var events = function () {

            // update user form submit event.
            document.getElementById('update-user-form').addEventListener('submit', function(e){
                var updatebtn = document.getElementById('update');
                _putUser().done(function(){
                }).always(function(){
                    getUser();
                    _disableInput();
                    updatebtn.value = 'Edit info';
                });
                e.preventDefault();
            });

            // change button type when clicking on update info in settings panel
            document.getElementById('update').addEventListener('click', function(){
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

            document.getElementById('update-password-form').addEventListener('submit', function(e){
                var message = document.getElementById('update-password-message');
                message.style.display = 'block';
                _putPassword().done(function(data){
                    console.log(data);
                    fadeIn(message);
                    message.innerHTML = data;
                }).always(function(){
                    setTimeout(function (){
                        fadeOut(message);
                    },2800);
                });
                e.preventDefault();
            });
        };

        function fadeOut(el){
            el.style.opacity = 1;

            (function fade() {
                if ((el.style.opacity -= .1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        }

        function fadeIn(el, display){
            el.style.opacity = 0;
            el.style.display = display || "block";

            (function fade() {
                var val = parseFloat(el.style.opacity);
                if (!((val += .1) > 1)) {
                    el.style.opacity = val;
                    requestAnimationFrame(fade);
                }
            })();
        }

        // private methode voor updaten van de user.
        var _putUser = function () {
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

        var _putPassword = function(){
            return $.ajax({
                url: config[0].url + 'password/' + config[0].userId,
                type: 'POST',
                dataType: 'text',
                cache: false,
                async: true,
                data: $('#update-password-form').serialize()
            })
        };

        // disable button after click on update settings panel
        var _disableInput = function () {
            document.getElementById("first-name").disabled = true;
            document.getElementById("last-name").disabled = true;
            document.getElementById("country").disabled = true;
            document.getElementById("email").disabled = true;
        };

        //public method wordt ajax data  doorgestuurd.
        var getUser = function () {
            return _getUser().done(function (data) {
                document.getElementById('first-name').value = data.firstName;
                document.getElementById('last-name').value = data.lastName;
                document.getElementById('country').value = data.country;
                document.getElementById('email').value = data.email;
            });
        };



        // return van de public methodes van alle user interacties.
        return {
            init: init
        }
    })();

    /*----------------------------------------------------------------
    * FriendsModule
    * Gets all the ajax calls for Friends.
    * Friendsrequests, Friends, Search for friends
    * ----------------------------------------------------------------*/
    var FriendsModule = (function () {

        var init = function () {
            events();
            getFriends();
            getFriendsRequests();
        };

        // EventListeners
        var events = function () {

            //search friends event
            document.getElementById('search-users').addEventListener('keyup', function (e) {
                var keyword = this.value;
                if (keyword.length >= 3) {
                    _searchFriends(keyword).done(function (data) {
                        document.getElementById('results').innerHTML = '';
                        var results = document.getElementById('results');
                        if (data.length === 0) {
                            var tr = document.createElement('tr');
                            tr.innerHTML = '<td>User not found</td>';
                            results.appendChild(tr);
                        }
                        data.forEach(function (user) {
                            var div = document.createElement('div');
                            div.classList.add('search-results');
                            div.innerHTML = '<p>' + user.firstName + ' ' + user.lastName + '<br>' + user.email + '</p> <button class="button-flat button-green" id="add-friend-btn" type="submit" value="' + user.userId + '">Add friend</button>';
                            results.appendChild(div);
                        });
                    });
                } else {
                    document.getElementById('results').innerHTML = '';
                }
            });

            // accept or decline friend in friend requests (delegation because buttons get dynamicallly added)
            document.getElementById("friends-requests-list").addEventListener("click", function (e) {
                if (e.target.id === "accept-request-btn") {
                    var friendId = e.target.value;
                    _acceptRequest(friendId).done(function (data) {
                        var $message = $('#request-friend-message').html('');
                        $message.append(data);
                        setTimeout(function () {
                            $message.fadeOut('slow');
                            $message.empty();
                        }, 2800);
                        getFriends();
                        getFriendsRequests();
                    });
                } else if (e.target.id === "decline-request-btn") {
                    var friendId = e.target.value;
                    _deleteFriend(friendId).done(function (data) {
                        getFriendsRequests();
                        getFriends();
                    })
                }
            });

            // decline or delete friend
            document.getElementById("friends-list").addEventListener("click", function (e) {
                if (e.target.id === "decline-request-btn") {
                    var friendId = e.target.value;
                    _deleteFriend(friendId).done(function (data) {
                        getFriendsRequests();
                        getFriends();
                    })
                }
            });

            // add friend btn
            document.getElementById('results').addEventListener("click", function (e) {
                if (e.target.id === "add-friend-btn") {
                    var friendId = e.target.value;
                    _addFriend(friendId).done(function (data) {
                        var $message = $('#add-friend-message').html('');
                        $message.append(data);
                        setTimeout(function () {
                            $message.fadeOut('slow');
                            $message.empty();
                        }, 2800);
                        getFriendsRequests();
                    })
                }
            });
        };

        // private function ajax call friends from user.
        var _getFriends = function () {
            return $.ajax({
                url: config[0].url + 'friends/' + config[0].userId,
                type: 'GET',
                dataType: 'json',
                cache: false,
                async: true
            })
        };

        // private function ajax call friendrequests from user
        var _getFriendsRequests = function () {
            return $.ajax({
                url: config[0].url + 'friends/requests/' + config[0].userId,
                type: 'GET',
                dataType: 'json',
                cache: false,
                async: true
            })
        };

        // private function ajax call search friends
        var _searchFriends = function (keyword) {
            return $.ajax({
                url: config[0].url + 'friends/search/' + keyword,
                type: 'GET',
                dataType: 'json',
                cache: false,
                async: true
            })
        };

        // private function ajax call acceptFriendrequest
        var _acceptRequest = function (friendId) {
            return $.ajax({
                url: config[0].url + 'friends/requests/' + config[0].userId + '/' + friendId + '/',
                type: 'PUT',
                dataType: 'json',
                cache: false,
                async: true
            })
        };

        // private function ajax call delete friend or decline friend request
        var _deleteFriend = function (friendId) {
            return $.ajax({
                url: config[0].url + 'friends/requests/' + config[0].userId + '/' + friendId + '/',
                type: 'DELETE',
                dataType: 'json',
                cache: false,
                async: true
            })
        };

        // private functoin ajax call add friend
        var _addFriend = function (friendId) {
            return $.ajax({
                url: config[0].url + 'friends/requests/' + config[0].userId + '/' + friendId + '/',
                type: 'POST',
                dataType: 'text',
                cache: false,
                async: true
            })
        };

        // public function ajax call getfriends from user
        var getFriends = function () {
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

        // public function ajax call getFriendRequests from user
        var getFriendsRequests = function () {
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

        // return public methods user.
        return {
            init: init
        }
    })();

    /*----------------------------------------------------------------
     * ShoppinglistModule
     * Gets all the ajax calls for Lists.
     * Lists
     * ----------------------------------------------------------------*/
    var ShoppinglistModule = (function(){
        var init = function () {
            events();
            getListsByUser();
        };

        // EventListeners
        var events = function () {
            // decline or delete friend
            document.getElementById("groceries-list").addEventListener("click", function (e) {
                if (e.target.id === "delete-list-btn") {
                    var listId = e.target.value;
                    _deleteList(listId).done(function (data) {
                        getListsByUser();
                    })
                }

                if (e.target.id === "edit-list-btn") {
                    var listId = e.target.value;
                    getList(listId).done(function (data) {

                    })
                }
            });
        }

        // private function ajax call user
        var _getList = function (listId) {
            return $.ajax({
                url: config[0].url + 'list/' + listId,
                type: 'GET',
                dataType: 'json',
                cache: false,
                async: true
            })
        };

        // private function ajax call lists from user.
        var _getListsByUser = function () {
            return $.ajax({
                url: config[0].url + 'lists/' + config[0].userId,
                type: 'GET',
                dataType: 'json',
                cache: false,
                async: true
            })
        };

        // private function ajax call delete list
        var _deleteList = function (listId) {
            return $.ajax({
                url: config[0].url + 'lists/' + listId,
                type: 'DELETE',
                dataType: 'json',
                cache: false,
                async: true
            })
        };

        var getList = function (listId) {
            return _getList(listId).done(function (list) {
                document.getElementById('list-name').value = list.shopping_list_name;
                document.getElementById('owner-text').value = list.owner_text;
                document.getElementById('friends-text').value = list.friends_text;
                document.getElementById('due-date').value = list.shopping_list_due_date;
            });
        };

        // public function ajax call getlists from user
        var getListsByUser = function () {
            return _getListsByUser().done(function (data) {
                document.getElementById('groceries-list').innerHTML = '';
                document.getElementById('groceries').innerHTML = '';
                var groceriesList = document.getElementById('groceries-list');
                var groceries = document.getElementById('groceries');
                var groceriesCount = 0;
                data.forEach(function (list) {
                    var div = document.createElement('div');
                    div.classList.add('grocery-list');
                    div.setAttribute('id', 'grocery-list');
                    div.innerHTML = '<p>' + list.shopping_list_name + ' ' + list.shopping_list_updated + '</p><button class="button-flat button-yellow material-icons md-36" id="edit-list-btn" type="submit" value="' + list.shopping_list_id + '">mode_edit</button><button class="button-flat material-icons md-36" id="delete-list-btn" type="submit" value="' + list.shopping_list_id + '">remove_circle</button>';
                    groceriesList.appendChild(div);
                    groceriesCount++
                });
                if (groceriesCount === 0) {
                    groceries.style.display = 'none';
                } else {
                    groceries.innerHTML = groceriesCount;
                }
            })
        };

        // return public methods user.
        return {
            init: init
        }
    })();

    // initialize ShoppingApp with all the modules.
    return {
        init: init
    };
})();