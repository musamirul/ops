<?php include("Interface/header.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-2 bg-body rounded me-5">
        <div class="row p-3">
            <div class="row">
                <form method="post">
                    <div class="input-group mt-1">
                        <input style="background-color: white;color: black;" class="form-control" type="text" name="nameSearch" placeholder="Search Staff Name">
                        <button class="btn btn-primary btn-sm" name="searchButton" type="submit"><i class="bi bi-search ps-3 pe-3 me-3"></i></button>
                    </div>
                </form>
            </div>
        <?php
            if(isset($_POST['searchButton'])){
                $nameSearch = $_POST['nameSearch'];
                
                if($nameSearch!=''){
                $searchQuery = mysqli_query($con,"SELECT * FROM user
                WHERE user_fname LIKE '%$nameSearch%' OR user_staffid LIKE '%$nameSearch%'");
                
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

                        
                        $query_countreq = mysqli_query($con,"SELECT count(*) FROM car_record WHERE fk_staff_id = '$user_id'");
                        $result_countreq = mysqli_fetch_array($query_countreq);
                        $reqcount = $result_countreq[0];
                    }
                }
            }
                    
            
        ?>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5 ms-5 me-5">
            <div style="background-color: rgb(249, 250, 215); " class="col">
                t
            </div>
        </div>
        
    </div>
</div>

<!-- View Speciality -->
<div class="modal fade" id="SpecialityModal" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Add New Services </strong></h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="POST">
            <div class="row mb-3 mt-4">   
                <label class="col-sm-2 col-form-label">Services</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="services_name" required/>
                </div>
            </div>
        <div class="modal-footer">
            <button class="btn btn-primary" name="saveServices" type="submit">Save</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </form>   
    </div>
    </div>
</div>
<!-- End Speciality -->




<?php
    if(isset($_POST['addStaff'])){
        $Staff_Name = $_POST['Staff_Name'];
        $Staff_Id = $_POST['Staff_Id'];
        $Staff_Type = $_POST['Staff_Type'];
        $fk_services = $_POST['fk_services'];
        $Staff_Position = $_POST['Staff_Position'];
        $Staff_Phone = $_POST['Staff_Phone'];
        $Staff_Register = $_POST['Staff_Register'];
        $isActive = $_POST['isActive'];
        if($isActive==''){
            $isActive = 'no';
        }
        // date_default_timezone_set("Asia/Kuala_Lumpur");
        // $todayDate = date('d/m/Y');
        // $todayTime = date('h:i a');

        $query_addStaff = mysqli_query($con, "INSERT INTO user(user_fname, user_staffid, user_phone, user_position,user_type, user_dateregister, user_isactive, fk_services_id) 
        VALUES ('$Staff_Name','$Staff_Id','$Staff_Phone','$Staff_Position','$Staff_Type','$Staff_Register','$isActive','$fk_services')");

        $_SESSION['message'] = 'Successfully update information';   
        echo '<script>window.location.href="Staff_Add.php?msg=success"</script>';

    }

    if(isset($_POST['saveServices'])){
        $services_name = $_POST['services_name'];
        $check_name = mysqli_query($con,"SELECT * FROM services WHERE services_name = '$services_name'");
        $result_name = mysqli_fetch_array($check_name);
        if($result_name>0){
            $_SESSION['message'] = 'Duplicated Services, Please add other services';   
        }else{
            //If username not exist insert into 'login' db
            $query_update = mysqli_query($con,"INSERT INTO services(services_name) VALUES ('$services_name')");
            $_SESSION['message'] = 'Successfully update information';   
            echo '<script>window.location.href="Staff_Add.php?msg=success"</script>';
            //$_SESSION['message'] = 'Successfully update information';   
            //echo '<script>window.location.href="User_Add.php?msg=success"</script>';   
        }

    }

    if(isset($_POST['deleteStaff'])){
        $idDelete = $_POST['idDelete'];

        $query_deleteStaff = mysqli_query($con, "DELETE FROM user WHERE user_id = '$idDelete'");
        $_SESSION['message'] = 'Successfully delete information';   
        echo '<script>window.location.href="Staff_Add.php?msg=success"</script>';

    }

    //edit staff
    if(isset($_POST['editStaff'])){
        $idEditHidden = $_POST['idEditHidden'];

        $nameEdit = $_POST['nameEdit'];
        $idEdit = $_POST['idEdit'];
        $typeEdit = $_POST['typeEdit'];
        $servicesEdit = $_POST['servicesEdit'];
        $positionEdit = $_POST['positionEdit'];
        $phoneEdit = $_POST['phoneEdit'];
        $isActiveEdit = $_POST['isActiveEdit'];


        // $query_update = mysqli_query($con,"UPDATE staff SET Staff_FName='$nameEdit',Staff_Designation='$designationEdit',Staff_Ext='$extEdit',Staff_SpeedDial='$dialEdit',
        // Staff_Email='$emailEdit' WHERE Staff_ID='$idEdit'");

        $query_update = mysqli_query($con,"UPDATE user SET user_fname='$nameEdit',user_staffid='$idEdit',user_phone='$phoneEdit',user_position='$positionEdit',
        user_type='$typeEdit',user_isactive='$isActiveEdit',fk_services_id='$servicesEdit' WHERE user_id='$idEditHidden'");

        $_SESSION['message'] = 'Successfully update information';   
        echo '<script>window.location.href="Staff_Add.php?msg=success"</script>';

    }

    //add Car
    if(isset($_POST['addCar'])){
        $idAddCarHidden = $_POST['idAddCarHidden'];
        $car_brand = $_POST['car_brand'];
        $car_model = $_POST['car_model'];
        $car_platenum = $_POST['car_platenum'];
        $car_color = $_POST['car_color'];

        $check_name = mysqli_query($con,"SELECT * FROM car_record WHERE car_platenum= '$car_platenum'");
        $result_name = mysqli_fetch_array($check_name);
        if($result_name>0){
            $_SESSION['message'] = 'Duplicated Car, Please add other car';   
        }else{
            //If username not exist insert into 'login' db
            $query_update = mysqli_query($con,"INSERT INTO car_record(car_platenum, car_model, car_brand, car_color, fk_staff_id) 
            VALUES ('$car_platenum','$car_model','$car_brand','$car_color','$idAddCarHidden')");
            $_SESSION['message'] = 'Successfully update information';   
            echo '<script>window.location.href="Staff_Add.php?msg=success"</script>';
            //$_SESSION['message'] = 'Successfully update information';   
            //echo '<script>window.location.href="User_Add.php?msg=success"</script>';   
        }

    }
?>
<?php include("Interface/footer.php"); ?>