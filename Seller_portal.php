<?php
	session_start();
    if($_SESSION["logged"]!="seller")
    header("location: index.php");
	$name=$_SESSION['Name'];
	echo "<title> Welcome $name </title>";
?>
<html>
  <head>
<style type="text/css">
      <style>
      *{
        margin:0px;
      }
      body{
        margin: 70px;
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
        border-width: 1px;
        color: #fff;
        border-radius:5px;
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
    label{
      display: inline-block;
      width: 260px;
      float:left;
      text-align: left;
    }
     </style>
  </head>
 	<body>
 		<ul>
  			<li><a class="active" href="Seller_portal.php">Add Product</a></li>
  			<li><a href="Seller_orders.php">My Orders</a></li>
  			<li><a href="tenders.php">Tenders</a></li>
  			<li><a href="MyProducts.php">My Products</a></li>
        <li><a href="index.php">Logout</a><li>
		</ul>

 			<form name='add_product' method="POST" action="landing_page.php" >
 				<label>Enter the Name of your Product </label> <input type="text" name="name" value=""><br>
 				<label>Enter the Minimum Bid</label> <input type="text" name="minbid" value=""><br>
 				<label>Enter the Maximum Bid </label><input type="text" name="maxbid" value=""><br>
 				<label>Enter the Quantity Available</label> <input type="text" name="qty" value=""><br><br>
 				<label>Enter Item Description</label> <textarea rows='4' columns='10' name='desc' value=""></textarea><br>
 				<label>Enter the Expiry </label><input type="date" name="expiry" value=""></br>
 				<button type="submit" name="submit" value=1> Add Product </button>
 			</form>
  	</body>
</html>	