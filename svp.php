<?php
	session_start();
	$name=$_SESSION['Name'];
	echo "<title> Welcome $name </title>";
?>
<html>
  <head>
  	<style type="text/css">
  		<style>
      *{
        margin:4px;
      }
      body{
        font-family:sans-serif;
        background-color: #faebd7;
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
  	</style>
  </head>
  <body>
 </body>
</html>	