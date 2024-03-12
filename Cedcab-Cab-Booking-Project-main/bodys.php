<?php 
if(isset($_SESSION['book'])){
 $p = $_SESSION['book']['pickup'];
 $d = $_SESSION['book']['drop'];
 $c = $_SESSION['book']['cabtype'];
 $l = $_SESSION['book']['lugg'];
 $f = $_SESSION['book']['f'];
}
?>

<head>
    <script src="maps.js"></script>
    <script type="text/javascript" src="https://www.bing.com/api/maps/mapcontrol?callback=getMaps&key=Ak9O0_uk29mapIHmjtgj4MH_4dna5EQKlKAKoZtetwsEc7TxvUAJCPhEYmxwJ5CO"></script>
<style>

.overlay {
    position: absolute;
    top: 270px;
    right: 100px;
    width: 50%; /* Adjust as needed */
    height: 50%; /* Adjust as needed */
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
    z-index: 999; /* Adjust the z-index to make sure it's above other content */
}


  </style>
</head>

<body>
<div id="bg" class="pt-2 pb-2">
    <h1 class="text-center mt-lg-5 pt-lg-5 mt-sm-0 pt-sm-0 font-weight-bold">Book a City Taxi to your destination in town</h1>
    <h5 class="text-center ">Choose from a range of categories and prices</h5>
    <section class="container-fluid box col-lg-4 col-sm-10 col-xs-12 col-md-7 ml-lg-5 ml-md-5 pt-lg-4 mt-lg-4 pt-sm-0 mt-sm-0 mb-5 pb-3 pt-2">
      <div class="text-center">
        <div class="tup1">
          <button class="btn btn-primary green btn-sm tup font-weight-bold">CITY TAXI</button><hr>
        </div>
        <h4 class="font-weight-bold">Your everyday travel partner</h4>
        <h6>AC cabs for point to point travel</h6>
      </div>
        <form action="body.php" method="post">
        <div class="form-group  row feilds ">
                <label class="col-sm-3"  for="pickup">PICKUP</label>
                <input type="text" name="pickup" class="form-control-plaintext col-sm-9 arro choose" id="pickup" placeholder="Enter pickup location">
            </div>
            <p id="ep" class="bg-danger text-center">Enter pickup point</p>
            <div class="form-group  row feilds ">
              <label class="col-sm-3"  for="drop">DROP</label>
              <input type="text" name="drop" class="form-control-plaintext col-sm-9 arro choose" id="drop" placeholder="Enter drop off location">
           </div>

          <p id="ed" class="bg-danger text-center">Enter Droping point</p>
          <div class="form-group  row feilds ">
            <label class="col-sm-3"  for="cabtype">CAB TYPE</label>
            <select  class="form-control-plaintext col-sm-9 arro" id="cabtype">
              <option value=""  selected disabled hidden>Drop down to select CAB type</option>
              <option <?php if(isset($id)){ echo "value= ".$c; } ?> hidden><?php if(isset($c)){ echo $c; } ?></option>
              <option value="CedMicro" <?php if(isset($c)){ if($c== 'CedMicro') { ?>selected<?php } }?>>CedMicro</option>
              <option value="CedMini" <?php if(isset($c)){ if($c== 'CedMini') { ?>selected<?php } }?>>CedMini</option>
              <option value="CedRoyal" <?php if(isset($c)){ if($c== 'CedRoyal') { ?>selected<?php } }?>>CedRoyal</option>
              <option value="CedSUV" <?php if(isset($c)){ if($c== 'CedSUV') { ?>selected<?php } }?>>CedSUV</option>
            </select>
        </div>
        <p id="ec" class="bg-danger text-center">Enter Cabtype</p>
        <div class="form-group  row feilds ">
          <label class="col-sm-3" for="luggage">LUGGAGE</label>
          <input type="text"  class="form-control-plaintext col-sm-9 arrow" maxlength="2" id="lugg" placeholder="Enter weight in KG" <?php if(isset($l)){ echo "value= ".$l; } ?> >
          <p id="err" class="text-danger h6">*Luggage is not available in CedMicro</p>
        </div>

        <p id="nu" class="bg-danger text-center">Enter Numeric Weight Value</p>

        <div class="form-group  row feilds " id="f">
        <label class="col-sm-3" for="fare">FARE</label>
        <input  id="far" name="fare" value="" class="form-control-plaintext col-sm-9 arrow" >
        </div>

        <div class="form-group  row feilds " style="display: none;">
              <input type="text" name="f" class="form-control-plaintext col-sm-9 arro choose" id="f" <?php if(isset($f)){ echo "value= ".$f; } ?>>
        </div>
      
            <div class="form-group ">
                <input type="button" class="btn green btn-primary btn-lg btn-block" id="button4" name="submit" value="Calculate Fare">
            </div>
            <div class="form-group ">
            <a  class="btn btn-success btn-lg btn-block disabled" id="rbook" name="rbook" >Ride Booked Successfully</a>
                <input type="submit" class="btn green btn-primary btn-lg btn-block" id="book" name="book" value="Book Now">
            </div>
        </form>
    </div>
    </section>
  </div>
  <?php if(isset($_SESSION['book']))
  {
    unset($_SESSION['book']);
    } ?>

<div class="overlay">
        <div class="map" id="dropoff-map"></div>
</div>