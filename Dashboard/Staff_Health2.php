<?php include("Interface/header.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-2 bg-body rounded me-5">
        <div class="row p-3">
            <div class="col">   
            </div>
            <div class="col-6">
                <div class="row">
                    <form method="post">
                        <div class="input-group mt-1">
                            <input style="background-color: white;color: black;" class="form-control" type="text" name="nameSearch" placeholder="Search Staff Name">
                            <button class="btn btn-primary btn-sm" name="searchButton" type="submit"><i class="bi bi-search ps-3 pe-3 me-3"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col">
            </div>
            <?php
                $newUser_id = null;
                
                if(isset($_POST['searchButton'])){
                    $nameSearch = $_POST['nameSearch'];
                    
                    if($nameSearch!=''){
                    $searchQuery = mysqli_query($con,"SELECT * FROM user
                    WHERE user_fname LIKE '%$nameSearch%' OR user_staffid LIKE '%$nameSearch%'");
                    
                    $searchResult = mysqli_fetch_array($searchQuery);
                
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

                    $newUser_id = $user_id;
                
            }
        }
                  
               
              
            ?>
        </div>
        <div class="row" style="height:200px">
            <?php if($newUser_id != null){?>
            <div class="card">
                <h5 class="card-header"><?php echo $user_fname.' ['.$user_id.']'; ?></h5>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $services_name; ?> - <?php echo $user_position; ?></h5>
                    <p class="card-text">
                        <div class="d-flex flex-row bd-highlight mb-2">
                            <div class="bd-highlight"><span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">Phone </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"> <?php echo $user_phone; ?></span></div>
                            <div class="ps-2 bd-highlight">| <span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">Date Register </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"><?php echo $user_dateregister; ?></span></div>
                            <div class="ps-2 bd-highlight">| <span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">Employee Type </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"><?php echo $emptype_name; ?></span></div>
                        </div>
                    </p>
                    <button type="submit"  class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addHealth<?php echo $user_id ?>">Add Health Record</button>
                </div>
            </div>
            <?php } ?>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5 ms-5 me-5">
            <div style="background-color: rgb(249, 250, 215); " class="col">
                <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <th>Start Date</th>
                        <th>Period</th>
                        <th>Health Type</th>
                        <th>Card Num</th>
                        <th>Card IsReturn</th>
                        <th>Card DateReturn</th>
                        <th>Remark</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tbody>
                  </table>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="addHealth<?php echo $user_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Add Health Record to : <strong><?php echo $user_fname?></strong> ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <form method="post">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                    <label>Health Type</label>
                        <input class="form-control" placeholder="Enter Illness type" name="health_type" required autofocus="autofocus" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <label>Start Date</label>
                        <input class="form-control" type="date" name="health_startdate" required autofocus="autofocus" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <label>Period (month)</label>
                        <input class="form-control" type="number" name="health_period"  required autofocus="autofocus" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <label>Select Card</label>
                        <select name="card_id" class="form-select ">
                                <?php
                                    $query_empShow = mysqli_query($con,"SELECT * FROM card WHERE card_isactive='yes' ORDER BY card_id");
                                    while($result_empShow = mysqli_fetch_array($query_empShow)){
                                ?>
                                    <option value="<?php echo $result_empShow['card_id']; ?>">
                                        <?php echo $result_empShow['card_serialnum']; ?>
                                        <?php if($result_empShow['card_isuse']=='yes'){echo ' NOT AVAILABLE';}else{echo 'AVAILABLE';}?>
                                    </option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <label>Remark</label>
                        <input class="form-control" placeholder="Enter Remark" name="health_remark" required autofocus="autofocus" />
                    </div>
                </div>
            </div> 
            <div class="modal-footer">
                    <input type="hidden" value="<?php echo $user_id;?>" name="user_id" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="addHealth" class="btn btn-primary">Save</button>
            </form>
            </div>   
        </div>
    </div>
</div>





<?php
    if(isset($_POST['addHealth'])){
        $user_id = $_POST['user_id'];
        $health_type = $_POST['health_type'];
        $health_startdate = $_POST['health_startdate'];
        $health_period = $_POST['health_period'];
        $health_remark = $_POST['health_remark'];
        $card_id = $_POST['card_id'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y');
        // $todayTime = date('h:i a');

        $query_addHealth = mysqli_query($con, "INSERT INTO health_record(health_type, health_startdate, health_period, health_iscardreturn, health_datecardreturn, health_remark, health_recorddate, fk_card_id, fk_staff_id)
         VALUES ('$health_type','$health_startdate','$health_period','','','$health_remark','$todayDate','$card_id','$user_id')");

        $_SESSION['message'] = 'Successfully update information';
        $nameSearch=$user_id;  
        echo '<script>window.location.href="Staff_Health.php?msg=success"</script>';

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