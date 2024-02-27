<?php include("Interface/header.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-2 bg-body rounded me-5">

        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5 ms-5 me-5">
            <div style="background-color: rgb(249, 250, 215); " class="col-6">
                <div class="row pt-3 mb-2">
                    <div class="col">
                        <div class="ms-3">
                            <center><span style="font-size: 23px;font-weight: bold;">Parking Info</span></center>
                        </div>
                    </div>
                </div>
                <form method="post">
                <div class="col mb-3">
                    <div class="row">
                        <div class="col">
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total motorcycle parking b1</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total motorcycle parking b2</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total parking bay basement 2</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total reserved parking (basement)</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total pregnant parking (patient)</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total MD/ED parking</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total oku parking</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total valet parking</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total dialysis parking</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total staff pregnant parking (outside)</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total A&E parking</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total ER doctor parking</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total ambulans parking</label></div>
                            <div class="row-sm-4 mb-1"><label for="inputPassword6" class="col-form-label">total oncall parking</label></div>
                        </div>
                        <div class="col">
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_motorb1" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_motorb2" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_bayb2" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_reserved" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_pregnantpt" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_mded" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_oku" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_valet" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_dialysis" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_pregnantstaff" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_ae" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_er" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_ambulance" required></div>
                            <div class="row-sm-4 mb-1"><input type="number" class="form-control input-group-sm" name="info_oncall" required></div>

                        </div>
                    </div>
                    <div class="row mt-3">
                        <button type="submit" name="addInfo" class="btn btn-primary btn-sm mt-2">Save</button>
                    </div>
                </div>
                </form>
            </div>
            <div style="background-color: rgb(219, 250, 215); " class="col ms-5">
                <div class="row mb-3">
                    <div class="overflow-auto p-3" style="max-width: auto; max-height: 600px;">
                        <ol class="list-group list-group-numbered">
                            <?php
                                $query_card = mysqli_query($con,"SELECT * FROM parking_lot ORDER BY lot_id DESC ");
                                while($result_card = mysqli_fetch_array($query_card)){
                                    $lot_isreserve = $result_card['lot_isreserve'];
                                    $lot_isactive = $result_card['lot_isactive'];
                                    $lot_id = $result_card['lot_id'];
                                
    
                            ?>
                            <li class="list-group-item d-flex align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">
                                        <?php echo $result_card['lot_number']; ?> 
                                        [<?php  echo $result_card['lot_delegation']; ?>]
                                                                                
                                            <span class="badge <?php if($lot_isactive=='yes'){echo 'bg-success';}else{echo 'bg-danger';} ?>"><?php if($lot_isactive=='yes'){echo 'ACTIVE';}else{echo 'INACTIVE';} ?></span>
                                            <span class="badge <?php if($lot_isreserve=='no'){echo 'bg-success';}else{echo 'bg-danger';} ?>"><?php if($lot_isreserve=='no'){echo 'UNUSED';}else{echo 'USED';} ?></span>
                                    </div>      
                                </div>
                                <div class="p-2">
                                    <!-- <button type="submit"  class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $lot_id ?>">Edit Profile</button> -->
                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $lot_id ?>">Delete</button>
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


<?php
    if(isset($_POST['addInfo'])){
        $info_motorb1 = $_POST['info_motorb1'];
        $info_motorb2 = $_POST['info_motorb2'];
        $info_bayb2 = $_POST['info_bayb2'];
        $info_reserved = $_POST['info_reserved'];
        $info_pregnantpt = $_POST['info_pregnantpt'];
        $info_mded = $_POST['info_mded'];
        $info_oku = $_POST['info_oku'];
        $info_valet = $_POST['info_valet'];
        $info_dialysis = $_POST['info_dialysis'];
        $info_pregnantstaff = $_POST['info_pregnantstaff'];
        $info_ae = $_POST['info_ae'];
        $info_er = $_POST['info_er'];
        $info_ambulance = $_POST['info_ambulance'];
        $info_oncall = $_POST['info_oncall'];

        $query_addLot = mysqli_query($con, "INSERT INTO info(info_motorb1, info_motorb2, info_bayb2, info_reserved, info_pregnantpt, info_mded, info_oku, info_valet, 
        info_dialysis, info_pregnantstaff, info_ae, info_er, info_ambulance, info_oncall) 
        VALUES ('$info_motorb1','$info_motorb2','$info_bayb2','$info_reserved','$info_pregnantpt','$info_mded','$info_oku','$info_valet','$info_dialysis',
        '$info_pregnantstaff','$info_ae','$info_er','$info_ambulance','$info_oncall')");

        $_SESSION['message'] = 'Successfully update information';   
        echo '<script>window.location.href="Staff_info.php?msg=success"</script>';

    }

?>
<?php include("Interface/footer.php"); ?>