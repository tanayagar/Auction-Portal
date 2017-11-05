	<?php
	session_start();
	$name=$_SESSION['Name'];
	$Err=0;
	$idee=$_POST['submit'];
	$db=mysqli_connect('localhost','root','','auction') or die('connection failed');
	
	if ($idee==1){
	$pname=$descp='';
	$minbid=$maxbid=$Qty=$Exp=0;
	$descp=$_POST['desc'];
	if ($_POST['name']!="")
		$pname=$_POST['name'];
	else{
		echo "Please Enter Product Name<br>";
		$Err++;
	} 

	if ($_POST['minbid']!=""){
		if (is_numeric($_POST['minbid']))
			$minbid=$_POST['minbid'];
		else{
			echo "Bid must be numeric<br>";
			$Err++;
		}
	}
	else{
		echo "Please Enter Minimum Bid<br>";
		$Err++;
	}

	$d1=date_create($_POST['expiry']);
	$d2=date_create(date('d-m-Y'));
	$diff=date_diff($d2,$d1);
	if($diff->format("%R%a")<0){
		echo "Enter Date in future<br>";
		$Err++;
	}
	else{
		$Exp=date_format($d1,'Y-m-d');
	}

	if ($_POST['maxbid']!=""){
		if (is_numeric($_POST['maxbid'])){
			if($_POST['maxbid']>$minbid)
			$maxbid=$_POST['maxbid'];
			else{
				echo "Maximum Bid must be greater than Minimum Bid<br>";
				$Err++;
			}
		}
		else{
			echo "Bid must be numeric<br>";
			$Err++;
		}
	}
	else{
		echo "Please Enter Maximum Bid<br>";
		$Err++;
	}
	if($_POST['qty']!=""){
		$temp=(float)$_POST['qty']-(int)$_POST['qty'];
		if (is_numeric($_POST['qty'])&&$temp==0){
			$Qty=(int)$_POST['qty'];
		}
		else{
			echo "Quantity must be an Integer<br>";
			$Err++;
		}
	}
	else{
		echo "Please Enter Quantity<br>";
		$Err++;
	}
	if($Err==0){
		$max="SELECT MAX(productId) as \"lastId\" from product ";
		$max=mysqli_query($db,$max) or die("query failed");
		$max=mysqli_fetch_array($max);
		$max=$max['lastId']+1;

		$query="INSERT into product VALUES($max,'$pname',$maxbid,$minbid,$Qty,'$name','$descp','0','$Exp');";
		$result=mysqli_query($db,$query) or die("could not add");
		if($result){
			echo "<title> Successfully Added Product</title>";
			echo "Successfully Added Product";
		}
	}
	else{
		echo "<title> Failed to Add Product</title>";
		echo "Failed to Add Product . Try Again";
	}
		echo "<form action='Seller_portal.php'><button action='Seller_portal.php'>Go Back</button></form>";
	}



	if ($idee==4){
		$Bid=$Quantity=0;
		if ($_POST['Bid']!=""){
			if($_SESSION['CB']!=NULL && $_SESSION['CB']>=$_POST['Bid']){
				echo "Enter Bid Greater than Current Bid<br>";
				$Err++;
			}
			else if($_SESSION['MinBid']>$_POST['Bid']){
				echo "Enter Bid Greater than Minimum Bid<br>";
				$Err++;
			}
			else{
				$Bid=(float)$_POST['Bid'];
			}
		}
		else{
			echo "Enter your bid amount<br>";
			$Err++;
		}

		if($_POST['Qty']!="" && $_POST['Qty']>'0'){
			if ((int)$_SESSION['Q']<(int)$_POST['Qty']){
				echo "Please Enter Quantity Lesser than ".$_SESSION['Q']."<br>";
				$Err++;
			}
			else{
				$Quantity=(int)$_POST['Qty'];
			}
		}
		else{
			echo "Enter Valid Quantity<br>";
			$Err++;
		}

		if($_POST['addr']!="")
			$address=$_POST['addr'];
		else{
			echo "Enter Address<br>";
		}
		if($Err==0){
			$status=0;
			if ($Bid>$_SESSION['MB']){
				echo "<title> Order Confirmed! </title>";
				echo "Congrats! You are the final Bidder<br>Order Confirmed<br>";
				$status=1;
			}
			$max="SELECT MAX(OrderId) as \"lastId\" from orders ";
			$max=mysqli_query($db,$max) or die("query failed");
			$max=mysqli_fetch_array($max);
			$max=$max['lastId']+1;

			$seller=$_SESSION['Seller'];
			$Pid=$_SESSION['pid'];

			$query="INSERT into orders VALUES($max,'$name','$seller',$Bid,'$address',$Pid,$Quantity,$status);";
			$result=mysqli_query($db,$query) or die("could not add");

			$updateQ="update product set quantity=quantity-$Quantity,currBid=$Bid where productId=$Pid;";
			$result2=mysqli_query($db,$updateQ) or die('Could not update');
			if($result && $result2){
				echo "<title> Successfully Added Product</title>";
				if($status!=1){
				echo "Successfully Added Product<br>";
				echo "Please Comeback later to check Status";
				}
			}
		}

		else{
			echo "<title> Failed to Bid</title>";
			echo "Failed to Bid . Try Again";
		}
		echo "<form action='Listings.php'><button action='Listings.php'>Go Back</button></form>";
	}
	
	if($idee==5){
		$PID=$_SESSION['Product_to_delete'];
		$query="DELETE from product where productId=$PID;";
		$result=mysqli_query($db,$query) or die("Delete Failed");
		$query="DELETE from orders where productId=$PID;";
		$result2=mysqli_query($db,$query) or die("Delete Failed");
		if($result && $result2){
			echo "<title> Deleted Product !</title>";
			echo "Deleted Successfully";
		}
			echo "<form action='Seller_portal.php'><button action='Seller_portal.php'>Go Back</button></form>";
	}

	if ($idee==6){
		$PID=$_SESSION["Product_to_finalize"];
		$Stat=$_SESSION["Sale_status"];
		$OID=$_SESSION["Order_to_finalize"];
		if ($Stat==1){
			echo "Order Already Completed<br>";
			echo "<title> Please Try Again !</title>";
		}
		else {
			$query="SELECT amount,quantity from orders where OrderId=$OID";
			$result=mysqli_query($db,$query) or die('No fetch Data');
			while($row=mysqli_fetch_array($result)){
				$qty=$row['quantity'];
				$amt=$row['amount'];
			}

			$query="UPDATE orders set status=1 where OrderId=$OID";
			$result=mysqli_query($db,$query) or die('Could not sell');

			$query="UPDATE product set minbid=maxbid, maxbid=maxbid+$amt, currBid=0 where productId=$PID;";
			$result2=mysqli_query($db,$query) or die('Could not Update');
			if($result2 && $result){
				echo "<title> Success !</title>";
				echo "Successfully Sold and Updated";
			}
			}
				echo "<form action='Seller_orders.php'><button action='Seller_orders.php'>Go Back</button></form>";

	}
	?>