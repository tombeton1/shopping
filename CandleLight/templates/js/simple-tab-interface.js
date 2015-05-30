/**
* Created by lenny on 30/05/15.
*/


(function () {

    "use strict";

    function tabClick(event) {

            event.preventDefault();

            if (event.target.nodeName === 'A') {

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

    var tablinks = document.querySelectorAll('.tab-links li');
    var j = tablinks.length;

    while (j--) {
        tablinks[j].addEventListener('click', tabClick, false);
    }
}());
