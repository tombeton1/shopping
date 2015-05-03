<?php
?>
<!DOCTYPE HTML>
<html>
<head>
  <title></title>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src = js/JSXTransformer.js></script>
    <script type="text/javascript" src="js/react.min.js"></script>
    <script type="text/jsx">
        var Users = React.createClass({
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
          getInitialState: function() {
            return {data: []};
          },
          componentDidMount: function() {
            this.loadUsersFromServer();
            setInterval(this.loadUsersFromServer, this.props.pollInterval);
          },
          render: function() {
            return (
              <div className="usersBox">
                <h1>{this.state.data}</h1>
              </div>
            );
          }
        });
        React.render(<Users pollInterval={2000} />, document.body);

    </script>
</head>

<body>

</body>
</html> 