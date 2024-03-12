<?php
include('adminwrk.php');

if(isset($_POST['pickup']) && isset($_POST['drop']) && isset($_POST['cabtype']) && isset($_POST['lugg']) && isset($_POST['f'])) {
    $pickup = $_POST['pickup'];
    $drop = $_POST['drop'];
    $cabtype = $_POST['cabtype'];
    $lugg = $_POST['lugg'];
    $f = $_POST['f'];

    //$adm = new adminwrk(); // Not necessary if you're not using any methods from adminwrk class here

    // Calculate fare based on the provided distance $f
    $dist = $f;
    $fare = 0;
    $tdist = $dist;

if($cabtype =='CedMicro'){
    if($dist<=10){
        $fare=50+(13.50*$dist);
    }
    elseif ($dist<=60) { 
        $tdist= $tdist-10;
        $fare=185+(12*$tdist);
    }
    elseif ($dist<=160) {
        $tdist= $tdist-60;
        $fare=785+(10.20*$tdist);
    }
    elseif ($dist>160) {
        $tdist= $tdist-160;
        $fare=1805+(8.50*$tdist);
    }
}
if($cabtype =='CedMini'){
    if($dist<=10){
        $fare=150+(14.50*$dist);
    }
    elseif ($dist<=60) {
        $tdist= $tdist-10;
        $fare=295+(13*$tdist);
    }
    elseif ($dist<=160) {
        $tdist= $tdist-60;
        $fare=945+(11.20*$tdist);
    }
    elseif ($dist>160) {
        $tdist= $tdist-160;
        $fare=2065+(9.50*$tdist);
    }
}
if($cabtype =='CedRoyal'){
    if($dist<=10){
        $fare=200+(15.50*$dist);
    }
    elseif ($dist<=60) {
        $tdist= $tdist-10;
        $fare=355+(14*$tdist);
    }
    elseif ($dist<=160) {
        $tdist= $tdist-60;
        $fare=1055+(12.20*$tdist);
    }
    elseif ($dist>160) {
        $tdist= $tdist-160;
        $fare=2275+(10.50*$tdist);
    }
}
if($cabtype =='CedSUV'){
    if($dist<=10){
        $fare=250+(16.50*$dist);
    }
    elseif ($dist<=60) {
        $tdist= $tdist-10;
        $fare=415+(15*$tdist);
    }
    elseif ($dist<=160) {
        $tdist= $tdist-60;
        $fare=1165+(13.20*$tdist);
    }
    elseif ($dist>160) {
        $tdist= $tdist-160;
        $fare=2485+(11.50*$tdist);
    }
}
if($lugg>0){
    if($cabtype=='CedSUV'){
        if($lugg<=10){
            $fare= $fare+100;
        }
        elseif ($lugg>10 && $lugg<=20) {
            $fare=$fare+200;
        }
        elseif($lugg>20){
            $fare=$fare+400;
        }
    }
    else{
        if($lugg<=10){
            $fare= $fare+50;
        }
        elseif ($lugg>10 && $lugg<=20) {
            $fare=$fare+100;
        }
        elseif($lugg>20){
            $fare=$fare+200;
        }
}
}

$result=array(
    'fare'=>$fare
);
  echo json_encode($result) ;
}
