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
            <div style="background-color: rgb(249, 250, 215); " class="col">
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
                                <option value="<?php echo $result_deptShow['services_name']; ?>"><?php echo $result_deptShow['services_name']; ?></option>
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
                        <label class="form-label">Phone</label>
                        <input class="form-control " name="Staff_Phone" placeholder="013245678">
                    </div>
                    
                    <div class="row-sm-3">
                        <label class="form-label">Registered Date</label>
                        <input class="form-control " type="date" name="Staff_Register">
                    </div>
                    <div class="row-sm-3">
                        <input class="form-check-input" type="checkbox" value="yes" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            isActive
                        </label>
                    </div>
                    <div class="row mt-3">
                        <button type="submit" name="addDoctor" class="btn btn-primary btn-sm mt-2">Save</button>
                    </div>
                </div>
                </form>
            </div>
            <div style="background-color: rgb(219, 250, 215); " class="col ms-5">
                <div class="row mb-3">
                    <div class="overflow-auto p-3" style="max-width: auto; max-height: 600px;">
                        <ol class="list-group list-group-numbered">
                            <?php
                                $query_deptStaff = mysqli_query($con,"SELECT * FROM doctorall ORDER BY DoctorAll_ID DESC ");
                                while($result_deptStaff = mysqli_fetch_array($query_deptStaff)){
                                $FK_Hosp_ID = $result_deptStaff['FK_Hosp_ID'];
                                $FK_Speciality_ID = $result_deptStaff['FK_Speciality_ID'];
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold"><?php echo $result_deptStaff['DoctorAll_Name']; ?></div>
                                        <!-- Get Specilaity Name -->
                                        <?php  echo $FK_Speciality_ID; ?>
                                        <!-- Get Department Name --><br/>
                                        <?php
                                            $query_getDept = mysqli_query($con,"SELECT Hosp_Name FROM hospital WHERE Hosp_ID = '$FK_Hosp_ID'");
                                            while($result_getDept = mysqli_fetch_array($query_getDept)){
                                                echo $result_getDept['Hosp_Name'];
                                            }
                                        ?>
                                        <!--
                                    <button type="button" class="btn btn-info btn-sm disabled"><?php echo $result_deptStaff['Staff_SpeedDial']; ?><span class="badge bg-dark ms-2">SD</span></button>
                                    <button type="button" class="btn btn-primary btn-sm disabled"><?php echo $result_deptStaff['Staff_Ext']; ?><span class="badge bg-dark ms-2">EXT</span></button>
                                    <div class="fw-bold"><?php echo $result_deptStaff['Staff_Email']; ?></div>
                                        -->
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
        <h5 class="modal-title" id="editModalLabel">Add Doctor Speciality </strong></h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="POST">
            <div class="row mb-3 mt-4">   
                <label class="col-sm-2 col-form-label">Speciality</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="add_speciality" required/>
                </div>
            </div>
        <div class="modal-footer">
            <button class="btn btn-primary" name="saveSpeciality" type="submit">Save</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </form>   
    </div>
    </div>
</div>
<!-- End Speciality -->




<?php
    if(isset($_POST['addDoctor'])){
        $Consultant_Name = $_POST['Consultant_Name'];
        $fk_speciality = $_POST['fk_speciality'];
        $SubSpecial = $_POST['SubSpecial'];
        $Consultant_Email = $_POST['Consultant_Email'];
        $Consultant_Ext = $_POST['Consultant_Ext'];
        $fk_hospital = $_POST['fk_hospital'];
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y');
        $todayTime = date('h:i a');

        $query_addStaff = mysqli_query($con, "INSERT INTO doctorall(DoctorAll_Name, DoctorAll_Phone, DoctorAll_Email, DoctorAll_SubD, FK_Speciality_ID, FK_Hosp_ID) 
        VALUES ('$Consultant_Name','$Consultant_Ext','$Consultant_Email','$SubSpecial','$fk_speciality','$fk_hospital')");

        $_SESSION['message'] = 'Successfully update information';   
        echo '<script>window.location.href="Doctor_Add.php?msg=success"</script>';

    }

    if(isset($_POST['saveSpeciality'])){
        $speciality_name = $_POST['add_speciality'];
        $check_name = mysqli_query($con,"SELECT * FROM speciality WHERE Speciality_Name = '$speciality_name'");
        $result_name = mysqli_fetch_array($check_name);
        if($result_name>0){
            $_SESSION['message'] = 'Duplicated Speciality, Please add other speciality';   
        }else{
            //If username not exist insert into 'login' db
            $query_update = mysqli_query($con,"INSERT INTO speciality(Speciality_Name) VALUES ('$speciality_name')");
            $_SESSION['message'] = 'Successfully update information';   
            echo '<script>window.location.href="Doctor_Add.php?msg=success"</script>';
            //$_SESSION['message'] = 'Successfully update information';   
            //echo '<script>window.location.href="User_Add.php?msg=success"</script>';   
        }

    }

    if(isset($_POST['saveDepartment'])){
        $dept_name = $_POST['dept_name'];
        $dept_level = $_POST['dept_level'];
        $check_name = mysqli_query($con,"SELECT * FROM department WHERE Dept_Name = '$dept_name'");
        $result_name = mysqli_fetch_array($check_name);

        if($result_name>0){
            $_SESSION['message'] = 'Duplicated Department, Please add other department';   
        }else{
            //If username not exist insert into 'login' db
            $query_update = mysqli_query($con,"INSERT INTO department(Dept_Name,Dept_Floor) VALUES ('$dept_name','$dept_level')");
            $_SESSION['message'] = 'Successfully update information';   
            echo '<script>window.location.href="User_Add.php?msg=success"</script>';
            //$_SESSION['message'] = 'Successfully update information';   
            //echo '<script>window.location.href="User_Add.php?msg=success"</script>';   
        }

    }
?>
<?php include("Interface/footer.php"); ?>