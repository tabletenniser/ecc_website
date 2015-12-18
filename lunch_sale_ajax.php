<?php
require_once("common.php");

$name =$_POST["name"];
$email =$_POST["email"];
$phone_number=$_POST["phone_number"];
$student_number =$_POST["student_number"];
$date_of_meal =$_POST["date_of_meal"];
$order=$_POST["order"];
$student_number_check =$_POST["student_number_check"];	// for deleting launch sales
$order_id_to_be_deleted =$_POST["order_id_to_be_deleted"];	// for deleting launch sales

/*echo "AJAX.php";
echo "name :".$name ;
echo "email :".$email ;
echo "student_number :".$student_number ;
echo "date_of_meal :".$date_of_meal ;
echo "order:".$order;
echo "order_id_to_be_deleted:".$order_id_to_be_deleted;*/

// FOR NEW MEAL PURCHASE
if($name !="" && $name !="NaN" && 
$email !="" && $email !="NaN" &&
$student_number !="" && $student_number !="NaN" &&
$date_of_meal !="" && $date_of_meal !="NaN" && 
$order !="" && $order !="NaN"){
	//echo "everything has a value";
	
	$email=mysql_real_escape_string($email);
	$name=mysql_real_escape_string($name);
	$student_number=mysql_real_escape_string($student_number);
	$phone_number=mysql_real_escape_string($phone_number);
	$date_of_meal=mysql_real_escape_string($date_of_meal);
	$order=mysql_real_escape_string($order);
	$datetime_submitted=date("Y-m-d H:i:s");
	
	//echo "\n NEWorder:".$order;
	
	mysql_query("INSERT INTO lunchSale (name, email, student_number, phone_number, date_of_meal, picked_up, datetime_submitted, food_order) VALUES(N'$name', N'$email', N'$student_number', N'$phone_number', N'$date_of_meal', N'0', N'$datetime_submitted', N'$order')") or die (mysql_error($con));
	send_verify_email($name, $email, $date_of_meal);		// fcn from common.php
	//mysql_query("INSERT INTO lunchSale (name, email, student_number, phone_number, date_of_meal, food_order, datetime_submitted) VALUES(N'$name', N'$email', N'$student_number', N'$phone_number', N'$date_of_meal', N'$order', N'$datetime_submitted')") or die (mysql_error($con));
			
	
// FOR MEAL PURCHASE DELETE
}else if ($order_id_to_be_deleted!="" && $order_id_to_be_deleted!="NaN"){
	$order_id_to_be_deleted =mysql_real_escape_string($order_id_to_be_deleted);	
	//echo "order_id_to_be_deleted:".$order_id_to_be_deleted;
	
	$result=mysql_query("DELETE FROM lunchSale WHERE id ='$order_id_to_be_deleted'") or die (mysql_error($con));
		
// FOR MEAL PURCHASE CHECK
}else if ($student_number_check!="" && $student_number_check!="NaN"){
	$student_number_check=mysql_real_escape_string($student_number_check);	
	//echo "student_number_check:".$student_number_check;
	
	$result=mysql_query("SELECT * FROM lunchSale WHERE student_number='$student_number_check' ORDER BY date_of_meal DESC") or die (mysql_error($con));
	$num_of_rows = mysql_num_rows($result);
	if ($num_of_rows!=0){			
		if ($order_row=mysql_fetch_array($result)){		
			echo "<table border='1'>";
			echo "<tr><th>ID</th><th>Date of meal</th><th>Name</th><th>Email</th>";
			echo "<th>Student Number</th><th>Phone Number</th><th>Order</th><th>Date Submitted</th><th>Delete</th></tr>";
			do {
				echo "<tr><td class='view'>".htmlspecialchars($order_row['id'])."</td>";
				echo "<td class='view'>".htmlspecialchars($order_row['date_of_meal'])."</td>";
				echo "<td class='view'>".htmlspecialchars($order_row['name'])."</td>";			
				echo "<td class='view'>".htmlspecialchars($order_row['email'])."</td>";	
				echo "<td class='view'>".htmlspecialchars($order_row['student_number'])."</td>";
				echo "<td class='view'>".htmlspecialchars($order_row['phone_number'])."</td>";
				echo "<td class='view'>".htmlspecialchars($order_row['food_order'])."</td>";	
				echo "<td class='view'>".htmlspecialchars($order_row['datetime_submitted'])."</td>";
				echo "<td class='view'><button class='delete_order btn btn-default'>Delete this order</button></td></tr>";
				echo "<td class='view'>".htmlspecialchars($order_row['order'])."</td></tr>";
			}while ($order_row =mysql_fetch_array($result)); 
			echo "</table>";
		}else{
			echo "result cannot be found!";
		}
			
	}else{
		echo "No orders have been made with the student number given!";
	}	

}else{
	echo "What the fuck???";
}
mysql_close($con);
?>