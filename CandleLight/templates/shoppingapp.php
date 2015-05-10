<?php

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/CandleLight/View/css/bootstrap.min.css" rel="stylesheet">
    <style>
    </style>
    <title></title>
    <style>
        .tab-links:after {
            display: block;
            clear: both;
            content: '';
        }

        .tab {
            display: none;
        }

        .tab.active {
            display: block;
        }
        .sidr-inner{
            background-color: #53e3a6;
        }
    </style>
    <link rel="stylesheet" href="/CandleLight/View/css/jquery.sidr.light.css">
</head>
<body>
<a id="simple-menu" href="#sidr">Toggle menu</a>
<div class="tabs">
    <div id="sidr">
        <ul class="tab-links">
            <li class="active"><a href="#tab1">User</a></li>
            <li><a href="#tab2">Shopping list</a></li>
            <li><a href="#tab3">Recipe</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div id="tab1" class="tab active">
            user info
        </div>
        <div id="tab2" class="tab">
            shopping list
        </div>
        <div id="tab3" class="tab">
            recipes
        </div>
    </div>
</div>
<script type="text/javascript" src="/CandleLight/View/js/jquery.min.js"></script>
<script type="text/javascript" src="/CandleLight/View/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/CandleLight/View/js/jquery.sidr.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#simple-menu').sidr();
        $('.tabs .tab-links a').on('click', function (e) {
            var currentAttrValue = $(this).attr('href');
            $('.tabs ' + currentAttrValue).show().siblings().hide();
            $(this).parent('li').addClass('active').siblings().removeClass('active');
            e.preventDefault();
        });
    });
</script>
</body>
</html> 