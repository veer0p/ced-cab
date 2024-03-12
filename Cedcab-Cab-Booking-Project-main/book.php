<?php
session_start();
include('adminwrk.php');

$pickup = $_POST['pickup'];
$drop = $_POST['drop'];
$cabtype = $_POST['cabtype'];
$lugg = $_POST['lugg'];
$far = $_POST['far'];
$f = $_POST['f'];
//$array = array("Charbagh"=>0,"Indira Nagar"=>10,"BBD"=>30,"Barabanki"=>60,"Faizabad"=>100,"Basti"=>150,"Gorakhpur"=>210);
$dist=0;
if($lugg =="")
{
    $lugg=0;
}
$adm = new adminwrk();
$admc = new dbcon();
$show = $adm->fetloc($admc->conn); 

$dist = $f;
date_default_timezone_set('asia/kolkata');
$datetime = date("Y-m-d h:i");
$id = $_SESSION['userdata']['user_id'];

    $save=$adm->book($pickup,$drop,$cabtype,$dist,$far,$lugg,$datetime,$id,$admc->conn);

?>