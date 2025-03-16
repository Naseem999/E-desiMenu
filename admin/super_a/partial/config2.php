<?php
$servername="localhost";
$dbUsername="id16143662_e_desimenu";
$password="e@desiMenuMenu1";
$dbName="id16143662_edesimenu";
$port=3306;
$con=new mysqli($servername,$dbUsername,$password,$dbName,$port);

if($con->connect_error){
    die("Connection Failed".$con->connect_error);
}