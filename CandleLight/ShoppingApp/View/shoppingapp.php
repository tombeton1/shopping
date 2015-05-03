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
    <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
    <style>
        .MenuBox {
          height: auto;
          width: 15em;
          background-color: #37474F;
          transition: opacity .5s ease-in;
          display: block;
        }
        .MenuItem {
            height: 5em;
            max-height: 5em;
            padding-left: 2em;
            padding-top: 2em;
        }

        .Users{
            height: 5em;
            max-height: 5em;
        }
        .UsersList{
            margin-left: 20em;
            position: relative;
        }
        .usersBox{
           margin-left: 20em;
           position: relative;


        }
        .menu-button {
            display: block;
        }
        @media screen and (max-width: 500px){
            .menu-button{
                display: block;
            }

        }

    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/react-with-addons.min.js"></script>
    <script src="js/JSXTransformer.js"></script>
    <script type="text/jsx">
    /** @jsx React.DOM */
    //test
    var ReactCSSTransitionGroup = React.addons.CSSTransitionGroup;
    var Menu = React.createClass({
        getInitialState: function() {
        return { showmenu: false };
        },
        show: function() {
            if(this.state.showmenu === false){
                this.setState({showmenu: true});
            } else {
                this.setState({showmenu: false});
            }
        },
        render: function() {
            return (
                <div>
                    <button className="menu-button btn btn-default" type="submit" value="Search" onClick={this.show}>Menu</button>
                    { this.state.showmenu ? <MenuBox /> : null }
                </div>
            );
        }
    });
    var MenuBox = React.createClass({
        render: function(){
            return (
                    <div className="MenuBox">
                       <MenuItem><Users></Users></MenuItem>
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
                <div className="MenuItem">{this.props.children}</div>
            )
        }
    });
    var Users = React.createClass({
        getInitialState: function() {
        return { showItem: false };
        },
        show: function() {
            this.setState({showItem: true});
            document.removeEventListener("click", this.show);
        },
        render: function(){
            return(
                <div>
                <div className="Users" onClick={this.show}>Users</div>
                { this.state.showItem ? <UsersList/> : null }
                </div>
            )
        }
    });
    var UsersList = React.createClass({
          loadUsersFromServer: function() {
            $.ajax({
              url: '../Controllers/Users.php',
              dataType: 'json',
              cache: false,
              success: function(data) {
                this.setState({data: data});
              }.bind(this),
              error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
              }.bind(this)
            });
          },
          handleCommentSubmit: function(comment) {
            $.ajax({
              url: '../Controllers/UserPost.php',
              dataType: 'json',
              type: 'POST',
              data: comment,
              success: function(data) {
                this.setState({data: data});
              }.bind(this),
              error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
              }.bind(this)
            });
          },
          getInitialState: function() {
            return {data: []};
          },
          componentDidMount: function() {
            this.loadUsersFromServer();
          },
          render: function() {
            return (
              <div className="usersBox">
                <h1>{this.state.data}</h1>
                <UserForm onCommentSubmit={this.handleCommentSubmit} />
              </div>
            );
          }
        });
        var UserForm = React.createClass({
          handleSubmit: function(e) {
            e.preventDefault();
            var email = React.findDOMNode(this.refs.email).value.trim();
            var password = React.findDOMNode(this.refs.password).value.trim();
            var firstname = React.findDOMNode(this.refs.firstname).value.trim();
            var lastname = React.findDOMNode(this.refs.lastname).value.trim();
            var country = React.findDOMNode(this.refs.country).value.trim();
            this.props.onCommentSubmit({firstname: firstname, lastname: lastname, email: email, password: password, country: country});
            React.findDOMNode(this.refs.email).value = '';
            React.findDOMNode(this.refs.firstname).value = '';
            React.findDOMNode(this.refs.lastname).value = '';
            React.findDOMNode(this.refs.password).value = '';
            React.findDOMNode(this.refs.country).value = '';
            return;
          },
          render: function() {
            return (
              <form className="UserForm" onSubmit={this.handleSubmit}>
                <input type="text" placeholder="Your name" ref="firstname" />
                <input type="text" placeholder="Your lastname" ref="lastname" />
                <input type="text" placeholder="Your email" ref="email" />
                <input type="text" placeholder="password" ref="password" />
                <input type="text" placeholder="country" ref="country" />
                <input type="submit" value="Post" />
              </form>
            );
          }
        });


    React.render(<Menu />, document.body);
    </script>
</head>
<body>
</body>
</html>
