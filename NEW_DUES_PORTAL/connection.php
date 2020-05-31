<?php

session_start();
$servername="localhost";
$username="root";
$password="omshiridisai";
$database="dues_portal";
$port=3300;
$conn=new mysqli($servername,$username,$password,$database,$port);
if(!$conn)
{
die("connectioin not established".$conn->error);
}
?>