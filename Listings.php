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
  			<li><a class="active" href="Listings.php">Search Products</a></li>
  			<li><a href="addTender.php">Add Tender</a></li>
  			<li><a href="userOrders.php">My Orders</a></li>
        <li><a href="index.php">Logout</a><li>
		</ul>
  	<form method="POST" action="newOrder.php">
      <table>
        <tr>
          <th>Product Name</th>
          <th>Minimum Bid</th>
          <th>Current Bid</th>
          <th>Description</th>
          <th>Stock</th>
          <th>Seller</th>
          <th>Time Left</th>
         
        </tr>
        <?php
        $query="SELECT * FROM product;";
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

          echo '<td>'.$row['descp'].'</td>';

          if($row['quantity']>5)
          	echo '<td>Available</td>';
          else if($row['quantity']>0)
          	echo '<td>Few Left</td>';
          else
          	echo '<td>Out of Stock</td>';

          echo '<td>'.$row['sellerUsr'].'</td>';

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
          $_SESSION['timeleft']=$diff->format("%a");
          echo "<td> <button type='submit' name='NewBid' value=".$row['productId'].">Bid</button></td>";
          echo '</tr>';
        }
        echo '</table>';
        mysqli_close($db);
        ?>
      </form>
 </body>
</html>	