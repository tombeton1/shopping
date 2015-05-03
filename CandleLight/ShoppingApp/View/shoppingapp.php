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
          height: auto;
          width: 15em;
          background-color: #37474F;
          transition: opacity .5s ease-in;

        }
        .MenuItem {
            width: 15em;
            height: 3em;
            border-bottom: 1px solid black;
            padding-top: 1em;
            transition: opacity .5s ease-in;
        }
        .MenuItem:hover{
            background-color: red;
        }
        .Users {
            margin-left: 20em;
            color: blue;
        }

    </style>
    <script src="js/react-with-addons.min.js"></script>
    <script src="js/JSXTransformer.js"></script>
    <script type="text/jsx">
    /** @jsx React.DOM */
    var ReactCSSTransitionGroup = React.addons.CSSTransitionGroup;
    var Menu = React.createClass({
        getInitialState: function() {
        return { showmenu: false };
        },
        show: function() {
            this.setState({showmenu: true});
            document.addEventListener("click", this.hide);
        },
        hide: function() {
            this.setState({showmenu: false});
           document.removeEventListener("click", this.hide);
        },
        render: function() {
            return (
                <div>
                    <button type="submit" value="Search" onClick={this.show}>click here </button>
                    { this.state.showmenu ?  <MenuBox></MenuBox>: null }
                </div>
            );
        }
    });
    var MenuBox = React.createClass({
        Handle: function (){
            console.log('option1');
        },
        render: function(){
            return (
                    <div className="MenuBox">
                        <MenuItem onClick={this.Handle}>Option 1</MenuItem>
                        <MenuItem>option 3</MenuItem>
                        <MenuItem>option 4</MenuItem>
                        <MenuItem>option 5</MenuItem>
                        <MenuItem>option 6</MenuItem>
                    </div>
            )
        }
    });
    var MenuItem = React.createClass({
        render: function(){
            return(
                <div className="MenuItem" onClick={this.clickHandler}>{this.props.children}</div>
            )
        }
    });
    var Users = React.createClass({
        render: function(){
            return(
                <div className="Users"><UsersList></UsersList></div>
            )
        }
    });
    var UsersList =  React.createClass({
        render: function(){
            <div className="UsersList"></div>
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
