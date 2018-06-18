<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");

use App\Attendance\Attendance;
use App\Leave\Leave;
use App\Hr\Hr;
use App\Message\Message;
use App\User\User;

$msg = Message::message();


if (!empty($msg)) {
    echo "<div style='height: 30px; text-align: center'> <div class='alert-success '  style = 'text-align: center;height: 50px;' id = 'message' > <h3 > $msg</h3 > </div ></div >";
} ?>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"-->
    <!--		integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
		integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
		  crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
		  integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
		  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
		  integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
		  crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
		  integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
		  crossorigin="anonymous"></script>
    <!--    -->
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"-->
    <!--		  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"-->
    <!--		  crossorigin="anonymous"></script>-->
    <!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"-->
    <!--		  integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4"-->
    <!--		  crossorigin="anonymous"></script>-->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script> $(function () {
            $('#datepicker').datepicker({minDate: '-60d', maxDate: 10});
            $('#datepicker2').datepicker({minDate: '-60d', maxDate: 10});
            $('#datepicker3').datepicker({minDate: '-60d', maxDate: 10});
            $('#datepicker4').datepicker();
            $('#datepicker5').datepicker();
            $('#datepicker6').datepicker();
            $('#datepicker_leave1').datepicker({minDate: '-0d', maxDate: 180});
            $('#datepicker_leave2').datepicker({minDate: '-0d', maxDate: 180});

        });</script>

</head>
<body>
<div class="container">
    <div class="row">
	   <div class="col-md-12">
		  <form method='POST' action='login_process.php'>
			 <h4 style="text-align: center">Log In Form</h4>
			 <div class='col-md-4 offset-md-4'>
				<label for="email">Email</label> <input type='text' class='form-control' id="email"
												name='user_email' placeholder='Enter  Email'
												required="1"/>
			 </div>
			 <br>

			 <div class='col-md-4 offset-md-4'>
				<label for="password">Password</label> <input type='password' class='form-control' id="password"
													 name='user_password'
													 placeholder='Enter Password' required="1"/>
			 </div>
			 <br>

			 <div class='col-md-4 offset-md-4'>
				<input type='submit' id='button' class='btn btn-primary login-button'
					  value='Sign in'>
			 </div>
		  </form>
	   </div>
    </div>
</div>
<script>
    jQuery(function ($) {
        $('#message').fadeOut(550);
        $('#message').fadeIn(550);
        $('#message').fadeOut(550);
        $('#message').fadeIn(550);
        $('#message').fadeOut(550);
        $('#message').fadeIn(550);
        $('#message').fadeOut(550);
    })
</script>
