<?php
  session_start();
  include("includes/config.php");
  //Get Current File Name for Navbar active button
  $current_file_name = basename($_SERVER['PHP_SELF']); 
  date_default_timezone_set("Asia/Kuala_Lumpur");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Interface/style/bootstrap/css/bootstrap.min.css" media="screen">
    <link href="Interface/style/chosen/chosen.css" rel="stylesheet">
    <link href="Interface/style/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="Interface/style/css/style1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="Interface/style/DataTables/css/jquery.dataTables.css">
    <link href="Interface/style/summernote/summernote-lite.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  </head>
  <body id="contentContainer" class="container bg-dark" >
	<div class="col">
    <div class="row text-white pt-2 pb-2">
        <div class="col float-start">
        <?php
          $query_countcar = mysqli_query($con,"SELECT count(*) FROM car_record");
          $result_countcar = mysqli_fetch_array($query_countcar);
          $carcount = $result_countcar[0];
        ?>
        <?php
          $query_countuser = mysqli_query($con,"SELECT count(*) FROM user WHERE user_isactive='yes'");
          $result_countuser = mysqli_fetch_array($query_countuser);
          $usercount = $result_countuser[0];
        ?>
            <span class="float-start mt-3 me-2" style="letter-spacing: 3px;"><span class="fw-bold" style="color:#E8B820">Day:</span> <?php echo date('l')?></span>
            <span class="float-start mt-4 pe-2" style="letter-spacing: 3px; font-size: 10px"><span class="fw-semibold" style="color:#E8B820">Total Car: </span><span class="fst-italic"><?php echo $carcount; ?></span></span>
            <span class="float-start mt-4" style="letter-spacing: 3px; font-size: 10px"><span class="fw-semibold" style="color:#E8B820">Total User: </span> <span class="fst-italic"><?php echo $usercount; ?></span>
        </div>
        <div class="col-4">
            <center><span class="fs-5 fw-bold" style="letter-spacing: 3px;">Online Parking System</span></center>
        </div>
        <div class="col float-end">
            <span class="float-end mt-3" style="letter-spacing: 3px;"><span class="fw-bold" style="color:#E8B820">Date:</span> <span id="clock"></span></span>
            
        </div>
    </div>
    <div class="row text-white pt-2 pb-2">
        <form method="post">
            <div class="input-group mt-1">
            <input style="background-color: white;color: black;" class="form-control" type="text" name="nameSearch" placeholder="Search Staff Name / Plate Number">
            <button class="btn btn-primary btn-sm" name="searchButton" type="submit"><i class="bi bi-search ps-3 pe-3 me-3"></i></button>
            </div>
        </form>
    </div>
    <div class="row">
        <?php
                $newUser_id = null;
                
                if(isset($_POST['searchButton'])){
                    $nameSearch = $_POST['nameSearch'];
                    
                    if($nameSearch!=''){

                      if (preg_match('~[0-9]+~', $nameSearch)) {
                        $searchPlate = mysqli_query($con,"SELECT * FROM car_record WHERE car_platenum LIKE '%$nameSearch%'");
                        $queryPlate = mysqli_fetch_array($searchPlate);
                        $Plate_num = $queryPlate['car_platenum'];
                        $Plate_staffId= $queryPlate['fk_staff_id'];
                        

                        $searchQuery = mysqli_query($con,"SELECT * FROM user
                        WHERE user_id ='$Plate_staffId'");
                        $resultQuery = mysqli_fetch_array($searchQuery);
                        $nameSearch = $resultQuery['user_fname'];
                      }
                    


                    $searchQuery = mysqli_query($con,"SELECT * FROM user
                    WHERE user_fname LIKE '%$nameSearch%' OR user_staffid LIKE '%$nameSearch%'");
                    
                    while($searchResult = mysqli_fetch_array($searchQuery)){
                
                    $user_id = $searchResult['user_id'];
                    $user_fname = $searchResult['user_fname'];
                    $user_staffid =$searchResult['user_staffid'];
                    $user_phone = $searchResult['user_phone'];
                    $user_position = $searchResult['user_position'];
                    $user_dateregister = $searchResult['user_dateregister'];
                    $user_isactive = $searchResult['user_isactive'];
                    $user_type = $searchResult['user_type'];
                    $fk_services_id = $searchResult['fk_services_id'];

                    $query_department = mysqli_query($con,"SELECT * FROM services WHERE services_id = '$fk_services_id'");
                    $result_department = mysqli_fetch_array($query_department);
                    $services_name = $result_department['services_name'];

                    $query_emptype = mysqli_query($con,"SELECT * FROM employee_type WHERE emptype_id = '$user_type'");
                    $result_emptype = mysqli_fetch_array($query_emptype);
                    $emptype_name = $result_emptype['emptype_name'];                    
            
        ?>
        <div class="shadow-lg bg-light rounded mb-3 pt-2">
          <div class="d-flex flex-row">
            <div class="p-2">
              <span style="font-size: 25px; font-weight: 600;"><?php echo $user_fname.' ['.$user_staffid.']'; ?><?php if($user_isactive=='no'){echo '- <span style="color:red">INACTIVE</span>'.' ';} ?></span><br/>
              <span style="font-size: 15px; font-weight: 400;"><?php echo $services_name; ?> (<?php echo $user_position; ?>)</span><br/>
              <div class="d-flex flex-row bd-highlight mb-3">
                    <div class="bd-highlight"><span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">Phone : </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"> <?php echo $user_phone; ?></span></div>
                    <div class="ps-2 bd-highlight">| <span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">Date Register : </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"><?php echo $user_dateregister; ?></span></div>
                    <div class="ps-2 bd-highlight">| <span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">Employee Type : </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"><?php echo $emptype_name; ?></span></div>
                </div>
            </div>
            <div class="p-2">
              <div class="d-flex flex-row">
                  <?php
                      $query_countreq = mysqli_query($con,"SELECT * FROM car_record WHERE fk_staff_id = '$user_id'");
                      while($result_countreq = mysqli_fetch_array($query_countreq)){
                  ?>
                      <div class="card bg-primary me-2" style="max-width: 18rem;">
                          <div class="card-header text-white"><b><?php echo $result_countreq['car_platenum'] ?></b></div>
                          <div class="card-body">
                              <p class="card-title text-white"><?php echo $result_countreq['car_brand'].' '.$result_countreq['car_model'].' ['.$result_countreq['car_color'].']'; ?></p>
                          </div>
                      </div>
                  <?php
                      }
                  ?>
              </div>
            </div>
          </div>
        </div>
        <?php
                    }
            }
        }
        ?>
    </div>
    <div class="row">
      <div class="btn-group">
        <?php
          $query_countreq = mysqli_query($con,"SELECT count(*) FROM user WHERE user_type = '2' AND user_isactive='yes'");
          $result_countreq = mysqli_fetch_array($query_countreq);
          $reqcount = $result_countreq[0];
        ?>
        <?php
          $query_countreqc = mysqli_query($con,"SELECT count(*) FROM user WHERE user_type = '3' AND user_isactive='yes'");
          $result_countreqc = mysqli_fetch_array($query_countreqc);
          $reqcountc = $result_countreqc[0];
        ?>
        <?php
          $query_countreqm = mysqli_query($con,"SELECT count(*) FROM user WHERE user_type = '4' AND user_isactive='yes'");
          $result_countreqm = mysqli_fetch_array($query_countreqm);
          $reqcountm = $result_countreqm[0];
        ?>
        <?php
          $query_countreqv = mysqli_query($con,"SELECT count(*) FROM user WHERE user_type = '5' AND user_isactive='yes'");
          $result_countreqv = mysqli_fetch_array($query_countreqv);
          $reqcountv = $result_countreqv[0];
        ?>
        <?php
          $query_countreqo = mysqli_query($con,"SELECT count(*) FROM user WHERE user_type = '5' AND user_isactive='yes'");
          $result_countreqo = mysqli_fetch_array($query_countreqo);
          $reqcounto = $result_countreqo[0];
        ?>
        
        <a href="opsviewer.php" class="btn btn-secondary">Staff Parking <span class="badge bg-dark rounded-pill"><?php echo $reqcount; ?></span></a>
        <a href="opsviewer_m.php" class="btn btn-secondary active" aria-current="page">Management Parking <span class="badge bg-dark rounded-pill"><?php echo $reqcountm; ?></span></a>
        <a href="opsviewer_c.php" class="btn btn-secondary">Consultant Parking <span class="badge bg-dark rounded-pill"><?php echo $reqcountc; ?></span></a>
        <a href="opsviewer_i.php" class="btn btn-secondary">Illness Parking <span class="badge bg-dark rounded-pill">2</span></a>
        <a href="opsviewer_v.php" class="btn btn-secondary">Visiting Parking <span class="badge bg-dark rounded-pill"><?php echo $reqcountv; ?></span></a>
        <a href="opsviewer_o.php" class="btn btn-secondary">Outsource Parking <span class="badge bg-dark rounded-pill"><?php echo $reqcounto; ?></span></a>
      </div>
    </div>
    <div class="row bg-white shadow rounded-bottom me-1 ms-1 p-2">
      <table class="table table-striped-columns shadow rounded" width="98%" style="border-collapse: collapse; font-size: 13px">
        <thead>
          <tr class="">
            <td class="bg-dark bg-gradient shadow-sm fw-bold" style="width:10px;color:#E8B820"><center>No.</center></td>
            <td class="bg-dark bg-gradient shadow-sm fw-bold" style="width:150px;color:#E8B820"><center>Name</center></td>
            <td class="bg-dark bg-gradient shadow-sm fw-bold" style="width:100px;color:#E8B820"><center>Staff ID</center></td>
            <td class="bg-dark bg-gradient shadow-sm fw-bold" style="width:100px;color:#E8B820"><center>Phone</center></td>
            <td class="bg-dark bg-gradient shadow-sm fw-bold" style="width:170px;color:#E8B820"><center>Services</center></td>
            <td class="bg-dark bg-gradient shadow-sm fw-bold" style="width:110px;color:#E8B820"><center>Position</center></td>
            <td class="bg-dark bg-gradient shadow-sm fw-bold" style="width:110px;color:#E8B820"><center>Date Register</center></td>
            <td class="bg-dark bg-gradient shadow-sm fw-bold" style="color:#E8B820"><center>Car</center></td>
        </tr>
        </thead>
        <tbody>
          <?php
            $searchQuery = mysqli_query($con,"SELECT * FROM user
            WHERE user_type='4'");
            $count = 0;
            while($searchResult = mysqli_fetch_array($searchQuery))
            {
              $user_id = $searchResult['user_id'];
              $user_fname = $searchResult['user_fname'];
              $user_staffid =$searchResult['user_staffid'];
              $user_phone = $searchResult['user_phone'];
              $user_position = $searchResult['user_position'];
              $user_dateregister = $searchResult['user_dateregister'];
              $user_type = $searchResult['user_type'];
              $fk_services_id = $searchResult['fk_services_id'];

              $query_department = mysqli_query($con,"SELECT * FROM services WHERE services_id = '$fk_services_id'");
              $result_department = mysqli_fetch_array($query_department);
              $services_name = $result_department['services_name'];

              $query_emptype = mysqli_query($con,"SELECT * FROM employee_type WHERE emptype_id = '$user_type'");
              $result_emptype = mysqli_fetch_array($query_emptype);
              $emptype_name = $result_emptype['emptype_name'];
              $count++;
          ?>
          <tr>
            <th scope="row"><?php echo $count; ?></th>
            <td><center><?php echo $user_fname; ?></center></td>
            <td><center><?php echo $user_staffid; ?></center></td>
            <td><center><?php echo $user_phone; ?></center></td>
            <td><center><?php echo $services_name; ?></center></td>
            <td><center><?php echo $user_position; ?></center></td>
            <td><center><?php echo $user_dateregister; ?></center></td>
            <td>
            <?php
                $query_showCar = mysqli_query($con,"SELECT * FROM car_record WHERE fk_staff_id = '$user_id' ");
                while($result_showCar = mysqli_fetch_array($query_showCar)){
                $car_brand = $result_showCar['car_brand'];
                $car_model = $result_showCar['car_model'];
                $car_color = $result_showCar['car_color'];
                $car_platenum = $result_showCar['car_platenum'];
                
            ?>
              <span style="font-size:12px" class="badge bg-dark rounded-pill"><?php echo $car_platenum.' ['.$car_brand.' '.$car_model.']'; ?></span>
            <?php
                }
            ?>
            </td>
          </tr>
            <?php
            }
            ?>
        </tbody>
      </table>
    </div>      
	</div>

<footer class="text-center text-white fixed-bottom bg-dark mt-5">
    <div class="text-center p-1" style="background-color:rgba(0,0,0,0.2);">
    @ 2022 Copyright :
    <a class="text-white text-decoration-none" href="#">IT Services KPJ Klang</a>
    </div>
</footer>

    <script src="Interface/style/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="Interface/style/jQuery/jquery-3.6.0.min.js"></script>
    <script src="Interface/style/chosen/chosen.jquery.js"></script>
    <script src="Interface/style/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="Interface/style/DataTables/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="Interface/style/summernote/summernote-lite.js"></script>
    <script>
      window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
      </script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>
    <script>
    $(document).ready(function() {
        $('#example1').DataTable();
    } );
    </script>
    <script>
    $('#summernote').summernote({
      placeholder: 'Enter Product Details',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
    $('#summernote_spec').summernote({
      placeholder: 'Enter Product Details',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
    $('#summernote_health').summernote({
      placeholder: 'Enter Article Text',
      tabsize: 2,
      height: 800,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });

    $('#summernote_doctor').summernote({
      placeholder: 'Enter Doctor Education',
      tabsize: 3,
      height: 70,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  </script>
  <script>
    var toastTrigger = document.getElementById('liveToastBtn')
var toastLiveExample = document.getElementById('liveToast')
if (toastTrigger) {
  toastTrigger.addEventListener('click', function () {
    var toast = new bootstrap.Toast(toastLiveExample)

    toast.show()
  })
}
    </script>
    <script>
      $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!"
      })
    </script>

<script>
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            var day = now.getDate();
            var month = now.getMonth(); // Months are zero-based
            var year = now.getFullYear();

            var monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            var period = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12; // Convert to 12-hour format

            // Add leading zero if needed
            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            day = day < 10 ? "0" + day : day;

            var clockElement = document.getElementById("clock");
            clockElement.textContent = monthNames[month] + " " + day + ", "+year+" "+ hours + ":" + minutes + ":" + seconds + " " + period;
        }

        // Update the clock every second (1000 milliseconds)
        setInterval(updateClock, 1000);

        // Initial update
        updateClock();
    </script>



  </body>
</html>