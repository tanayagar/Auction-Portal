<?php
	session_start();
    if($_SESSION["logged"]!="buyer")
    header("location: index.php");
	$name=$_SESSION['Name'];
	echo "<title> Welcome $name </title>";
	$db=mysqli_connect('localhost','root','','auction') or die("connection failed");
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
      input, button{
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
  			<li><a href="Listings.php">Search Products</a></li>
  			<li><a href="addTender.php">Add Tender</a></li>
  			<li><a class="active" href="userOrders.php">My Orders</a></li>
        <li><a href="index.php">Logout</a><li>
		</ul>
  	<form method="POST" action="Listings.php">
      <table>
        <tr>
          <th>Order Id</th>
          <th>Product Id</th>
          <th>Seller Name</th>
          <th>Bid</th>
          <th>Quantity</th>
          <th>Address</th>
          <th>Status</th>
        </tr>
        <?php
        $query="SELECT * FROM orders where BuyerUsr='$name';";
        mysqli_query($db,$query) or die("Query Failed");
        $result=mysqli_query($db,$query);
        while($row=mysqli_fetch_array($result)){
          echo '<tr>';
          echo '<td>'.$row['OrderId'].'</td>';
          echo '<td>'.$row['productId'].'</td>';
          echo '<td>'.$row['SellerUsr'].'</td>';
          echo '<td>'.$row['Amount'].'</td>';
          echo '<td>'.$row['Quantity'].'</td>';
          echo '<td>'.$row['Address'].'</td>';
          if ($row['status']==0)
            echo '<td> Not Confirmed </td>';
          else
            echo '<td> Confirmed </td>';
          echo '</tr>';
        }
        echo '</table>';
        mysqli_close($db);
        echo "<form action='Listings.php'><button action='Listings.php'>Go Back</button></form>";
        ?>
      </form>
 </body>
</html>	