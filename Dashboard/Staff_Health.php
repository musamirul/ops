<?php 
    include("Interface/header.php"); 
    session_start();
    $_SESSION['user_id'];
    

?>
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
                
                $nameSearch = $_POST['nameSearch'];
                if($nameSearch != ''){
                    $_SESSION['user_id'] = $_POST['nameSearch'];
                    
                }
                if(isset($_POST['searchButton'])){
                    if($nameSearch==''){
                        unset($_SESSION['user_id']);
                    }
                }

                $nameSearch = $_SESSION['user_id'];

                
                
                
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
                $user_isactive = $searchResult['user_isactive'];
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
        
                  
               
              
            ?>
        </div>
        <div class="row" style="height:200px">
            <?php if($newUser_id != null){?>
            <div class="card">
                <h5 class="card-header"><?php echo $user_fname.' ['.$user_id.']'; ?><?php if($user_isactive=='no'){echo '- <span style="color:red">INACTIVE</span>'.' ';} ?></h5>
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
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(210, 240, 240);"></span>
        <div class="row pt-2">
            <div style="background-color: rgb(210, 250, 250); " class="col">
                <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <th>Start Date</th>
                        <th>Period</th>
                        <th>Illness Type</th>
                        <th>Card Num</th>
                        <th>Card IsReturn</th>
                        <th>Card DateReturn</th>
                        <th>Remark</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query_health = mysqli_query($con,"SELECT * FROM health_record WHERE fk_staff_id='$user_id' ORDER BY health_id DESC ");
                            while($result_health = mysqli_fetch_array($query_health)){
                                $health_id = $result_health['health_id'];
                                $fk_card_id = $result_health['fk_card_id'];
                                
                                $query_card = mysqli_query($con,"SELECT * FROM card WHERE card_id='$fk_card_id'");
                                $result_card = mysqli_fetch_array($query_card);
                                $card_serialnum = $result_card['card_serialnum'];
                        ?>
                        <tr>
                            <th><?php echo $result_health['health_startdate']; ?></th>
                            <th><?php echo $result_health['health_period']; ?></th>
                            <th><?php echo $result_health['health_type']; ?></th>
                            <th><?php echo $card_serialnum; ?></th>
                            <th><?php echo $result_health['health_iscardreturn']; ?></th>
                            <th><?php echo $result_health['health_datecardreturn']; ?></th>
                            <th><?php echo $result_health['health_remark']; ?></th>
                            <th>
                                <?php if($result_health['health_iscardreturn']=='yes'){ ?>
                                    <button type="submit"  class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#returnCard<?php echo $health_id ?>">Return Card</button>
                                <?php }elseif($result_health['health_iscardreturn']=='no'){ ?>
                                    <button type="submit"  class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#receiveCard<?php echo $health_id ?>">Receive Card</button>
                                <?php } ?>
                                <button type="submit"  class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editHealth<?php echo $health_id ?>">Edit Illness</button>

                                <!-- Edit Health Modal -->
                                <div class="modal fade" id="editHealth<?php echo $health_id?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit <strong><?php echo $result_health['health_type'];?></strong> ?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Illness Type</label>
                                                        <input class="form-control" placeholder="Illness Type" name="health_type" value="<?php echo $result_health['health_type']; ?>" required autofocus="autofocus" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Remark</label>
                                                        <input class="form-control" placeholder="Enter Remark" name="health_remark" value="<?php echo $result_health['health_remark']; ?>" required autofocus="autofocus" />
                                                    </div>
                                                </div>                                         
                                                <div class="modal-footer">
                                                    <input type="hidden" value="<?php echo $health_id;?>" name="health_id" />
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="editHealth" class="btn btn-primary">Save</button>
                                                </form>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Receive Card Modal -->
                                <div class="modal fade" id="receiveCard<?php echo $health_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Illness Date <?php echo $result_health['health_startdate'];?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            Do user return card? <strong><?php echo $card_serialnum ?></strong>      
                                        </div> 
                                        <div class="modal-footer">
                                        <form method="post">
                                            <input type="hidden" value="<?php echo $card_serialnum; ?>" name="card_serialnum" />
                                            <input type="hidden" value="<?php echo $health_id; ?>" name="health_id" />
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="receiveCard" class="btn btn-danger">Receive</button>
                                        </form>
                                        </div>   
                                    </div>
                                </div>
                                </div>
                                <!-- End Receive Card Modal-->
                                <!-- Return Card Modal -->
                                <div class="modal fade" id="returnCard<?php echo $health_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Illness Date <?php echo $result_health['health_startdate'];?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            Do you want to return card to user? <strong><?php echo $card_serialnum ?></strong>      
                                        </div> 
                                        <div class="modal-footer">
                                        <form method="post">
                                            <input type="hidden" value="<?php echo $card_serialnum; ?>" name="card_serialnum" />
                                            <input type="hidden" value="<?php echo $health_id; ?>" name="health_id" />
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="returnCard" class="btn btn-danger">Return</button>
                                        </form>
                                        </div>   
                                    </div>
                                </div>
                                </div>
                                <!-- End Return Card Modal-->
                            </th>
                        </tr>
                        <?php
                            }
                        ?>
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
                                    $query_empShow = mysqli_query($con,"SELECT * FROM card WHERE card_isactive='yes' AND card_isuse='no' ORDER BY card_id");
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
    if(isset($_POST['editHealth'])){
        $health_id = $_POST['health_id'];
        $health_type = $_POST['health_type'];
        $health_remark = $_POST['health_remark'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y h:i:s a', time());
        // $todayTime = date('h:i a');

        $query_updateHealth = mysqli_query($con, "UPDATE health_record SET health_type='$health_type',health_remark='$health_remark' WHERE health_id='$health_id'");

        $_SESSION['message'] = 'Successfully update information';

        echo '<script>window.location.href="Staff_Health.php?msg=success"</script>';

    }

    if(isset($_POST['receiveCard'])){
        $card_serialnum = $_POST['card_serialnum'];
        $health_id = $_POST['health_id'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y h:i:s a', time());
        // $todayTime = date('h:i a');

        $query_updateHealth = mysqli_query($con, "UPDATE health_record SET health_iscardreturn='yes',health_datecardreturn='$todayDate' WHERE health_id='$health_id'");

        $query_updateCard = mysqli_query($con,"UPDATE card SET card_isuse='no' WHERE card_serialnum='$card_serialnum'");

        $_SESSION['message'] = 'Successfully update information';

        echo '<script>window.location.href="Staff_Health.php?msg=success"</script>';

    }
    if(isset($_POST['returnCard'])){
        $card_serialnum = $_POST['card_serialnum'];
        $health_id = $_POST['health_id'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y h:i:s a', time());
        // $todayTime = date('h:i a');

        $query_updateHealth = mysqli_query($con, "UPDATE health_record SET health_iscardreturn='no',health_datecardreturn='' WHERE health_id='$health_id'");

        $query_updateCard = mysqli_query($con,"UPDATE card SET card_isuse='yes' WHERE card_serialnum='$card_serialnum'");

        $_SESSION['message'] = 'Successfully update information';

        echo '<script>window.location.href="Staff_Health.php?msg=success"</script>';

    }
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
         VALUES ('$health_type','$health_startdate','$health_period','no','','$health_remark','$todayDate','$card_id','$user_id')");

        $query_updateCard = mysqli_query($con,"UPDATE card SET card_isuse='yes' WHERE card_id='$card_id'");

        $_SESSION['message'] = 'Successfully update information';

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