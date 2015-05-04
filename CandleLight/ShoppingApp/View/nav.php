<?php
?>
<!DOCTYPE HTML >
<html>
<head>
  <title></title>
</head>
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="js/react-with-addons.min.js"></script>
<script src="js/JSXTransformer.js"></script>
<script src="js/ReactRouter.js"></script>
<script type="text/jsx">
    var ReactTransitionGroup = React.addons.TransitionGroup;
var Router = ReactRouter;
var Route = Router.Route, DefaultRoute = Router.DefaultRoute,
  Link=Router.Link, RouteHandler = Router.RouteHandler;


    var App = React.createClass({
      render() {
        return (
          <div className="nav">
            <Link to="app">Home</Link>
            <Link to="login">Login</Link>

            {/* this is the importTant part */}
            <RouteHandler/>
          </div>
        );
      }
    });
    var Login = React.createClass({

  render() {
    return(<div>Welcome to login</div>);
  }
});


var routes = (
  <Route name="app" path="/" handler={App}>
    <Route name="login" path="/login" handler={Login}/>
  </Route>
);

Router.run(routes, function (Handler) {
  React.render(<Handler/>, document.body);
});

</script>
<body>

</body>
</html> 