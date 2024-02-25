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
                <span class="float-start mt-3 me-2" style="letter-spacing: 3px;"><span class="fw-semibold" style="color:#E8B820">Day:</span> <?php echo date('l')?></span>
                <span class="float-start mt-4 pe-2" style="letter-spacing: 3px; font-size: 10px"><span class="fw-semibold" style="color:#E8B820">Total Car: </span><span class="fst-italic">150</span></span>
                <span class="float-start mt-4" style="letter-spacing: 3px; font-size: 10px"><span class="fw-semibold" style="color:#E8B820">Total Staff: </span> <span class="fst-italic">155</span>
            </div>
            <div class="col-4">
                <center><span class="fs-5 fw-bold" style="letter-spacing: 3px;">Online Parking System</span></center>
            </div>
            <div class="col float-end">
                <span class="float-end mt-3" style="letter-spacing: 3px;"><span class="fw-semibold" style="color:#E8B820">Date:</span> <span id="clock"></span></span>
                
            </div>
        </div>
        <div class="row text-white pt-2 pb-2">
            <form method="post">
                <div class="input-group mt-1">
                <input style="background-color: white;color: black;" class="form-control" type="text" name="nameSearch" placeholder="Search Staff Name">
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
            <div class="card text-center mb-3">
                <div class="card-header">
                    <h5><?php echo $user_fname.' ['.$user_id.']'; ?><?php if($user_isactive=='no'){echo '- <span style="color:red">INACTIVE</span>'.' ';} ?></h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                    <?php
                            $query_countreq = mysqli_query($con,"SELECT * FROM car_record WHERE fk_staff_id = '$user_id'");
                            while($result_countreq = mysqli_fetch_array($query_countreq)){
                        ?>
                            <div class="card bg-primary mb-2 me-2" style="max-width: 18rem;">
                                <div class="card-header text-white"><b><?php echo $result_countreq['car_platenum'] ?></b></div>
                                <div class="card-body">
                                    <p class="card-title text-white"><?php echo $result_countreq['car_brand'].' '.$result_countreq['car_model'].' ['.$result_countreq['car_color'].']'; ?></p>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="card-text">
                        <div class="d-flex justify-content-center">
                            <div class="bd-highlight"><span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">Phone : </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"> <?php echo $user_phone; ?></span></div>
                            <div class="ps-2 bd-highlight">| <span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">Date Register : </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"><?php echo $user_dateregister; ?></span></div>
                            <div class="ps-2 bd-highlight">| <span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">Employee Type : </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"><?php echo $emptype_name; ?></span></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-body-secondary">
                    Date Register : <?php echo $user_dateregister; ?>
                </div>
            </div>
            <?php
                        }
                }
            }
            ?>
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