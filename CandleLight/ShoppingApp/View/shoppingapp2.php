<?php
//session_start();
//$user = NULL;
//if (isset($_SESSION['user']) != NULL) {
//    $user = $_SESSION['user'];
//} else {
//    $_SESSION['message'] = 'not logged in';
//    header("Location: ../View/index.php");
//    die();
//}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <style>
    .MenuBox {
      background-color: black;
      height: 10em;
        width: 10em;
        transition(-webkit-transform ease 250 ms);
        transition(transform ease 250 ms);
    }
        .MenuItem {
            background-color: red;
            width: 100%;
            height: 3em;
        }
    </style>
    <script src="js/react-with-addons.min.js"></script>
    <script src="js/JSXTransformer.js"></script>
    <script type="text/jsx">
      /** @jsx React.DOM */

    var Menu = React.createClass({
    showMenu: function() {
        this.refs.show();
    },
    render: function() {
        return (
                <div>
                <button type="submit" value="Search" onClick={this.showMenu}>click here </button>
                <MenuBox><MenuItem></MenuItem></MenuBox>
                </div>
        )
    }
    });
    var MenuBox = React.createClass({
         getInitialState: function() {
            return { visible: false };
         },
        show: function() {
            this.setState({visible: true});
            document.addEventListener("click", this.hide.bind(this));
        },
        hide: function() {
            document.removeEventListener("click", this.hide.bind(this));
            this.setState({visible: false});
        },
        render: function(){
            return (
                <div className="MenuBox">
			        <div className={(this.state.visible ? "visible " : "")}>{this.props.children}</div>
		        </div>;
            )
        }
    });
    var MenuItem = React.createClass({
        render: function(){
            return(
                <div className="MenuItem">Option 1</div>
            )
        }
    });
    var App = React.createClass({
        render: function(){
            return(
                <div>
                            <button onClick={this.showMenu}>Show Menu!</button>
                    <MenuBox/>
                </div>
            )
        }
    });
    React.render(<Menu />, document.body);

    </script>
</head>
<body>

</body>
</html>
