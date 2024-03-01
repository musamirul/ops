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
                <h5 class="card-header"><?php echo $user_fname.' ['.$user_staffid.']'; ?><?php if($user_isactive=='no'){echo '- <span style="color:red">INACTIVE</span>'.' ';} ?></h5>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $services_name; ?> - <?php echo $user_position; ?></h5>
                    <p class="card-text">
                        <div class="d-flex flex-row bd-highlight mb-2">
                            <div class="bd-highlight"><span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">Phone </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"> <?php echo $user_phone; ?></span></div>
                            <div class="ps-2 bd-highlight">| <span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">Date Register </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"><?php echo $user_dateregister; ?></span></div>
                            <div class="ps-2 bd-highlight">| <span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">Employee Type </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"><?php echo $emptype_name; ?></span></div>
                        </div>
                    </p>
                </div>
            </div>
            <?php }else{?>
                <center><h2 class='mt-5'>No Record</h2></center>
            <?php } ?>
        </div>
        <div class="row">
            <center>
            <div class="btn-group mt-2 shadow" style="width:500px">
                <a href="Staff_Health.php" class="btn btn-primary">Health Record</a>
                <a href="Staff_Parking.php" class="btn btn-primary active" aria-current="page">Parking Record</a>
                <a href="#" class="btn btn-primary">Profile</a>
            </div>
            </center>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(210, 240, 240);"></span>
        <div class="row pt-2">
            <div style="background-color: rgb(210, 250, 250); " class="col shadow pt-3 rounded-4">
            <?php if($user_id != ''){ ?>
            <button type="submit" style="width:150px"  class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#addParking<?php echo $user_id ?>">Add Parking Record</button>
            <?php } ?>
                <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <th>Access Card</th>
                        <th>Parking Lot</th>
                        <th>Card Receive Date</th>
                        <th>IsCardReturn</th>
                        <th>DateCardReturn</th>
                        <th>DateClearLot</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query_health = mysqli_query($con,"SELECT * FROM parking WHERE fk_user_id='$user_id' ORDER BY parking_id DESC ");
                            while($result_health = mysqli_fetch_array($query_health)){
                                
                                $fk_card_id = $result_health['fk_card_id'];
                                $fk_lot_id = $result_health['fk_lot_id'];
                                $parking_datecardborrow = $result_health['parking_datecardborrow'];
                                $parking_iscardreturn = $result_health['parking_iscardreturn'];
                                $parking_datecardreturn = $result_health['parking_datecardreturn'];
                                $parking_datelotclear = $result_health['parking_datelotclear'];
                                $parking_id = $result_health['parking_id'];
                                
                                $query_card = mysqli_query($con,"SELECT * FROM card WHERE card_id='$fk_card_id'");
                                $result_card = mysqli_fetch_array($query_card);
                                $card_serialnum = $result_card['card_serialnum'];

                                $query_lot = mysqli_query($con,"SELECT * FROM parking_lot WHERE lot_id = '$fk_lot_id'");
                                $result_lot = mysqli_fetch_array($query_lot);
                                $lot_number = $result_lot['lot_number'];
                        ?>
                        <tr>
                            <th><?php if($fk_card_id==0){echo 'n/a';}else{echo $card_serialnum;} ?></th>
                            <th><?php if($fk_lot_id==0){echo 'n/a';}else{echo $lot_number; } ?></th>
                            <th><?php echo $parking_datecardborrow; ?></th>
                            <th><?php echo $parking_iscardreturn ?></th>
                            <th><?php echo $parking_datecardreturn ?></th>
                            <th><?php echo $parking_datelotclear ?></th>
                            <th><?php if($fk_card_id!=0){ ?>
                                    <?php if($result_health['parking_iscardreturn']=='yes'){ ?>
                                        <!-- <button type="submit"  class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#returnCard<?php //echo $parking_id ?>">Return Card</button> -->
                                        card returned
                                    <?php }elseif($result_health['parking_iscardreturn']=='no'){ ?>
                                        <button type="submit"  class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#receiveCard<?php echo $parking_id ?>">Receive Card</button>
                                    <?php } ?>
                                <?php }elseif($fk_card_id==0 && $fk_lot_id>=1) {?>
                                    <button type="submit"  class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#clearLot<?php echo $parking_id ?>">Clear Parking Lot</button>
                                <?php } ?>
                                
                                <!-- Clear Lot Modal -->
                                <div class="modal fade" id="clearLot<?php echo $parking_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Lot Number <?php echo $lot_number;?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            Do you want to clear lot? <strong><?php echo $lot_number; ?></strong>      
                                        </div> 
                                        <div class="modal-footer">
                                        <form method="post">
                                            <input type="hidden" value="<?php echo $fk_lot_id; ?>" name="lot_id" />
                                            <input type="hidden" value="<?php echo $parking_id ; ?>" name="parking_id" />
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="clearLot" class="btn btn-danger">Clear</button>
                                        </form>
                                        </div>   
                                    </div>
                                </div>
                                </div>
                                <!-- End Clear Lot Modal-->
                                
                                <!-- Receive Card Modal -->
                                <div class="modal fade" id="receiveCard<?php echo $parking_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Serial Number <?php echo $card_serialnum;?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            Do user return card? <strong><?php echo $card_serialnum ?></strong>      
                                        </div> 
                                        <div class="modal-footer">
                                        <form method="post">
                                            <input type="hidden" value="<?php echo $card_serialnum; ?>" name="card_serialnum" />
                                            <input type="hidden" value="<?php echo $fk_lot_id; ?>" name="lot_id" />
                                            <input type="hidden" value="<?php echo $parking_id ; ?>" name="parking_id" />
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="receiveCard" class="btn btn-danger">Receive</button>
                                        </form>
                                        </div>   
                                    </div>
                                </div>
                                </div>
                                <!-- End Receive Card Modal-->
                                <!-- Return Card Modal -->
                                <div class="modal fade" id="returnCard<?php echo $parking_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Serial Number <?php echo $card_serialnum;?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            Do you want to return card to user? <strong><?php echo $card_serialnum ?></strong>      
                                        </div> 
                                        <div class="modal-footer">
                                        <form method="post">
                                            <input type="hidden" value="<?php echo $card_serialnum; ?>" name="card_serialnum" />
                                            <input type="hidden" value="<?php echo $fk_lot_id; ?>" name="lot_id" />
                                            <input type="hidden" value="<?php echo $parking_id ; ?>" name="parking_id" />
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



<div class="modal fade" id="addParking<?php echo $user_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Add Parking Record to : <strong><?php echo $user_fname?></strong> ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <form method="post">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                    <label>Select Card</label>
                        <select name="card_id" class="form-select ">
                                <option value="null">none</option>
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
                    <label>Select Parking Lot</label>
                        <select name="lot_id" class="form-select ">
                                <option value="null">none</option>
                                <?php
                                    $query_empShow = mysqli_query($con,"SELECT * FROM parking_lot WHERE lot_isactive='yes' AND lot_isreserve='no' ORDER BY lot_id");
                                    while($result_empShow = mysqli_fetch_array($query_empShow)){
                                ?>
                                    <option value="<?php echo $result_empShow['lot_id']; ?>">
                                        <?php echo $result_empShow['lot_number']; ?>
                                        <?php if($result_empShow['lot_isreserve']=='yes'){echo ' NOT AVAILABLE';}else{echo 'AVAILABLE';}?>
                                    </option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                </div>
            </div> 
            <div class="modal-footer">
                    <input type="hidden" value="<?php echo $user_id;?>" name="user_id" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="addParking" class="btn btn-primary">Save</button>
            </form>
            </div>   
        </div>
    </div>
</div>





<?php
    if(isset($_POST['clearLot'])){
        $lot_id = $_POST['lot_id'];
        $parking_id = $_POST['parking_id'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y h:i:s a', time());
        // $todayTime = date('h:i a');


        $query_updateLot = mysqli_query($con, "UPDATE parking_lot SET lot_isreserve='no' WHERE lot_id='$lot_id'");

        $query_updateParking= mysqli_query($con,"UPDATE parking SET parking_iscardreturn='yes', parking_datecardreturn='$todayDate', parking_datelotclear='$todayDate' WHERE parking_id='$parking_id'");

        $_SESSION['message'] = 'Successfully update information';

        echo '<script>window.location.href="Staff_Parking.php?msg=success"</script>';

    }

    if(isset($_POST['receiveCard'])){
        $card_serialnum = $_POST['card_serialnum'];
        $lot_id = $_POST['lot_id'];
        $parking_id = $_POST['parking_id'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y h:i:s a', time());
        // $todayTime = date('h:i a');

        if($lot_id!=0){
            $query_updateLot = mysqli_query($con, "UPDATE parking_lot SET lot_isreserve='no' WHERE lot_id='$lot_id'");
        }

        $query_updateCard = mysqli_query($con,"UPDATE card SET card_isuse='no' WHERE card_serialnum='$card_serialnum'");
        $query_updateParking= mysqli_query($con,"UPDATE parking SET parking_iscardreturn='yes', parking_datecardreturn='$todayDate', parking_datelotclear='$todayDate' WHERE parking_id='$parking_id'");

        $_SESSION['message'] = 'Successfully update information';

        echo '<script>window.location.href="Staff_Parking.php?msg=success"</script>';

    }
    if(isset($_POST['returnCard'])){
        $card_serialnum = $_POST['card_serialnum'];
        $lot_id = $_POST['lot_id'];
        $parking_id = $_POST['parking_id'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y h:i:s a', time());
        // $todayTime = date('h:i a');

        if($lot_id!=0){
            $query_updateHealth = mysqli_query($con, "UPDATE parking_lot SET lot_isreserve='yes' WHERE lot_id='$lot_id'");
        }

        $query_updateCard = mysqli_query($con,"UPDATE card SET card_isuse='yes' WHERE card_serialnum='$card_serialnum'");
        $query_updateParking= mysqli_query($con,"UPDATE parking SET parking_iscardreturn='no', parking_datecardreturn='', parking_datelotclear='' WHERE parking_id='$parking_id'");

        $_SESSION['message'] = 'Successfully update information';

        echo '<script>window.location.href="Staff_Parking.php?msg=success"</script>';

    }
    if(isset($_POST['addParking'])){
        $user_id = $_POST['user_id'];
        $lot_id = $_POST['lot_id'];
        $card_id = $_POST['card_id'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y');
        // $todayTime = date('h:i a');

        if($lot_id!='null'){
            $query_updateLot = mysqli_query($con,"UPDATE parking_lot SET lot_isreserve='yes' WHERE lot_id='$lot_id'");
        }
        if($card_id!='null'){
            $query_updateCard = mysqli_query($con,"UPDATE card SET card_isuse='yes' WHERE card_id='$card_id'");
        }
        
        $query_addParking = mysqli_query($con, "INSERT INTO parking(fk_user_id, fk_card_id, fk_lot_id, parking_iscardreturn, parking_datecardborrow,
         parking_datecardreturn) 
        VALUES ('$user_id','$card_id','$lot_id','no','$todayDate','')");

        
        
        

        $_SESSION['message'] = 'Successfully update information';

        echo '<script>window.location.href="Staff_Parking.php?msg=success"</script>';

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