<?php
session_start();
$user = NULL;
if (isset($_SESSION['user']) != NULL) {
    $user = $_SESSION['user'];
} else {
    $_SESSION['message'] = 'not logged in';
    header("Location: ../View/index.php");
    die();
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title></title>
    <style>
        .menu {
            display:block;

        @menu-width:250px;

        div {
            position: absolute;
            z-index: 2;
            top: 0;
            width: 250px;
            height: 100%;
        . border-box;
        . transition(-webkit-transform ease 250 ms);
        . transition(transform ease 250 ms);
        }
        .left {
             background:#273D7A;
             left:@menu-width*-1;
         }

        .visible.left {
         .transform(translate3d(@menu-width, 0, 0));
         }

        .right {
             background:#6B1919;
             right:@menu-width*-1;
         }

        .visible.right {
         .transform(translate3d(@menu-width*-1, 0, 0));
         }

        .menu-item {
             float:left;
             width:100%;
             margin:0;
             padding:10px 15px;
             border-bottom:solid 1px #555;
             cursor:pointer;
         .border-box;
             color:#B0B0B0;

        .menu-item:hover {
             color:#F0F0F0;
         }

    </style>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/sidenav.css">
    <script src="js/react-with-addons.min.js"></script>
    <script src="js/JSXTransformer.js"></script>
    <script type="text/jsx">
    /** @jsx React.DOM */
    var App = React.createClass({
	showLeft: function() {
		this.refs.left.show();
	},

	showRight: function() {
		this.refs.right.show();
	},

	render: function() {
		return <div>
			<button onClick={this.showLeft}>Show Left Menu!</button>
			<button onClick={this.showRight}>Show Right Menu!</button>

			<Menu ref="left" alignment="left">
				<MenuItem hash="first-page">First Page</MenuItem>
				<MenuItem hash="second-page">Second Page</MenuItem>
				<MenuItem hash="third-page">Third Page</MenuItem>
			</Menu>

			<Menu ref="right" alignment="right">
				<MenuItem hash="first-page">First Page</MenuItem>
				<MenuItem hash="second-page">Second Page</MenuItem>
				<MenuItem hash="third-page">Third Page</MenuItem>
			</Menu>
		</div>;
	}
});
var Menu = React.createClass({
	getInitialState: function() {
		return {
			visible: false
		};
	},

	show: function() {
		this.setState({ visible: true });
		document.addEventListener("click", this.hide.bind(this));
	},

	hide: function() {
		document.removeEventListener("click", this.hide.bind(this));
		this.setState({ visible: false });
	},

	render: function() {
		return <div className="menu">
			<div className={(this.state.visible ? "visible " : "") + this.props.alignment}>{this.props.children}</div>
		</div>;
	}
});
var MenuItem = React.createClass({
	navigate: function(hash) {
		window.location.hash = hash;
	},

	render: function() {
		return <div className="menu-item" onClick={this.navigate.bind(this, this.props.hash)}>{this.props.children}</div>;
	}
});

React.render(<App />, document.body);

    </script>
</head>
<body>

</body>
</html> 