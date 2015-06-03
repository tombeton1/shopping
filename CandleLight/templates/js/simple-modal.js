/**
 * Created by lenny on 28/05/15.
 */



var SimpleModal = (function () {

    'use strict';

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
            } else {

            }
        });
    };
    var createModal = function (){

    }

    return {
        createModal: createModal,
        createDynamicModal: createDynamicModal
    }
}());
