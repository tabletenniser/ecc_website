<?php
require_once("common.php");
require_once("header.php");
//showHeader();
?>
</div>
<!--THE FOLLOWING IS THE OLD PHP APPROACH
//require_once("function-general.php");
require_once("common.php");

xecho "dsfdsf";
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
	mysql_query("lecLECT * FROM account 
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

<?php $food_array= array(
	array(
		"food"=> "炸猪扒饭",
		"price"=>"$7 ($6 for VIP members)",
		"img" => "ecc_1.jpg"
	),
	array(
		"food"=> "台式香肠饭",
		"price"=>"$7 ($6 for VIP members)",
		"img" => "ecc_2.jpg"
	),
array(
		"food"=> "鱼排饭",
		"price"=>"$7 ($6 for VIP members)",
		"img" => "ecc_3.jpg"
	),
array(
		"food"=> "烤鸡腿饭",
		"price"=>"$7 ($6 for VIP members)",
		"img" => "ecc_4.jpg"
	),
array(
		"food"=> "鸡排饭",
		"price"=>"$7 ($6 for VIP members)",
		"img" => "ecc_5.jpg"
	),
array(
		"food"=> "三杯鸡饭",
		"price"=>"$7 ($6 for VIP members)",
		"img" => "ecc_6.jpg"
	),
array(
		"food"=> "牛腩饭",
		"price"=>"$7 ($6 for VIP members)",
		"img" => "ecc_7.jpg"
	),
array(
		"food"=> "盐酥鸡饭",
		"price"=>"$7 ($6 for VIP members)",
		"img" => "ecc_8.jpg"
	),
array(
		"food"=> "卤猪排饭",
		"price"=>"$7 ($6 for VIP members)",
		"img" => "ecc_9.jpg"
	),



);

?>



<script>

function exec_table_is_displayed(){
	//alert("exec_table_is_displayed is called");
	//alert($('#dateToBeQueried').val());

	$("select").change(function(){
		//alert('Select field value has changed to' + $('#dateToBeQueried').val());
	
		var dateQueryData = {
			'dateToBeQueried' 		: $('#dateToBeQueried').val() 
		};

	   // You can perform an ajax request using the .ajax() method
	   $.ajax({
	   	type: "POST",
		url: "lunch_sale_exec_ajax.php",
		async: false,
		data: dateQueryData ,
		dataType 	: 'text', // what type of data do we expect back from the server
	        //encode          : true,
	        beforeSend: function( xhr ) {
			xhr.overrideMimeType( "text/plain; charset=utf-8" );
		},
		success: function(data) {
		    //alert(data);
		    
		    $("#exec_login_content").html(data);
		    exec_table_is_displayed();
		    //location.reload(true);
		    
		    //alert("after calling order_has_retrieved fcn");
		},
		error: function(data) {
		    alert("CANNOT ACCESS THE DATABASE AT THIS MOMENT, PLEASE TRY AGAIN LATER!!!");
		    //alert(data);
		}	
	  });
		return true;
	});

	$(".checkbox_verified").change(function(){
		//alert("delete_order clicked");
		//alert($(this));
		var $row = $(this).closest("tr");    // Find the row that contains the button
		var order_id_to_be_verified = $row.find("td").first().text();	// get first jQuery element
		var is_checked=$(this).is(':checked');
		//alert("is_checked: "+is_checked);
		if (is_checked==true)
			is_checked='1';
		else
			is_checked='0';
		
		var formUpdateData = {
			'order_id_to_be_verified' 		: order_id_to_be_verified,
			'is_checked'					: is_checked
		};

		//url_destination=is_exec ? "lunch_sale_exec_ajax.php" : "lunch_sale_ajax.php";
		
		$.ajax({
		  type: "POST",
		  url: "lunch_sale_exec_ajax.php",
		  async: false,
		  data: formUpdateData ,
		  dataType 	: 'text', // what type of data do we expect back from the server
	          //encode          : true,
	          beforeSend: function( xhr ) {
			   xhr.overrideMimeType( "text/plain; charset=utf-8" );
		  },
		  success: function(data) {
		    //alert(data);
		    //$("#order_content").html(data);
		    //alert("Order status is updated");
		    //$("#check_lunch_button").click(); 
		    exec_table_is_displayed();
		    //$("#exec_login").click(); 

		    //alert("after calling order_has_retrieved fcn");
		  },
		  error: function(data) {
		    alert("CANNOT ACCESS THE DATABASE AT THIS MOMENT, PLEASE TRY AGAIN LATER!!!");
		    //alert(data);
		  }
		});
		return true;		
	});

	order_has_retrieved(true);
}

function order_has_retrieved(is_exec){
	if(arguments.length==0){	//default value for is_exec is false
	    is_exec = false;
	  }
	//alert("order_has_retrieved is called");
	// DELETE MEAL ORDER
	$(".delete_order").click(function(event){
		var r = confirm("Are you sure you want to delete the meal order?");
		if (r == true) {
		}else{
			return true;
		}
		
		var $row = $(this).closest("tr");    // Find the row that contains the button
		var order_id_to_be_deleted = $row.find("td").first().text();	// get first jQuery element
		//alert("order_id is "+ order_id_to_be_deleted);
		
		var formDeleteData = {
			'order_id_to_be_deleted' 		: order_id_to_be_deleted 
		};

		//url_destination=is_exec ? "lunch_sale_exec_ajax.php" : "lunch_sale_ajax.php";
		url_destination="lunch_sale_ajax.php";

		$.ajax({
		  type: "POST",
		  url: url_destination,
		  async: false,
		  data: formDeleteData ,
		  dataType 	: 'text', // what type of data do we expect back from the server
	          //encode          : true,
	          beforeSend: function( xhr ) {
			   xhr.overrideMimeType( "text/plain; charset=utf-8" );
		  },
		  success: function(data) {
		    //alert(data);
		    //$("#order_content").html(data);
		    alert("Your order has been deleted!");

		    //$("#check_lunch_button").click(); 
		    if (is_exec==true){
		    	//$("select").change();
		    	//exec_table_is_displayed();    	
		    	$("#exec_login").click(); 
		   } else
		    	$("#check_lunch_button").click(); 

		    //alert("after calling order_has_retrieved fcn");
		  },
		  error: function(data) {
		    alert("CANNOT ACCESS THE DATABASE AT THIS MOMENT, PLEASE TRY AGAIN LATER!!!");
		    //alert(data);
		  }
		});
		
	
		return true;
		
		
	});
}

$(function() {
	//alert("document is ready");
	$('.error').hide();


	/***************************** EXECUTIVE LOGIN *********************************/
	/***************************** EXECUTIVE LOGIN *********************************/
	/***************************** EXECUTIVE LOGIN *********************************/
	//IF EXECUTIVE LOGIN SUBMIT IS CLICKED
	$(".exec_login_form").keydown(function(key){
		if(key.which == 13){ 
			$("#exec_login").click(); 
		}
	}); 

	$("#exec_login").click(function() {

  	//alert("exec logs in button clicked");
  	var username=$("input#username").val();
  	var password=$("input#password").val();
  	
  	var formExecLoginData = {
			'username' : username,
			'password' : password,
		};

	$.ajax({
	  type: "POST",
	  url: "lunch_sale_exec_ajax.php",
	  async: false,
	  data: formExecLoginData ,
	  dataType 	: 'text', // what type of data do we expect back from the server
          //encode          : true,
          beforeSend: function( xhr ) {
		   xhr.overrideMimeType( "text/plain; charset=utf-8" );
	  },
	  success: function(data) {
	    //alert("lunch_sale_exec_ajax.php returns"+data);
	    if (data=="incorrect_password"){
	    	alert("The username or password entered is INCORRECT");
	    }else{
		    $("#exec_login_content").html(data);
		    //alert("before calling order_has_retrieved fcn");
		    exec_table_is_displayed();	
	    }	
	    
	    //alert("after calling order_has_retrieved fcn");
	  },
	  error: function(data) {
	    alert("CANNOT ACCESS DATABASE AT THIS MOMENT, PLEASE TRY AGAIN LATER!!!");
	    alert(data);
	  }
	});
	return true;    
  });
	
	
	
	
	/***************************** CHECK/CANCEL LUNCH *********************************/
	/***************************** CHECK/CANCEL LUNCH *********************************/
	/***************************** CHECK/CANCEL LUNCH *********************************/
	$(".check_lunch_form").keydown(function(key){
		if(key.which == 13){ 
			//alert("enter key pressed!");
			$("#check_lunch_button").click(); 
		}
	}); 

	//IF CHECK MEAL ORDER BUTTON PRESSED
	$("#check_lunch_button").click(function() {
  	//alert("check_lunch_button pressed");
    
    	$('.error').hide();
	    var student_number_check = $("#student_number_check").val();
	      if (student_number_check == "") {
	      $("label#student_number_check_error").show();
	      $("input#student_number_check").focus();
	      alert("Please enter your student number!");
	      return false;
	    }
	var formCheckData = {
		'student_number_check' 				: student_number_check 
	};
	
	//alert(student_number_check);
	
	$.ajax({
	  type: "POST",
	  url: "lunch_sale_ajax.php",
	  async: false,
	  data: formCheckData ,
	  dataType 	: 'text', // what type of data do we expect back from the server
          //encode          : true,
          beforeSend: function( xhr ) {
		   xhr.overrideMimeType( "text/plain; charset=utf-8" );
	  },
	  success: function(data) {
	    //alert("result queried successfully!");
	    //alert(data);
	    $("#order_content").html(data);
	    //alert("before calling order_has_retrieved fcn");
	    order_has_retrieved();		// install handler for the delete button
	    
	    //alert("after calling order_has_retrieved fcn");
	  },
	  error: function(data) {
	    alert("CANNOT ACCESS THE DATABASE AT THIS MOMENT, PLEASE TRY AGAIN LATER!!!");
	    //alert(data);
	  }
	});
	return true;    
  });
  
  
  
  
  
  
	/***************************** PURCHASE LUNCH *********************************/
	/***************************** PURCHASE LUNCH *********************************/
	/***************************** PURCHASE LUNCH *********************************/
	$(".buy_lunch_form").keydown(function(key){
		if(key.which == 13){ 
			//alert("enter key pressed!");
			$("#buy_lunch_submit").click(); 
		}
	}); 
	
	// IF PURCHASE NEW MEAL BUTTON PRESSED
  $("#buy_lunch_submit").click(function() {
  	//alert("button pressed");    
    	$('.error').hide();
    	
    	//name
    var name = $("input#name").val();
      if (name == "") {
	      $("label#name_error").show();
	      $("input#name").focus();
	      alert("Please enter your name!");
	      return false;
	}else if (name.lenth>60){
	      alert("Please enter a valid name less than 60 characters!");
	      return false;
	}
	
	//email
      var email = $("input#email").val();
      if (email == "") {
	      $("label#email_error").show();
	      $("input#email").focus();
	      alert("Please enter your email!");
	      return false;
	    }
	    
	    //phone number
    var phone_number= $("input#phone_number").val();
    /*  if (phone_number== "") {
      $("label#phone_number_error").show();
      $("input#phone_number").focus();
      return false;
    }*/
    
    	// student number
      var student_number= $("input#student_number").val();
      if (student_number== "") {
	      $("label#student_number_error").show();
	      $("input#student_number").focus();
	      alert("Please enter your student number!");
      		return false;
    }else if (student_number.length<9 || student_number.length>10){
    	$("label#student_number_validity_error").show();
	    $("input#student_number").focus();
    	alert("Please enter a VALID student number!");
      	return false;
    }
    
    //date of meal
    var date_of_meal= $("#date_of_meal").val();
      if (date_of_meal== "") {
	      $("label#date_of_meal_error").show();
	      $("input#date_of_meal").focus();
      return false;
    }
    
    //order
    var order="";
    if ($("#order_1").val()!=0){
	    order+=$("#order_1_name").text();
	    order+="*";
	    order+= $("#order_1").val();
	    order+="|";
    }
   // alert("order 1 is"+$("#order_1").val());
    //alert("order 1 name is"+$("#order_1_name").text());
    
    if ($("#order_2").val()!=0){
	    order+=$("#order_2_name").text();
	    order+="*";
	    order+= $("#order_2").val();
	    order+="|";
	}
	   
    if ($("#order_3").val()!=0){
	    order+=$("#order_3_name").text();
	    order+="*";
	    order+= $("#order_3").val();
	    order+="|";
    }
    
    if ($("#order_4").val()!=0){
	    order+=$("#order_4_name").text();
	    order+="*";
	    order+= $("#order_4").val();
	    order+="|";
    }
    
    if ($("#order_5").val()!=0){
	    order+=$("#order_5_name").text();
	    order+="*";
	    order+= $("#order_5").val();
	    order+="|";
    }
    
    if ($("#order_6").val()!=0){
	    order+=$("#order_6_name").text();
	    order+="*";
	    order+= $("#order_6").val();
	    order+="|";
    }
    
    if ($("#order_7").val()!=0){
	    order+=$("#order_7_name").text();
	    order+="*";
	    order+= $("#order_7").val();
	    order+="|";
    }
    
    if ($("#order_8").val()!=0){
	    order+=$("#order_8_name").text();
	    order+="*";
	    order+= $("#order_8").val();
	    order+="|";
    }
    
    if ($("#order_9").val()!=0){
	    order+=$("#order_9_name").text();
	    order+="*";
	    order+= $("#order_9").val();
	    order+="|";
    }

    if ($("#order_1").val()==0 && $("#order_2").val()==0 && $("#order_3").val()==0 && $("#order_4").val()==0 && $("#order_5").val()==0
    && $("#order_6").val()==0 && $("#order_7").val()==0 && $("#order_8").val()==0 && $("#order_9").val()==0) {	    
	    $("label#order_error").show();
	    $("input#oder_1").focus();
	    alert("You need to make at least one order!!!");
    	return false;
	}
    
	var formData = {
		'name' 				: name ,
		'email' 			: email ,
		'phone_number' 			: phone_number ,		
		'student_number' 	: student_number ,
		'date_of_meal' 	: date_of_meal,
		'order'		: order
	};
	
	$.ajax({
	  type: "POST",
	  url: "lunch_sale_ajax.php",
	  async: false,
	  data: formData ,
	  dataType 	: 'text', // what type of data do we expect back from the server
          //encode          : true,
          beforeSend: function( xhr ) {
		   xhr.overrideMimeType( "text/plain; charset=utf-8" );
	  },
	  success: function(data) {
	    alert("Thank you for purchasing meal with ECC, your purchase has been recorded.\nAn email has been sent to the email address provided.\nPlease remember to pick it up at the date!");
	    location.reload(true);
	    //alert(data);
	  },
	  error: function(data) {
	    alert("CANNOT ACCESS THE DATABASE AT THIS MOMENT, PLEASE TRY AGAIN LATER!!!");
	    //alert(data);
	  }
	});
	

	return true;
    
  });
});

var plus = function(obj){
	var id = $(obj).data("foodid");
	var element = $('.lunch-item-wrapper .selector-wrapper input[data-foodid="'+id+'"]');
	var int = parseInt(element.val());
	if(int<3){
		element.val(int+1);
	}
}
var subtract= function(obj){
	var id = $(obj).data("foodid");
	var element = $('.lunch-item-wrapper .selector-wrapper input[data-foodid="'+id+'"]');
	var int = parseInt(element.val());
	if(int>0){
		element.val(int-1);
	}
}

</script>

<div class="container content-panel">

<h3 style="text-align:center; font-weight:normal; font-size:35px;line-height:100px"> We offers <span style="font-weight:bold;color:rgb(115,0,127);">Convenient and Delicious </span>lunch boxes</br> Every Monday and Thursday 12pm-1pm Galbrieth Building Lobby	</h3>


</div>






	<div id="lunch_sale_wrapper">
		<form class="buy_lunch_form" fole="form" method="POST">
		
			<div class="form-group">
					<div class="container content-panel" style="text-align:center;">
					<?php 
		$i=0;
		foreach ($food_array as $food){ 
		$i+=1;
		$order="order_".$i;
		$name=$order."_name";
		?>

											<div class="lunch-item-wrapper">
							<div class="pic-wrapper">
								<img src=<?php echo "./images/lunch/".$food["img"]?>></img>
								<div class="text-overlay bottom-right" id="<?php echo $name?>"><?php echo $food["food"]?></div>
								<div class="text-overlay top-left"><?php echo $food["price"]?></div>
			
							</div>
							<div class="control-wrapper">
							<div class="selector-wrapper">
						<span class="small-btn" onclick="subtract(this)"  data-foodid="<?php echo $i?>" ><span class="glyphicon glyphicon-minus" ></span></span>	
						 <input type="<?php echo $order?>" name="<?php echo $order?>" id="<?php echo $order?>" data-foodid ="<?php echo $i?>" required="true" Value="0" readonly></input>
						 <span class="small-btn" onclick="plus(this)" data-foodid="<?php echo $i?>"><span class="glyphicon glyphicon-plus" ></span></span>
						</div>
							</div>
						</div>
						<?php } ?>	
																	
										</div>	
					<div class="center"><label class="error" for="order" id="order_error" style="margin-left:5em;">At least one order must be made!!!</label></div><br/>
				<br/>
				<div class="banner-dark "><div class="container content-panel"><div class="form_input_container ">
					<div class="form-row">
					<div class="form-label"><h4>name</h4></div> 
					
					<input class="form-control" type="text" name="name" id="name" required="true">
					</div>
					<div class="center"><label class="error" for="name" id="name_error">This field is required.</label></div><br/>
					<div class="form-row">
					<div class="form-label"><h4>phone number (optional)</h4></div>
					
					 <input class="form-control" type="text" name="phone_number" id="phone_number" required="false">	
		
					 </div>	
					<!--label class="error" for="phone_number" id="phone_number_error">This field is required.</label!--><br/>
					<div class="form-row">
					<div class="form-label">
					<h4>email address</h4>
					</div>			
					 <input class="form-control" type="email" name="email" id="email" autocomplete="on" required="true">
					 </div>
					<div class="center"><label class="error" for="email_number" id="email_error">This field is required.</label></div><br/>					<div class="form-row">
					<div class="form-label">
					<h4>student number</h4>
					</div>
					 <input class="form-control" type="student_number" name="student_number" id="student_number" required="true">
					 </div>
					<div class="center"><label class="error" for="student_number" id="student_number_error">This field is required.</label></div><br/>		
					<div class="center"><label class="error" for="student_number_validity" id="student_number_validity_error">Please enter a valid student number!!!</label></div><br/>		
					<div class="form-row">
					<div class="form-label">
					<h4>select date of meal</h4></div>
					<select class="form-control" type="date_of_meal" name="date_of_meal" id="date_of_meal" required="true">
				<option value="<?php echo date("Y-m-d", strtotime('next monday'));?>"><?php echo date("jS F, Y", strtotime('next monday'));  ?> &nbsp (Monday)</option>
				<option value="<?php echo date("Y-m-d", strtotime('next thursday'));?>"><?php echo date("jS F, Y", strtotime('next thursday'));  ?> &nbsp (Thursday)</option>
				</select>
					</div>
					<div class="center"><label class="error" for="date_of_meal" id="date_of_meal_error">This field is required.</label></div><br/>				<input id="buy_lunch_submit" type="button" class="form-btn " value="order"></input>	
				</div>
						
			</div></div>
		</form>
	</div></div>



<div class="container content-panel banner light">
<h2 style="font-size:2em">Check / Cancel a Meal Purchase</h2>
	<form class="check_lunch_form form_input_container " fole="form" method="POST">
		<div class="form-row">
			<div class="form-label"><h4>student number</h4></div> <input class="form-control" type="text" name="student_number_check" id="student_number_check" required="true"></div>
			<div class="center"><label class="error" for="student_number_check" id="student_number_check_error">This field is required.</label></div><br/>
			<input id="check_lunch_button" type="button" class="form-btn" value="Check" ></input>	
						
		
	</form>
	
	<div id="order_content" style="width:100%; overflow:hidden"></div>
	</br></br></br>
	<div class="form_input_container">
	<a href="lunch_sale_exec.php" style="float:right;"><h4>are you an exec? click here</h4></a> 
	</div>
</div>

<div>
<?php
require_once("footer.php");
//showFooter();
?>