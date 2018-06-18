<!DOCTYPE HTML>
<html lang="en">
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
<script type="text/javascript">
    function validateform() {
        var name = document.registration.user_name.value;
        var password = document.registration.user_password.value;
        var x = document.registration.user_email.value;
        var atposition = x.indexOf("@");
        var dotposition = x.lastIndexOf(".");
        var firstpassword = document.registration.user_password.value;
        var secondpassword = document.registration.user_password2.value;

        if ((nameCheck(name)) && (passwordCheck(password, firstpassword, secondpassword)) &&
            (emailCheck(x, atposition, dotposition))) {
            return true;
        } else
            return false;
    }

    function nameCheck(name) {
        if (name == null || name == "") {
            alert("Name can't be blank");
            return false;
        } else {
            return true;
        }

    }

    function passwordCheck(password, firstpassword, secondpassword) {
        if (password == null || password == "") {
            alert("Password can't be blank");
            return false;
        }
        else if (firstpassword == secondpassword) {
            return true;
        }
        else {
            alert("password must be same!");
            return false;
        }
    }

    function emailCheck(x, atposition, dotposition) {
        if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= x.length) {
            alert("Please enter a valid e-mail address \n atpostion:" + atposition + "\n dotposition:" + dotposition);
            return false;
        }
        else

            alert('Form Succesfully Submitted');
        return true;


    }

</script>

<nav class="navbar navbar-expand-lg navbar-light bg-light"><a class="navbar-brand" href="../../hr/">Isratt
																				Technologies</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
		  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
			 class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	   <ul class="navbar-nav mr-auto">
		  <li class="nav-item active"><a class="nav-link" href="../../hr/">Home <span class="sr-only">(current)</span></a>
		  </li>
		  <li class="nav-item"><a class="nav-link" href="../../hr/create.php">Add Employee</a></li>
		  <li class="nav-item"><a class="nav-link" href="../../hr/create_shift.php">Create Shift</a>
		  </li>
		  <li class="nav-item"><a class="nav-link" href="../../hr/create_department.php">Create Department</a>
		  </li>
		  <li class="nav-item"><a class="nav-link" href="../../hr/create_holiday.php">Create Holiday</a>
		  </li>
		  <li class="nav-item"><a class="nav-link" href="../../hr/create_designation.php">Create Designation</a>
		  </li>
		  <li class="nav-item"><a class="nav-link" href="../../hr/attendance.php">Attendance</a></li>
		  <li class="nav-item"><a class="nav-link" href="../../hr/payroll_employee.php">PayRoll</a>
		  </li>
		  <?php if (isset($_SESSION['user_email'])) {?>
		  <li class="nav-item"><a class="nav-link" href="../../hr/logout.php">Log out</a>
		  </li>
		  <?php }?>
		  <li class="nav-item"></li>

		  <div class="dropdown">
			 <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
				    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Report
			 </button>
			 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="nav-link" href="../../hr/report.php">Daily Summary Report</a> <a class="nav-link"
																			href="../../hr/daily_late_report.php">Daily
																										   Late
																										   Report</a>
				<a class="nav-link" href="../../hr/daily_absent_report.php">Daily Absent Report</a> <a
					   class="nav-link" href="../../hr/monthly_report.php">Monthly Report</a> <a class="nav-link"
																				  href="../../hr/department_employee_report.php">Department
																													    Report</a>
				<a class="nav-link" href="../../hr/employee_monthly_report.php">Employee Monthly Report</a> <a
					   class="nav-link" href="../../hr/leave_report.php">Employee Leave Report</a>


			 </div>
		  </div>
		  <div class="dropdown">
			 <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
				    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Leave
			 </button>
			 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="nav-link" href="../../hr/create_leave_type.php">Leave Type Form</a> <a class="nav-link"
																				 href="../../hr/employee_leave_entry.php">Employee
																												  Leave
																												  Form</a>

			 </div>
		  </div>
    </div>

</nav>

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
