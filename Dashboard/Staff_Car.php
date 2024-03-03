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
                <a href="Staff_Health.php" class="btn btn-primary" aria-current="page">Health Record</a>
                <a href="Staff_Parking.php" class="btn btn-primary">Parking Record</a>
                <a href="Staff_Car.php" class="btn btn-primary active">Car Record</a>
            </div>
            </center>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(210, 240, 240);"></span>
        <div class="row pt-2">
            <div style="background-color: rgb(210, 250, 250); " class="col shadow pt-3 rounded-4">
            <?php if($user_id != ''){ ?>
            <button type="submit" style="width:150px"  class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#addCar<?php echo $user_id ?>">Add Car Record</button>
            <?php }?>
                <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <th>Plate Number</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query_health = mysqli_query($con,"SELECT * FROM car_record WHERE fk_staff_id='$user_id' ORDER BY car_id DESC ");
                            while($result_health = mysqli_fetch_array($query_health)){
                                $car_id = $result_health['car_id'];
                                $car_platenum = $result_health['car_platenum'];
                                $car_brand = $result_health['car_brand'];
                                $car_model = $result_health['car_model'];
                                $car_color = $result_health['car_color'];
                        ?>
                        <tr>
                            <th><?php echo $car_platenum; ?></th>
                            <th><?php echo $car_brand; ?></th>
                            <th><?php echo $car_model; ?></th>
                            <th><?php echo $car_color; ?></th>
                            <th>
                                <button type="submit"  class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCar<?php echo $car_id; ?>">Edit Car</button>
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $car_id; ?>">Delete</button>
                                
                               <!-- Delete Modal -->
                               <div class="modal fade" id="delete<?php echo $car_id;?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete <?php echo $car_platenum;?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                                Do you want to delete? <strong><?php echo $car_platenum; ?></strong>      
                                            </div> 
                                            <div class="modal-footer">
                                            <form method="post">
                                                <input type="hidden" value="<?php echo $car_id; ?>" name="idDelete" />
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="deleteCar" class="btn btn-danger">DELETE</button>
                                            </form>
                                            </div>   
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Car Modal -->
                                <div class="modal fade" id="editCar<?php echo $car_id;?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit <strong><?php echo $car_platenum;?></strong> ?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Plate Number</label>
                                                        <input class="form-control" placeholder="Plate Number" name="platenum" value="<?php echo $car_platenum; ?>" required autofocus="autofocus" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Brand</label>
                                                        <input class="form-control" placeholder="Car Brand" name="brand" value="<?php echo $car_brand; ?>" required autofocus="autofocus" />
                                                    </div>
                                                </div>                                         
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Model</label>
                                                        <input class="form-control" placeholder="Car Model" name="model" value="<?php echo $car_model; ?>" required autofocus="autofocus" />
                                                    </div>
                                                </div>                                         
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Color</label>
                                                        <input class="form-control" placeholder="Car Color" name="color" value="<?php echo $car_color; ?>" required autofocus="autofocus" />
                                                    </div>
                                                </div>                                         
                                                <div class="modal-footer">
                                                    <input type="hidden" value="<?php echo $car_id;?>" name="car_id" />
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="editCar" class="btn btn-primary">Save</button>
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



<!-- Add Car Modal -->
<div class="modal fade" id="addCar<?php echo $user_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Add Car</strong> ?</h5>
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
                    <input type="hidden" value="<?php echo $user_id;?>" name="idAddCarHidden" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="addCar" class="btn btn-primary">Save</button>
            </form>
            </div>   
        </div>
    </div>
</div>





<?php
    if(isset($_POST['deleteCar'])){
        $idDelete = $_POST['idDelete'];

        $query_deleteCar = mysqli_query($con, "DELETE FROM car_record WHERE car_id = '$idDelete'");
        $_SESSION['message'] = 'Successfully delete information';   
        echo '<script>window.location.href="Staff_Car.php?msg=success"</script>';

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
            echo '<script>window.location.href="Staff_Car.php?msg=success"</script>';
            //$_SESSION['message'] = 'Successfully update information';   
            //echo '<script>window.location.href="User_Add.php?msg=success"</script>';   
        }

    }
    if(isset($_POST['editCar'])){
        $car_id = $_POST['car_id'];
        $platenum = $_POST['platenum'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $color = $_POST['color'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d/m/Y h:i:s a', time());
        // $todayTime = date('h:i a');

        $query_updateCar = mysqli_query($con, "UPDATE car_record SET car_platenum='$platenum',car_model='$model',
        car_brand='$brand',car_color='$color' WHERE car_id='$car_id'");

        $_SESSION['message'] = 'Successfully update information';

        echo '<script>window.location.href="Staff_Car.php?msg=success"</script>';

    }

?>
<?php include("Interface/footer.php"); ?>