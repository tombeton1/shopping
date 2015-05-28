/**
 * Created by lenny on 28/05/15.
 */

var SimpleModal = (function (){

    var modal = function (button, modalId){

        //local variables modal
        var modal = document.getElementById(modalId);
        var children = modal.children;

        // black fade element
        var fade = document.getElementById('fade');

        //open
        document.getElementById(button).addEventListener('click', function(e) {
                e.preventDefault();
                var btn = document.createElement('button');
                var t = document.createTextNode('close');
                btn.appendChild(t);
                btn.classList.add('close');
                modal.insertBefore(btn, modal.childNodes[0]);
                for(var i = 0; i < children.length; i++){
                    children[i].style.display = 'block';
                }
                modal.classList.remove('modal-close');
                fade.classList.remove('modal-close');
                modal.classList.add('modal');
                fade.classList.add('overlay');
                btn.addEventListener('click', function(e){
                    e.preventDefault();
                    modal.classList.add('modal-close');
                    fade.classList.add('modal-close');
                    setTimeout(function(){
                        modal.style.display = 'none';
                        modal.classList.remove('modal');
                        fade.classList.remove('overlay');
                        modal.style.display='block';
                        modal.removeChild(btn);
                        for(var i = 0; i < children.length; i++){
                            children[i].style.display = 'none';
                        }
                    },200)
                });
        });
    };

    return {
        modal: modal
    }
})();
