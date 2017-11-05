<?php
	session_start();
    if($_SESSION["logged"]!="seller")
    header("location: index.php");
	$name=$_SESSION['Name'];
	echo "<title> Complete Finalizing </title>";
	$db=mysqli_connect('localhost','root','','auction') or die("connection failed");
  $oid=$_POST['Final'];
  $_SESSION["Order_to_finalize"]=$oid;
?>
<html>
  <head>
  	<style type="text/css">
  		<style>
      *{
        margin:4px;
      }
      body{
      	margin:70px;
        font-family:sans-serif;
        background-color: powderblue;
      }
      table{
        border-collapse: collapse;
      }
      tr,td,th{
        border-style:solid;
      }
      input, button, textarea{
        background: #2196F3;
        border: none;
        left: 0;
        color: #fff;
        bottom: 0;
        border: 0px solid rgba(0, 0, 0, 0.1);
        border-radius:5px;
        transform: rotateZ(0deg);
        transition: all 0.1s ease-out;
      }
      ul{
    	list-style-type: none;
   	 	margin: 0;
  	  	padding: 0;
    	overflow: hidden;
    	background-color: #333;
    	position: fixed;
    	top: 0;
    	width: 100%;
	  }

	li{	
    	float: left;
	}

    li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
 }

   li a:hover:not(.active) {
    background-color: #111;
 }

   .active {
    background-color: #4CAF50;
 }
  	</style>
  </head>
  <body>
  	<ul>
        <li><a href="Seller_portal.php">Add Product</a></li>
        <li><a class="active" href="Seller_orders.php">My Orders</a></li>
        <li><a href="tenders.php">Tenders</a></li>
        <li><a href="myproducts.php">My Products</a></li>
        <li><a href="index.php">Logout</a><li>
    </ul>
  	<form method="POST" action="landing_page.php">
     <center> <h3> This cannot be undone </h3><center>
      <table>
        <tr>
          <th>Order Id</th>
          <th>Product Id</th>
          <th>Buyer</th>
          <th>Amount</th>
          <th>Quantity</th>
          <th>Address</th>
          <th>Status</th>
         
        </tr>
        <?php
        $query="SELECT * FROM orders where OrderId=$oid;";
        mysqli_query($db,$query);
        $result=mysqli_query($db,$query);
        while($row=mysqli_fetch_array($result)){
          echo '<tr>';
          echo '<td>'.$row['OrderId'].'</td>';
          echo '<td>'.$row['productId'].'</td>';
          echo '<td>'.$row['BuyerUsr'].'</td>';
          echo '<td>'.$row['Amount'].'</td>';
          echo '<td>'.$row['Quantity'].'</td>';
          echo '<td>'.$row['Address'].'</td>';
          if ($row['status']==0)
            echo '<td> Not Sold </td>';
          else{
            echo '<td> Sold </td>';
          }
          echo '</tr>';
          $_SESSION["Sale_status"]=$row['status'];
          $_SESSION["Product_to_finalize"]=$row['productId'];
        }
        echo '</table>';
        mysqli_close($db);
        ?>
        <button type='submit' name='submit' value='6'>Finalize</button>
 </body>
</html>	