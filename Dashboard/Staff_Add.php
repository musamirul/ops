<?php include("Interface/header.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-2 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-person-plus pt-2"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Add Staff's Profile</span> <br/>
                    <span style="font-size: 14px; color: grey;">Create New Staff Profile</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5 ms-5 me-5">
            <div style="background-color: rgb(249, 250, 215); " class="col-4">
                <div class="row pt-3 mb-2">
                    <div class="col">
                        <div class="ms-3">
                            <center><span style="font-size: 23px;font-weight: bold;">Staff's Profile</span></center>
                        </div>
                    </div>
                </div>
                <form method="post">
                <div class="col mb-3">
                    <div class="row-sm-4">
                        <label class="form-label">Staff Name</label>
                        <input class="form-control " name="Staff_Name" placeholder="Staff Full Name">
                    </div>
                    <div class="row-sm-4">
                        <label class="form-label">Staff ID</label>
                        <input class="form-control " name="Staff_Id" placeholder="Staff ID Number">
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <label class="form-label">Services </label>
                            <select name="fk_services" class="form-select ">
                                <?php
                                    $query_deptShow = mysqli_query($con,"SELECT * FROM services ORDER BY services_name");
                                    while($result_deptShow = mysqli_fetch_array($query_deptShow)){
                                ?>
                                <option value="<?php echo $result_deptShow['services_id']; ?>"><?php echo $result_deptShow['services_name']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <span><button type="button" class="btn btn-secondary btn-sm mt-4" data-bs-toggle="modal" data-bs-target="#SpecialityModal">Add Another Services</button></span>
                        </div>
                    </div>
                    <div class="row-sm-4">
                        <label class="form-label">Position</label>
                        <input class="form-control " name="Staff_Position" placeholder="Position">
                    </div>
                    <div class="row-sm-4">
                        <label class="form-label">Phone</label>
                        <input class="form-control " name="Staff_Phone" placeholder="013245678">
                    </div>
                    
                    <div class="row-sm-3">
                        <label class="form-label">Registered Date</label>
                        <input class="form-control " type="date" name="Staff_Register">
                    </div>
                    <div class="row-sm-3">
                        <input class="form-check-input" name="isActive" type="checkbox" value="yes" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            isActive
                        </label>
                    </div>
                    <div class="row mt-3">
                        <button type="submit" name="addStaff" class="btn btn-primary btn-sm mt-2">Save</button>
                    </div>
                </div>
                </form>
            </div>
            <div style="background-color: rgb(219, 250, 215); " class="col ms-5">
                <div class="row mb-3">
                    <div class="overflow-auto p-3" style="max-width: auto; max-height: 600px;">
                        <ol class="list-group list-group-numbered">
                            <?php
                                $query_deptStaff = mysqli_query($con,"SELECT * FROM user ORDER BY user_id DESC ");
                                while($result_deptStaff = mysqli_fetch_array($query_deptStaff)){
                                $fk_services_id = $result_deptStaff['fk_services_id'];
                                $staff_id = $result_deptStaff['user_id'];
                            ?>
                            <li class="list-group-item d-flex align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">
                                        <?php echo $result_deptStaff['user_fname']; ?> 
                                        [<?php  echo $result_deptStaff['user_staffid']; ?>]
                                        <button type="button" class="btn-sm btn-info position-relative rounded-circle">
                                            <i class="bi bi-truck"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                1
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                            </button>
                                    </div>
                                        <?php
                                            if($result_deptStaff['user_isactive']=='yes'){
                                                echo '<i class="bi bi-check-square-fill" style="color:green"></i>';
                                            }else{
                                                echo '<i class="bi bi-x-square-fill" style="color:red"></i>';
                                            }
                                            echo ' Date Register : '.''.$result_deptStaff['user_dateregister'];
                                        ?>
                                        <!-- Get Specilaity Name -->
                                        
                                        
                                        <!-- Get Department Name --><br/>
                                        <?php
                                            $query_getDept = mysqli_query($con,"SELECT services_name FROM services WHERE services_id = '$fk_services_id'");
                                            while($result_getDept = mysqli_fetch_array($query_getDept)){
                                                echo $result_getDept['services_name'];
                                            }
                                            echo ' - '.''.$result_deptStaff['user_position'];
                                        ?>
                                </div>
                                <div class="p-2">
                                    <button type="submit"  class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $staff_id ?>">Add Car</button>
                                    <button type="submit"  class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $staff_id ?>">Edit Profile</button>
                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $staff_id ?>">Delete</button>
                                </div>
                                
                                <!-- Delete Modal -->
                                <div class="modal fade" id="delete<?php echo $staff_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete <?php echo $result_deptStaff['user_fname'].''.' ['.$result_deptStaff['user_staffid'].']';?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                                Are you want to delete? <strong><?php echo $result_deptStaff['user_fname']; ?><?php echo $staff_id; ?></strong>      
                                            </div> 
                                            <div class="modal-footer">
                                            <form method="post">
                                                <input type="hidden" value="<?php echo $staff_id; ?>" name="idDelete" />
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="deleteStaff" class="btn btn-danger">DELETE</button>
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
                                                <h5 class="modal-title" id="editModalLabel">Edit <strong><?php echo $phone_id?></strong> ?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                                <form method="post">
                                                <div class="modal-body">
                                                <div class="form-group row">
                                                    
                                                    <div class="col-sm-12">
                                                    <label>Name</label>
                                                        <input class="form-control" placeholder="Enter Name" name="nameEdit" value="<?php echo $result_showData['Staff_FName']; ?>" required autofocus="autofocus" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    
                                                    <div class="col-sm-12">
                                                    <label>Designation</label>
                                                        <input class="form-control" placeholder="Enter Designation" name="designationEdit" value="<?php echo $result_showData['Staff_Designation']; ?>" required autofocus="autofocus" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    
                                                    <div class="col-sm-3">
                                                    <label>Extension</label>
                                                    <input class="form-control" placeholder="Extension" name="extEdit" value="<?php echo $result_showData['Staff_Ext']; ?>" required autofocus="autofocus" />
                                                    </div>
                                                    <div class="col-sm-3">
                                                    <label>Speed Dial</label>
                                                    <input class="form-control" placeholder="Speed Dial" name="dialEdit" value="<?php echo $result_showData['Staff_SpeedDial']; ?>" required autofocus="autofocus" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                    <label>Email</label>
                                                    <input class="form-control" placeholder="Email" name="emailEdit" value="<?php echo $result_showData['Staff_Email']; ?>" required autofocus="autofocus" />
                                                    </div>
                                                </div>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                <input type="hidden" value="<?php echo $phone_id?>" name="idEdit" />
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="editProduct" class="btn btn-primary">Save</button>
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
    if(isset($_POST['addStaff'])){
        $Staff_Name = $_POST['Staff_Name'];
        $Staff_Id = $_POST['Staff_Id'];
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

        $query_addStaff = mysqli_query($con, "INSERT INTO user(user_fname, user_staffid, user_phone, user_position, user_dateregister, user_isactive, fk_services_id) 
        VALUES ('$Staff_Name','$Staff_Id','$Staff_Phone','$Staff_Position','$Staff_Register','$isActive','$fk_services')");

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
?>
<?php include("Interface/footer.php"); ?>