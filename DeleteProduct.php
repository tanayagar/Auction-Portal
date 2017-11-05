<?php
	session_start();
	$name=$_SESSION['Name'];
	echo "<title> Product Deletion </title>";
	$db=mysqli_connect('localhost','root','','auction') or die("connection failed");
  $pid=$_POST['Delete'];
  $_SESSION['Product_to_delete']=$pid;
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
        <li><a href="Seller_orders.php">My Orders</a></li>
        <li><a href="tenders.php">Tenders</a></li>
        <li><a class="active" href="myproducts.php">My Products</a></li>
        <li><a href="index.php">Logout</a><li>
    </ul>
  	<form method="POST" action="landing_page.php">
     <center> <h3> This cannot be undone </h3><center>
      <table>
        <tr>
          <th>Product Name</th>
          <th>Minimum Bid</th>
          <th>Maximum Bid</th>
          <th>Current Bid</th>
          <th>Description</th>
          <th>Stock</th>
          <th>Time Left</th>
         
        </tr>
        <?php
        $query="SELECT * FROM product where productId=$pid;";
        mysqli_query($db,$query);
        $result=mysqli_query($db,$query);
        while($row=mysqli_fetch_array($result)){
          echo '<tr>';
          echo '<td>'.$row['productName'].'</td>';
          echo '<td>'.$row['minbid'].'</td>';
          echo '<td>'.$row['maxbid'].'</td>';
          echo '<td>'.$row['currBid'].'</td>';
          echo '<td>'.$row['quantity'].'</td>';
          echo '<td>'.$row['descp'].'</td>';
          $d1=date_create($row['expiry']);
          $d2=date_create(date('d-m-Y'));

          $diff=date_diff($d2,$d1);

          if($diff->format("%R%a")<0){
            echo '<td>Expired<td>';
            $row['productId']=-1;
          }
          else if($diff->format("%R%a")==0)
            echo '<td>Last Day<td>';
          else
            echo '<td>'.$diff->format("%a").' days left<td>';
          echo '</tr>';
        }
        echo '</table>';
        mysqli_close($db);
        ?>
        <button type='submit' name='submit' value='5'>Delete</button>
 </body>
</html>	