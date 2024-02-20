<?php include("Interface/header.php"); ?>

<?php include("Message_Notification.php")?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-building pt-2"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Add Hospital</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and update Hospital Directory</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5 ms-5 me-5">
            <div style="background-color: rgb(249, 250, 215); " class="col-5">
                <div class="row p-3">
                    <div class="ms-3">
                        <center><span style="font-size: 23px;font-weight: bold;">Add Hospital</span></center> <br/>
                    </div>
                </div>
                <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Hospital Name </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" required/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Operator Telephone </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="telephone" required/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Address </label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="3" name="address"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Region </label>
                    <div class="col-sm-8">
                        <select name="region" class="form-select form-select-sm">
                            <option value="southern">Southern Region</option>
                            <option value="central">Central Region</option>
                            <option value="east">East Region</option>
                            <option value="north">North Region</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 ps-2 pe-2">
                    <button type="submit" name="addHosp" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
            <div style="background-color: rgb(219, 250, 215); " class="col-5 ms-5">
                <div class="row pt-3">
                    <div class="ms-3">
                        <center><span style="font-size: 23px;font-weight: bold;">List of Hospital</span></center> <br/>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        
                            <div class="overflow-auto p-3" style="max-width: auto; max-height: 600px;">
                                <ol class="list-group list-group-numbered">
                                    <?php
                                        $query_deptStaff = mysqli_query($con,"SELECT * FROM hospital ORDER BY Hosp_ID DESC ");
                                        while($result_deptStaff = mysqli_fetch_array($query_deptStaff)){
                                    ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                        <div class="fw-bold"><?php echo $result_deptStaff['Hosp_Name']; ?></div>
                                        <?php echo $result_deptStaff['Hosp_Phone']; ?>
                                        <?php echo $result_deptStaff['Hosp_Region']; ?>
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
</div>


<?php
    if(isset($_POST['addDepartment'])){
        $dept_name = $_POST['dept_name'];
        $dept_level = $_POST['dept_level'];
        $query_update = mysqli_query($con,"INSERT INTO department(Dept_Name,Dept_Floor) VALUES ('$dept_name','$dept_level')");

        $_SESSION['message'] = 'Successfully update information';   
        echo '<script>window.location.href="Phone_Add.php?msg=success"</script>';

    }

    if(isset($_POST['addHosp'])){
        $name = $_POST['name'];
        $telephone = $_POST['telephone'];
        $address = $_POST['address'];
        $region = $_POST['region'];

        $query_addHosp = mysqli_query($con, "INSERT INTO hospital(Hosp_Name, Hosp_Phone, Hosp_Address, Hosp_Region) 
        VALUES ('$name','$telephone','$address','$region')");
        $_SESSION['message'] = 'Successfully update information';   
        echo '<script>window.location.href="Doctor_Hosp_add.php?msg=success"</script>';

    }
?>
<?php include("Interface/footer.php"); ?>