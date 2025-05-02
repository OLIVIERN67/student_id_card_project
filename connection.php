<?php
$connect=mysqli_connect("localhost","root","","crat");

//check if database have been connected well or not connected
if (!$connect) {
	// you will see this messages if you have beeen connected to database well
	//echo "database connected well you can make samething to db";
	echo "try again to connected to any database";
}
//you will see this messages when database are not copmnnected 

//else{
	//echo "try again to connected to any database";
//}
?>