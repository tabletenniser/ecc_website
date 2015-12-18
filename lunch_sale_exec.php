<?php
require_once("common.php");
require_once("header.php");
//showHeader();
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
</script>
<h3>Executive Login</h3>
	<form action="" class="exec_login_form" fole="form" method="POST">
		<div class="form-group">
			Username: <input class="form-control" type="text" name="username" id="username" required="true"><br>
			Password: <input class="form-control" type="password" name="password" id="password" required="true"><br>
			<input id="exec_login" type="button" class="form-control" value="Submit" style="background-color:#DFF; margin-left:20%; margin-right:20%; width:60%"></input>						
		</div>
	</form>
	<div id="exec_login_content"></div>
</div>
<?php
require_once("footer.php");
//showFooter();
?>