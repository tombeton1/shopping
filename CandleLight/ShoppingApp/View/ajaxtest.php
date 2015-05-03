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
            setInterval(this.loadUsersFromServer, this.props.pollInterval);
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
        React.render(<UsersList pollInterval={2000} />, document.body);

    </script>
</head>

<body>

</body>
</html> 