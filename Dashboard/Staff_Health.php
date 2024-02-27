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
            <?php } ?>
        </div>
        <div class="row">
            <center>
            <div class="btn-group mt-2 shadow" style="width:500px">
                <a href="Staff_Health.php" class="btn btn-primary active" aria-current="page">Health Record</a>
                <a href="Staff_Parking.php" class="btn btn-primary">Parking Record</a>
                <a href="#" class="btn btn-primary">Profile</a>
            </div>
            </center>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(210, 240, 240);"></span>
        <div class="row pt-2">
            <div style="background-color: rgb(210, 250, 250); " class="col shadow pt-3 rounded-4">
            <button type="submit" style="width:150px"  class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#addHealth<?php echo $user_id ?>">Add Health Record</button>
                <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <th>Illness Duration Date</th>
                        <th>Illness Type</th>
                        <th>Remark</th>
                        <th>Record Date</th>
                        <th>Status</th>
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
                            <th><?php echo $result_health['health_type']; ?></th>
                            <th><?php echo $result_health['health_remark']; ?></th>
                            <th><?php echo $result_health['health_recorddate']; ?></th>
                            <th><?php echo $result_health['health_iscomplete']; ?></th>
                            <th>
                                <?php if($result_health['health_iscomplete']=='yes'){ ?>
                                    <button type="submit"  class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#complete<?php echo $health_id ?>">Not Complete</button>
                                <?php }elseif($result_health['health_iscomplete']=='no'){ ?>
                                    <button type="submit"  class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#notcomplete<?php echo $health_id ?>">Complete</button>
                                <?php } ?>
                                <button type="submit"  class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editHealth<?php echo $health_id ?>">Edit Illness</button>
                                
                                <!-- Receive Card Modal -->
                                <div class="modal fade" id="complete<?php echo $health_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Health Type <?php echo $result_health['health_type']; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            Do you want to <b>UNCOMPLETE</b> this status? <strong><?php echo $result_health['health_type']; ?></strong>      
                                        </div> 
                                        <div class="modal-footer">
                                        <form method="post">
                                            <input type="hidden" value="<?php echo $health_id ?>" name="health_id" />
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="complete" class="btn btn-danger">Uncomplete</button>
                                        </form>
                                        </div>   
                                    </div>
                                </div>
                                </div>
                                <!-- End Receive Card Modal-->
                                <!-- Return Card Modal -->
                                <div class="modal fade" id="notcomplete<?php echo $health_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Health Type <?php echo $result_health['health_type']; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            Do you want to <b>COMPLETE</b> this status? <strong><?php echo $result_health['health_type']; ?></strong>      
                                        </div> 
                                        <div class="modal-footer">
                                        <form method="post">
                                            <input type="hidden" value="<?php echo $health_id ?>" name="health_id" />
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="notcomplete" class="btn btn-danger">Complete</button>
                                        </form>
                                        </div>   
                                    </div>
                                </div>
                                </div>
                                <!-- End Return Card Modal-->

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
                        <!-- <input class="form-control" type="date" name="health_startdate" required autofocus="autofocus" /> -->
                        <input class="filterdate form-control" type="text" name="health_startdate"/>
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
    if(isset($_POST['complete'])){
        $health_id= $_POST['health_id'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y h:i:s a', time());
        // $todayTime = date('h:i a');

        $query_updateHealth = mysqli_query($con, "UPDATE health_record SET health_iscomplete='no' WHERE health_id='$health_id'");

        $_SESSION['message'] = 'Successfully update information';

        echo '<script>window.location.href="Staff_Health.php?msg=success"</script>';

    }
    if(isset($_POST['notcomplete'])){
        $health_id= $_POST['health_id'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y h:i:s a', time());
        // $todayTime = date('h:i a');

        $query_updateHealth = mysqli_query($con, "UPDATE health_record SET health_iscomplete='yes' WHERE health_id='$health_id'");

        $_SESSION['message'] = 'Successfully update information';

        echo '<script>window.location.href="Staff_Health.php?msg=success"</script>';

    }
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
    if(isset($_POST['addHealth'])){
        $user_id = $_POST['user_id'];
        $health_type = $_POST['health_type'];
        $health_startdate = $_POST['health_startdate'];
        $health_remark = $_POST['health_remark'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y');
        // $todayTime = date('h:i a');

        $query_addHealth = mysqli_query($con, "INSERT INTO health_record(health_type, health_startdate,  health_remark, health_recorddate, health_iscomplete, fk_staff_id)
         VALUES ('$health_type','$health_startdate','$health_remark','$todayDate','no','$user_id')");

        $_SESSION['message'] = 'Successfully update information';

        echo '<script>window.location.href="Staff_Health.php?msg=success"</script>';

    }

?>
<?php include("Interface/footer.php"); ?>