<?php
	session_start();
    if($_SESSION["logged"]!="buyer")
    header("location: index.php");
	$name=$_SESSION['Name'];
	echo "<title> Complete Your Order, $name </title>";
	$db=mysqli_connect('localhost','root','','auction') or die("connection failed");
  $pId=$_POST['NewBid'];
  $time=$_SESSION['timeleft'];
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
  			<li><a class="active" href="Listings.php">Search Products</a></li>
  			<li><a href="addTender.php">Add Tender</a></li>
  			<li><a href="userOrders.php">My Orders</a></li>
        <li><a href="index.php">Logout</a></li>
		</ul>
      <?php
        if($pId==-1){
          echo "Product Expired";
          echo "<form action='Listings.php'><button action='Listings.php'>Go Back</button></form>";
        }
        else{
          ?>
  	<form method="get" action="newOrder.php">
      <table>
        <tr>
          <th>Product Name</th>
          <th>Minimum Bid</th>
          <th>Current Bid</th>
          <th>Description</th>
          <th>Stock</th>
          <th>Seller</th>
        </tr>
        <?php

        $query="SELECT * FROM product where productId=$pId;";
        mysqli_query($db,$query);
        $result=mysqli_query($db,$query);
        while($row=mysqli_fetch_array($result)){
          echo '<tr>';
          echo '<td>'.$row['productName'].'</td>';
          echo '<td>'.$row['minbid'].'</td>';

          if($row['currBid']==0)
          	echo '<td>NEW</td>';
          else
          	echo '<td>'.$row['currBid'].'</td>';

          $_SESSION['CB']=$row['currBid'];
          $_SESSION['MB']=$row['maxbid'];
          $_SESSION['MinBid']=$row['minbid'];
          $_SESSION['Q']=$row['quantity'];

          echo '<td>'.$row['descp'].'</td>';

          if($row['quantity']>5)
          	echo '<td>Available</td>';
          else if($row['quantity']>0)
          	echo '<td>Few Left</td>';
          else
          	echo '<td>Out of Stock</td>';

          echo '<td>'.$row['sellerUsr'].'</td>';
          $_SESSION['Seller']=$row['sellerUsr'];
          $_SESSION['pid']=$row['productId'];
         }
          echo '</table>';
          echo "<br>";
          echo '</tr>';

        mysqli_close($db);
        ?>
      </form>
      <form method="POST" action="landing_page.php">
        Enter your Bid  <input type="text" name="Bid" value=""><br>
        Enter Quantity <input type="text" name="Qty" value=""><br><br>
        Enter Address <textarea rows='4' columns='10' name='addr' value=""></textarea><br>
        Payment Method <input type='radio' checked>Cash On Delivery

        <button type='submit' name='submit' value='4'>Place Bid</button>
      </form>
      <?php
        //if($_SESSION)
      }
      ?>
 </body>
</html>	