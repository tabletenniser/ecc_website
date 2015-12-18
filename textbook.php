<?php
require_once("common.php");
require_once("header.php");
//showHeader();
?>

<!--
//require_once("function-general.php");
require_once("common.php");

echo "dsfdsf";
echo "connection:",$con;

//this function inputs a string in the form of YYYY-MM-DD and checks if it is valid
function valid_date($str){
	if(strlen($str)!=10 || !preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $str)){
		return false;
	}else{
		$year=strtok($str, "-");
		$month=strtok("-");
		$day=strtok("-");
		if (!checkdate($month, $day, $year)){
			return false;
		}
	}
	return true;
}

echo "before if statement \n";
echo "email \n",$_POST['email'];
echo "first_name \n",$_POST['first_name'];
echo "last_name \n",$_POST['last_name'];
echo "student_number \n",$_POST['student_number'];
echo "number_of_orders \n",$_POST['number_of_orders'];
echo "date_of_meal \n",$_POST['date_of_meal'];

echo "username \n",$_POST['username'];
echo "password \n",$_POST['password'];
echo "end before if statement \n";

// if the executive logs in
if ( 	isset($_POST['username']) && $_POST['username']!="" &&
	isset($_POST['password']) && $_POST['password']!=""){
	
	$username=mysql_real_escape_string($_POST['username']);
	$password=mysql_real_escape_string($_POST['password']);
	mysql_query("SELECT * FROM account 
		WHERE username=$username AND password=$password") or die (mysql_error($con));
		
}


// if the user registers
if ( 	isset($_POST['email']) && $_POST['email']!="" &&
	isset($_POST['first_name']) && $_POST['first_name']!="" &&
	isset($_POST['last_name']) && $_POST['last_name']!="" &&
	isset($_POST['student_number']) && $_POST['student_number']!="" &&
	isset($_POST['number_of_orders']) && $_POST['number_of_orders']!="" &&
	isset($_POST['date_of_meal']) && $_POST['date_of_meal']!="" 
	){
		echo "information is entered \n";
		
		$email=mysql_real_escape_string($_POST['email']);
		$first_name=mysql_real_escape_string($_POST['first_name']);
		$last_name=mysql_real_escape_string($_POST['last_name']);
		$student_number=mysql_real_escape_string($_POST['student_number']);
		$number_of_orders=mysql_real_escape_string($_POST['number_of_orders']);
		$date_of_meal=mysql_real_escape_string($_POST['date_of_meal']);
		$datetime_submitted=date("Y-m-d H:i:s");
		
		
		mysql_query("INSERT INTO lunchSale 
		(first_name, last_name, email, student_number, number_of_orders, date_of_meal, datetime_submitted) 
		VALUES(N'$first_name', N'$last_name', N'$email',N'$student_number', N'$number_of_orders', N'$date_of_meal', N'$datetime_submitted')") or die (mysql_error($con));
		
		/*if (send_verify_email($fname, $email, $verify_code)){
			echo "registration successful, please use the registered email and password to log in";
		}else{
			echo "confirmation email cannot be sent!!!";
		}*/		
		mysql_close($con);	
}
require_once("header.php");
-->




<script>
$(function() {
	$('.error').hide();
  $("#buy_lunch_submit").click(function() {
  	//alert("button pressed");
    
    	$('.error').hide();
    var name = $("input#name").val();
      if (name == "") {
      $("label#name_error").show();
      $("input#name").focus();
      alert("Please enter your name!");
      return false;
    }
      var email = $("input#email_number").val();
      if (email == "") {
      $("label#email_number_error").show();
      $("input#email_number").focus();
      return false;
    }
      var student_number= $("input#student_number").val();
      if (student_number== "") {
      $("label#student_number_error").show();
      $("input#student_number").focus();
      return false;
    }    
    var date_of_meal= $("input#date_of_meal").val();
      if (date_of_meal== "") {
      $("label#date_of_meal_error").show();
      $("input#date_of_meal").focus();
      return false;
    }
    
    alert ("nothing is none");
    var dataString = 'name='+ name + '&email=' + email + '&student_number=' + student_number + '&date_of_meal=' + date_of_meal;
	alert (dataString);
	$.ajax({
	  type: "POST",
	  url: "lunch_sale_ajax.php",
	  data: dataString,
	  success: function() {
	    alert("Thanks for purchasing meal with ECC, your purchase has been recorded. Please remember to pick it up at the date!");
	  }
	});
	return false;
    
  });
});
</script>

<div class="container col-md-12 col-sm-12">
<h3>Lunch Purchase</h3>
	<div id="lunch_sale_wrapper">
	<form class="lunch_sale" fole="form" method="POST">
		<div class="form-group">
			<div class="container col-md-6 col-sm-12">
				Name: <input class="form-control" type="text" name="name" id="name" required="true">
				<label class="error" for="name" id="name_error">This field is required.</label><br/>
				
				phone number (optional): <input class="form-control" type="text" name="phone_number" id="phone_number" required="false">			
				<!--label class="error" for="phone_number" id="phone_number_error">This field is required.</label!--><br/>
				
				Email address: <input class="form-control" type="email" name="email" id="email" autocomplete="on" required="true">			
				<label class="error" for="email_number" id="email_error">This field is required.</label><br/>					
			</div>
			<div class="container col-md-6 col-sm-12">
				Student Number: <input class="form-control" type="student_number" name="student_number" id="student_number" required="true">
				<label class="error" for="student_number" id="student_number_error">This field is required.</label><br/>		
				
				Select date of meal: <select class="form-control" type="date_of_meal" name="date_of_meal" id="date_of_meal" required="true">
				<option value="next_tuesday"><?php echo date("jS F, Y", strtotime('next tuesday'));  ?> &nbsp (Tuesday)</option>
				<option value="next_thursday"><?php echo date("jS F, Y", strtotime('next thursday'));  ?> &nbsp (Thursday)</option>
				</select>
				<label class="error" for="date_of_meal" id="date_of_meal_error">This field is required.</label><br/>		
			</div>
			<input id="buy_lunch_submit" type="submit" class="form-control" value="Submit" style="background-color:#DFF; margin-left:20%; margin-right:20%; width:60%"></input>			
		</div>
	</form>
	</div>
</div>
<nr/>
<nr/>

<div class="container col-md-12 col-sm-12">
<h3>Cancel a Meal Purchase</h3>
	<form class="exec_login" fole="form" method="POST">
		<div class="form-group">
			Please enter your student number here to see a listo of orders you have made: <input class="form-control" type="text" name="username" required="true"><br>
						
		</div>
	</form>
</div>
<div class="container col-md-4 col-sm-12">
<h3>Executive Login</h3>
	<form class="exec_login" fole="form" method="POST">
		<div class="form-group">
			Username: <input class="form-control" type="text" name="username" required="true"><br>
			Password: <input class="form-control" type="password" name="password" required="true"><br>
						
		</div>
	</form>
</div>

<?php
require_once("footer.php");
//showFooter();
?>