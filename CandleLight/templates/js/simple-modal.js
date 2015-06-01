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
        btn.innerHTML = '<span class="material-icons md-black md-36">cancel</span>';
        btn.classList.add('close-btn');

        // set all the childelements from the modal on display none (hide content)
        for (var i = 0; children[i]; i ++) {
            children[i].style.display = 'none';
        }

        //creates the modal when clicked on the button
        document.getElementById(button).addEventListener('click', function (e) {

            e.preventDefault();
            btn.classList.add('close-btn');

            // add modal animation to open modal
            modal.classList.add('modal');
            fade.classList.add('overlay');

            // sets all content on display block.
            for (var i = 0; children[i]; i++) {
                children[i].style.display = 'block';
            }

            // add the button before the content.
            modal.insertBefore(btn, modal.childNodes[0]);

            // event listener Close button
            btn.addEventListener('click', function (e) {

                e.preventDefault();

                // add close animation CSS class
                modal.classList.add('modal-close');
                fade.classList.add('modal-close');

                // set display None of modal and overlay after animation finished (animation wont work otherwise).
                setTimeout(function () {
                    modal.style.display = 'none';
                    modal.classList.remove('modal');
                    fade.classList.remove('overlay');
                    modal.style.display = 'block';
                    for (var i = 0; children[i]; i ++) {
                        children[i].style.display = 'none';
                    }
                    modal.classList.remove('modal-close');
                    fade.classList.remove('modal-close');
                }, 300);
            });
        });
    }

    return {
        createModal: createModal
    }
}());
