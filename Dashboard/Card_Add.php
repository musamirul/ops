<?php include("Interface/header.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-2 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-person-plus pt-2"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Add Card</span> <br/>
                    <span style="font-size: 14px; color: grey;">Create New Card</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5 ms-5 me-5">
            <div style="background-color: rgb(249, 250, 215); " class="col-4">
                <div class="row pt-3 mb-2">
                    <div class="col">
                        <div class="ms-3">
                            <center><span style="font-size: 23px;font-weight: bold;">Card</span></center>
                        </div>
                    </div>
                </div>
                <form method="post">
                <div class="col mb-3">
                    <div class="row-sm-4">
                        <label class="form-label">Card Serial Number</label>
                        <input class="form-control " name="card_serialnum" placeholder="Serial Number">
                    </div>
                    <div class="row-sm-4">
                        <label class="form-label">Card Date Register</label>
                        <input class="form-control " type="date" name="card_dateregister">
                    </div>
                    <div class="row">
                        <div class="col">
                            <input class="form-check-input" name="isActive" type="checkbox" value="yes" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                isActive
                            </label>
                        </div>
                        <div class="col">
                            <input class="form-check-input" name="isInUse" type="checkbox" value="yes">
                            <label class="form-check-label" for="flexCheckChecked">
                                isInUse
                            </label>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <button type="submit" name="addCard" class="btn btn-primary btn-sm mt-2">Save</button>
                    </div>
                </div>
                </form>
            </div>
            <div style="background-color: rgb(219, 250, 215); " class="col ms-5">
                <div class="row mb-3">
                    <div class="overflow-auto p-3" style="max-width: auto; max-height: 600px;">
                        <ol class="list-group list-group-numbered">
                            <?php
                                $query_card = mysqli_query($con,"SELECT * FROM card ORDER BY card_id DESC ");
                                while($result_card = mysqli_fetch_array($query_card)){
                                    $isuse = $result_card['card_isuse'];
                                    $isactive = $result_card['card_isactive'];
                                    $card_id = $result_card['card_id'];
                                
    
                            ?>
                            <li class="list-group-item d-flex align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">
                                        <?php echo $result_card['card_serialnum']; ?> 
                                        [<?php  echo $result_card['card_dateregister']; ?>]
                                                                                
                                            <span class="badge <?php if($isactive=='yes'){echo 'bg-success';}else{echo 'bg-danger';} ?>"><?php if($isactive=='yes'){echo 'ACTIVE';}else{echo 'INACTIVE';} ?></span>
                                            <span class="badge <?php if($isuse=='no'){echo 'bg-success';}else{echo 'bg-danger';} ?>"><?php if($isuse=='no'){echo 'UNUSED';}else{echo 'USED';} ?></span>
                                    </div>      
                                </div>
                                <div class="p-2">
                                    <button type="submit"  class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCar<?php echo $staff_id ?>">Add Car</button>
                                    <button type="submit"  class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $staff_id ?>">Edit Profile</button>
                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $card_id ?>">Delete</button>
                                </div>

                                <!-- View -->
                                <div class="modal fade" id="viewCar<?php echo $staff_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Add Car to : <strong><?php echo $staff_name?></strong> ?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                                <div class="d-flex flex-column mb-3">
                                                    <?php
                                                        $query_showCar = mysqli_query($con,"SELECT * FROM car_record WHERE fk_staff_id = '$staff_id' ");
                                                        while($result_showCar = mysqli_fetch_array($query_showCar)){
                                                        $car_brand = $result_showCar['car_brand'];
                                                        $car_model = $result_showCar['car_model'];
                                                        $car_color = $result_showCar['car_color'];
                                                        $car_platenum = $result_showCar['car_platenum'];
                                                        
                                                    ?>
                                                    <div class="p-2">
                                                        <div class="fw-bold">
                                                            <?php echo $car_brand; ?> 
                                                            [<?php  echo $car_model; ?>]
                                                        </div>
                                                        <div class="fw-light">
                                                            <?php echo $car_platenum ?>&nbsp;
                                                            <?php echo $car_color; ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div> 
                                            <div class="modal-footer">
                                                    <input type="hidden" value="<?php echo $staff_id;?>" name="idAddCarHidden" />
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="addCar" class="btn btn-primary">Save</button>
                                            </div>   
                                        </div>
                                    </div>
                                </div>

                                <!-- Add Car Modal -->
                                <div class="modal fade" id="addCar<?php echo $staff_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Add Car to : <strong><?php echo $staff_name?></strong> ?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <form method="post">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Car Brand</label>
                                                        <input class="form-control" placeholder="Enter Car Brand" name="car_brand" required autofocus="autofocus" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Car Model</label>
                                                        <input class="form-control" placeholder="Enter Model" name="car_model" required autofocus="autofocus" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Plate Number</label>
                                                        <input class="form-control" placeholder="Plate Number" name="car_platenum"  required autofocus="autofocus" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Car Color</label>
                                                        <input class="form-control" placeholder="Car Color" name="car_color" required autofocus="autofocus" />
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="modal-footer">
                                                    <input type="hidden" value="<?php echo $staff_id;?>" name="idAddCarHidden" />
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="addCar" class="btn btn-primary">Save</button>
                                            </form>
                                            </div>   
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="delete<?php echo $card_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete <?php echo $result_card['card_serialnum'];?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                                Are you want to delete? <strong><?php echo $result_card['card_serialnum']; ?></strong>      
                                            </div> 
                                            <div class="modal-footer">
                                            <form method="post">
                                                <input type="hidden" value="<?php echo $card_id; ?>" name="card_id" />
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="deleteCard" class="btn btn-danger">DELETE</button>
                                            </form>
                                            </div>   
                                        </div>
                                    </div>
                                </div>


                                 <!-- Edit Modal -->
                                    <div class="modal fade" id="edit<?php echo $staff_id?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit <strong><?php echo $staff_name?></strong> ?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                                <form method="post">
                                                <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Name</label>
                                                        <input class="form-control" placeholder="Enter Name" name="nameEdit" value="<?php echo $staff_name; ?>" required autofocus="autofocus" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Staff ID</label>
                                                        <input class="form-control" placeholder="Enter Designation" name="idEdit" value="<?php echo $result_deptStaff['user_staffid']; ?>" required autofocus="autofocus" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label class="form-label">Employee Type</label>
                                                    <select name="typeEdit" class="form-select ">
                                                            <?php
                                                                $query_empShow = mysqli_query($con,"SELECT * FROM employee_type ORDER BY emptype_id");
                                                                while($result_empShow = mysqli_fetch_array($query_empShow)){
                                                            ?>
                                                            <option value="<?php echo $result_empShow['emptype_id']; ?>"<?php if($result_empShow['emptype_id']==$staff_type){echo 'selected';} ?>><?php echo $result_empShow['emptype_name']; ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label class="form-label">Services </label>
                                                    <select name="servicesEdit" class="form-select ">
                                                        <?php
                                                            $query_deptShow = mysqli_query($con,"SELECT * FROM services ORDER BY services_name");
                                                            while($result_deptShow = mysqli_fetch_array($query_deptShow)){
                                                        ?>
                                                        <option value="<?php echo $result_deptShow['services_id']; ?>" <?php if($result_deptShow['services_id']==$fk_services_id){echo 'selected';} ?>><?php echo $result_deptShow['services_name']; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="form-label">Position</label>
                                                        <input class="form-control " name="positionEdit" value="<?php echo $result_deptStaff['user_position']; ?>"  placeholder="Position">
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label">Phone</label>
                                                        <input class="form-control" placeholder="phoneEdit" name="phoneEdit" value="<?php echo $result_deptStaff['user_phone']; ?>" required autofocus="autofocus" />
                                                    </div> 
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-3 pt-4">
                                                        <input class="form-check-input" name="isActiveEdit" type="checkbox" value="yes" <?php if($result_deptStaff['user_isactive']=='yes'){echo 'checked';} ?>>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            isActive
                                                        </label>
                                                    </div>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <input type="hidden" value="<?php echo $staff_id;?>" name="idEditHidden" />
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="editStaff" class="btn btn-primary">Save</button>
                                                </form>
                                                </div>   
                                            </div>
                                        </div>
                                    </div>

                            </li>
                            
                            <?php
                                }
                            ?>
                        </ol>
                    </div>
                    
                </div>
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
    if(isset($_POST['addCard'])){
        $card_serialnum = $_POST['card_serialnum'];
        $card_dateregister = $_POST['card_dateregister'];
        $isInUse = $_POST['isInUse'];
        $isActive = $_POST['isActive'];
        if($isActive==''){
            $isActive = 'no';
        }
        if($isInUse==''){
            $isInUse = 'no';
        }
        // date_default_timezone_set("Asia/Kuala_Lumpur");
        // $todayDate = date('d/m/Y');
        // $todayTime = date('h:i a');

        $query_addStaff = mysqli_query($con, "INSERT INTO card(card_serialnum, card_dateregister, card_isactive, card_isuse) 
        VALUES ('$card_serialnum','$card_dateregister','$isActive','$isInUse')");

        $_SESSION['message'] = 'Successfully update information';   
        echo '<script>window.location.href="Card_Add.php?msg=success"</script>';

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

    if(isset($_POST['deleteCard'])){
        $card_id = $_POST['card_id'];

        $query_deleteStaff = mysqli_query($con, "DELETE FROM card WHERE card_id = '$card_id'");
        $_SESSION['message'] = 'Successfully delete information';   
        echo '<script>window.location.href="Card_Add.php?msg=success"</script>';

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