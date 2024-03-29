<?php
include('adhead.php');
if(!isset($_SESSION['userdata']))
{
    header('Location: index.php');
}
if($_SESSION['userdata']['is_admin']==1){
include('adsidebar.php'); ?>

  <h3 class="text-center">Welcome <?php echo $_SESSION['userdata']['username']; ?></h3>

    <div class="row pl-lg-5">

      <div class="col-sm-6 col-lg-3">
        <div class="card bg-success text-center">
          <div class="card-body">
            <h5 class="card-title ">All Rides</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
              $adm = new adminwrk();
            $admc = new dbcon();
            $cn = $adm->countride($admc->conn);
            print_r($cn); ?></p>
            <a href="allrides.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-warning text-center">
          <div class="card-body">
            <h5 class="card-title">Pending Rides</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->pcountride($admc->conn);
            print_r($cn); ?></p>           
             <a  href="apenride.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-info text-center">
          <div class="card-body">
            <h5 class="card-title">Completed Rides</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->cocountride($admc->conn);
            print_r($cn); ?></p>   
            <a href="acomride.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>
  
    </div>

    <div class="row pt-4 pl-lg-5">
    
  
    
    <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-success text-center">
          <div class="card-body">
            <h5 class="card-title">Cancelled Rides</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->cacountride($admc->conn);
            print_r($cn); ?></p>
             <a href="acanride.php" href="allrides.php#penr" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      

      <div class="col-sm-6 col-lg-3 ">
    <div class="card bg-warning text-center">
        <div class="card-body">
            <h5 class="card-title">Total Earning</h5>
            <p class="card-text font-weight-bold text-dark h1">
                <?php 
                // Retrieve the sum of total_fare from the ride table
                $sql = "SELECT SUM(total_fare) AS total_earning FROM ride";
                $result = $admc->conn->query($sql);
                $row = $result->fetch_assoc();
                $totalEarnings = $row['total_earning'];
                
                // Format the total earnings with comma separators and "RS." prefix
                $formattedEarnings = 'RS. ' . number_format($totalEarnings)."/-";
                
                echo $formattedEarnings; // Display the formatted total earnings
                ?>
            </p>
            <a href="allusers.php" class="btn btn-primary green">Go To</a>
        </div>
    </div>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="card bg-info text-center">
        <div class="card-body">
            <h5 class="card-title">Total Distance Traveled</h5>
            <p class="card-text font-weight-bold text-dark h1">
                <?php 
                // Retrieve the sum of total_distance from the ride table
                $sql = "SELECT SUM(total_distance) AS total_distance FROM ride";
                $result = $admc->conn->query($sql);
                $row = $result->fetch_assoc();
                $totalDistance = $row['total_distance'];
                
                // Format the total distance in kilometers with "KM" suffix
                $formattedDistance = number_format($totalDistance) . ' KM';
                
                echo $formattedDistance; // Display the formatted total distance
                ?>
            </p>
            <a href="allrides.php" class="btn btn-primary green">Go To</a>
        </div>
    </div>
</div>




    
    </div>

    <div class="row pt-4 pl-lg-5">
    
    <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-success text-center">
          <div class="card-body">
            <h5 class="card-title">Approved Users</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $au = $adm->acountuser($admc->conn);
            print_r($au); ?></p>
             <a href="aprovedusr.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-warning text-center">
          <div class="card-body">
            <h5 class="card-title">Pending Users</h5>
            <p class="card-text font-weight-bold text-dark h1">
            <?php 
            $pu = $adm->pcountuser($admc->conn);
             echo $pu; ?></p>
            <a href="aprove.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-info text-center">
          <div class="card-body">
            <h5 class="card-title">Total Users</h5>
            <p class="card-text font-weight-bold text-dark h1">
            <?php 
            $us = $adm->countuser($admc->conn);
             echo $us; ?></p>
            <a href="allusers.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      

   
    
    </div>

 <?php 
 
}
else{
    echo '<h1 class="text-center text-weight-bold text-dark">You Are not Authorised</h1>';
  }
 include('adfoot.php'); ?>