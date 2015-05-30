/**
 * Created by lenny on 28/05/15.
 */



var SimpleModal = (function () {

    'use strict';

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

    return {
        createModal: createModal
    }
}());
