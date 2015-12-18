<?php
require_once("common.php");

//var_dump($_POST);
$username=$_POST["username"];
$password=$_POST["password"];
$dateToBeQueried=$_POST["dateToBeQueried"];
$order_id_to_be_verified=$_POST["order_id_to_be_verified"];
$is_checked=$_POST["is_checked"];

/*hho "EXEC_AJAX.php";
echo "username:".$username;
echo "password:".$password;
echo "dateToBeQueried: ".$dateToBeQueried;*/

// FOR EXEC LOGIN
if($username!="" && $username!="NaN" && 
$password!="" && $password!="NaN"){
	//echo "everything has a value";
	
	$username=mysql_real_escape_string($username);
	$password=mysql_real_escape_string($password);
	//$datetime_submitted=date("Y-m-d H:i:s");
	
	
	$result=mysql_query("SELECT * FROM account WHERE username='$username' AND password='$password'") or die (mysql_error($con));
	$row = mysql_fetch_array($result); 
	$num_results = mysql_num_rows($result); 
	if ($num_results == 0){ 
		echo "incorrect_password"; 
	}else{ 
		//echo 'correct password';
		$next_monday_date=date("Y-m-d", strtotime('next monday'));
		$next_thursday_date=date("Y-m-d", strtotime('next thursday'));
		if ($next_monday_date<$next_thursday_date){
			$next_date=$next_monday_date;
		}else{
			$next_date=$next_thursday_date;
		}
		
		
		$result=mysql_query("SELECT * FROM lunchSale WHERE date_of_meal='$next_date' ORDER BY name DESC") or die (mysql_error($con));
		$num_of_rows = mysql_num_rows($result);
		if ($num_of_rows==0){	
			echo "No orders have been made on this date!";
			$result_for_date_dropdown=mysql_query("SELECT DISTINCT date_of_meal FROM lunchSale ORDER BY date_of_meal DESC") or die (mysql_error($con));
				$num_of_rows_for_date_dropdown= mysql_num_rows($result_for_date_dropdown);				
				if ($num_of_rows_for_date_dropdown<=0){
					echo "No meal date in database. Please make sure people have purchased and data is stored into database!";
				}else if($row_for_date_dropdown=mysql_fetch_array($result_for_date_dropdown)){
					$date_of_meal;
					
					echo "<select class='form-control' type='dateToBeQueried' name='dateToBeQueried' id='dateToBeQueried' required='true'>";
					do{
						$date_of_meal=htmlspecialchars($row_for_date_dropdown['date_of_meal']);						
						if ($next_date==$date_of_meal){
							echo "<option selected='selected' value='".$date_of_meal."'>".$date_of_meal."</option>";
						}else{
							echo "<option value='".$date_of_meal."'>".$date_of_meal."</option>";
						}

					}while($row_for_date_dropdown=mysql_fetch_array($result_for_date_dropdown));
					echo "</select><br/>";
				}else{
					echo "date_of_meal result cannot be found!";
				}
				
				echo "<table  style='margin: 0px auto; overflow: hidden;' border='1'>";
				echo "<tr><th>ID</th><th>Date of meal</th><th>Name</th><th>Email</th>";
				echo "<th>Student Number</th><th>Phone Number</th><th>Order</th><th>Date Submitted</th><th>Delete</th><th>Picked up</th></tr>";
				echo "</table>";
		}else if ($num_of_rows<0){
			echo "WTF?? Number_of_rows queried is less than 0";
		}else{		
			if ($order_row=mysql_fetch_array($result)){	
				$result_for_date_dropdown=mysql_query("SELECT DISTINCT date_of_meal FROM lunchSale ORDER BY date_of_meal DESC") or die (mysql_error($con));
				$num_of_rows_for_date_dropdown= mysql_num_rows($result_for_date_dropdown);				
				if ($num_of_rows_for_date_dropdown<=0){
					echo "No meal date in database. Please make sure people have purchased and data is stored into database!";
				}else if($row_for_date_dropdown=mysql_fetch_array($result_for_date_dropdown)){
					$date_of_meal;
					
					echo "<select class='form-control' type='dateToBeQueried' name='dateToBeQueried' id='dateToBeQueried' required='true'>";
					do{
						$date_of_meal=htmlspecialchars($row_for_date_dropdown['date_of_meal']);						
						if ($next_date==$date_of_meal){
							echo "<option selected='selected' value='".$date_of_meal."'>".$date_of_meal."</option>";
						}else{
							echo "<option value='".$date_of_meal."'>".$date_of_meal."</option>";
						}
					}while($row_for_date_dropdown=mysql_fetch_array($result_for_date_dropdown));
					echo "</select><br/>";
				}else{
					echo "date_of_meal result cannot be found!";
				}
				
				echo "<table  style='margin: 0px auto; overflow: hidden;' border='1'>";
				echo "<tr><th>ID</th><th>Date of meal</th><th>Name</th><th>Email</th>";
				echo "<th>Student Number</th><th>Phone Number</th><th>Order</th><th>Date Submitted</th><th>Delete</th><th>Verified</th></tr>";
				do {
					echo "<tr><td class='view'>".htmlspecialchars($order_row['id'])."</td>";
					echo "<td class='view' style='min-width:6em;'>".htmlspecialchars($order_row['date_of_meal'])."</td>";
					echo "<td class='view' style='min-width:6em;'>".htmlspecialchars($order_row['name'])."</td>";			
					echo "<td class='view'>".htmlspecialchars($order_row['email'])."</td>";	
					echo "<td class='view'>".htmlspecialchars($order_row['student_number'])."</td>";
					echo "<td class='view'>".htmlspecialchars($order_row['phone_number'])."</td>";
					echo "<td class='view' style='min-width:10em;'>".htmlspecialchars($order_row['food_order'])."</td>";	
					echo "<td class='view' style='min-width:7em;'>".htmlspecialchars($order_row['datetime_submitted'])."</td>";
					echo "<td class='view'><button class='delete_order btn btn-default'>Delete this order</button></td>";
					if (htmlspecialchars($order_row['verify_code'])==1)
						echo "<td class='view'><input class='checkbox_verified' type='checkbox' checked=‘checked’></input></td></tr>";
					else
						echo "<td class='view'><input class='checkbox_verified' type='checkbox'></input></td></tr>";
					//echo "<td class='view'>".htmlspecialchars($order_row['order'])."</td></tr>";
				}while ($order_row =mysql_fetch_array($result)); 
				echo "</table>";
			}else{
				echo "result cannot be found!";
			}
				
		}	
	} 
	
}else if ($dateToBeQueried!="" && $dateToBeQueried!="NaN"){
	$dateToBeQueried =mysql_real_escape_string($dateToBeQueried);
	
	$result=mysql_query("SELECT * FROM lunchSale WHERE date_of_meal='$dateToBeQueried' ORDER BY name DESC") or die (mysql_error($con));
		$num_of_rows = mysql_num_rows($result);
		if ($num_of_rows==0){	
			echo "No orders have been made on this date!";
		}else if ($num_of_rows<0){
			echo "WTF?? Number_of_rows queried is less than 0";
		}else{		
			if ($order_row=mysql_fetch_array($result)){	
				$result_for_date_dropdown=mysql_query("SELECT  DISTINCT date_of_meal FROM lunchSale ORDER BY date_of_meal DESC") or die (mysql_error($con));	
				$num_of_rows_for_date_dropdown= mysql_num_rows($result_for_date_dropdown);				
				if ($num_of_rows_for_date_dropdown<=0){
					echo "No meal date in database. Please make sure people have purchased and data is stored into database!";
				}else if($row_for_date_dropdown=mysql_fetch_array($result_for_date_dropdown)){
					echo "<select class='form-control' type='dateToBeQueried' name='dateToBeQueried' id='dateToBeQueried' required='true'>";
					do{
						$date_of_meal=htmlspecialchars($row_for_date_dropdown['date_of_meal']);	
						if ($dateToBeQueried==$date_of_meal){
							echo "<option selected='selected' value='".$date_of_meal."'>".$date_of_meal."</option>";
						}else{
							echo "<option value='".$date_of_meal."'>".$date_of_meal."</option>";
						}
					}while($row_for_date_dropdown=mysql_fetch_array($result_for_date_dropdown));
					echo "</select><br/>";
				}else{
					echo "date_of_meal result cannot be found!";
				}
				
				echo "<table  style='margin: 0px auto; overflow: hidden;' border='1'>";
				echo "<tr><th>ID</th><th>Date of meal</th><th>Name</th><th>Email</th>";
				echo "<th>Student Number</th><th>Phone Number</th><th>Order</th><th>Date Submitted</th><th>Delete</th><th>Picked up</th></tr>";
				do {
					echo "<tr><td class='view'>".htmlspecialchars($order_row['id'])."</td>";
					echo "<td class='view' style='min-width:6em;'>".htmlspecialchars($order_row['date_of_meal'])."</td>";
					echo "<td class='view' style='min-width:6em;'>".htmlspecialchars($order_row['name'])."</td>";			
					echo "<td class='view'>".htmlspecialchars($order_row['email'])."</td>";	
					echo "<td class='view'>".htmlspecialchars($order_row['student_number'])."</td>";
					echo "<td class='view'>".htmlspecialchars($order_row['phone_number'])."</td>";
					echo "<td class='view' style='min-width:10em;'>".htmlspecialchars($order_row['food_order'])."</td>";	
					echo "<td class='view' style='min-width:7em;'>".htmlspecialchars($order_row['datetime_submitted'])."</td>";
					echo "<td class='view'><button class='delete_order btn btn-default'>Delete this order</button></td>";
					if (htmlspecialchars($order_row['verify_code'])==1)
						echo "<td class='view'><input class='checkbox_verified' type='checkbox' checked=‘checked’></input></td></tr>";
					else
						echo "<td class='view'><input class='checkbox_verified' type='checkbox'></input></td></tr>";
					//echo "<td class='view'>".htmlspecialchars($order_row['order'])."</td></tr>";
				}while ($order_row =mysql_fetch_array($result)); 
				echo "</table>";
			}else{
				echo "result cannot be found!";
			}
				
		}	
}else if ($order_id_to_be_verified!="" && $order_id_to_be_verified!="NaN"
	&& $is_checked!="" && $is_checked!="NaN"){
	$order_id_to_be_verified =mysql_real_escape_string($order_id_to_be_verified);	
	echo "order_id_to_be_verified:".$order_id_to_be_verified;
	echo "is_checked:".$is_checked;
	
	if ($is_checked=='1')
		$result=mysql_query("UPDATE lunchSale SET verify_code=1 WHERE id ='$order_id_to_be_verified'") or die (mysql_error($con));
	else
		$result=mysql_query("UPDATE lunchSale SET verify_code=0 WHERE id ='$order_id_to_be_verified'") or die (mysql_error($con));

// FOR MEAL PURCHASE CHECK
}else{
	echo "What the fuck???";
}
mysql_close($con);
?>