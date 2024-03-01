<?php include("Interface/header.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-2 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-person-plus pt-2"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Add Info List</span> <br/>
                    <span style="font-size: 14px; color: grey;">Create New Info List</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5 ms-5 me-5">
            <div style="background-color: rgb(249, 250, 215); " class="col-4">
                <div class="row pt-3 mb-2">
                    <div class="col">
                        <div class="ms-3">
                            <center><span style="font-size: 23px;font-weight: bold;">Information List</span></center>
                        </div>
                    </div>
                </div>
                <form method="post">
                <div class="col mb-3">
                    <div class="row-sm-4">
                        <label class="form-label">Select Category</label>
                        <select name="fk_infoc_id" class="form-select ">
                            <?php
                                $query_catShow = mysqli_query($con,"SELECT * FROM info_category ORDER BY infoc_name");
                                while($result_catShow = mysqli_fetch_array($query_catShow)){
                            ?>
                            <option value="<?php echo $result_catShow['infoc_id']; ?>"><?php echo $result_catShow['infoc_name']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="row-sm-4">
                        <label class="form-label">Total Number</label>
                        <input class="form-control" type="number" name="info_total" placeholder="" required>
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
                        
                            <?php
                                $query_info = mysqli_query($con,"SELECT * FROM info_list ORDER BY infolist_id DESC ");
                                while($result_info = mysqli_fetch_array($query_info)){
                                    $infolist_id = $result_info['infolist_id'];
                                    $infolist_total = $result_info['infolist_total'];
                                    $infolist_category = $result_info['fk_category_id'];

                                    $query_category = mysqli_query($con,"SELECT * FROM info_category WHERE infoc_id='$infolist_category'");
                                    $result_category = mysqli_fetch_array($query_category);
                                    $category_name = $result_category['infoc_name']
                                
                            ?>
                            <div class="row shadow bg-white p-2">
                                <div class="col-6 fw-bold">
                                    <?php echo $category_name; ?> 
                                </div>      
                                <div class="col fw-bold">
                                    <?php echo $infolist_total; ?> 
                                </div>      
                                <div class="col float-end">
                                    <button type="submit"  class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $infolist_id ?>">Edit Total</button>
                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $infolist_id ?>">Delete</button>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="delete<?php echo $infolist_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete <?php echo $category_name;?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            Are you want to delete? <strong><?php echo $category_name; ?></strong>      
                                        </div> 
                                        <div class="modal-footer">
                                        <form method="post">
                                            <input type="hidden" value="<?php echo $infolist_id; ?>" name="infolist_id" />
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="deleteInfo" class="btn btn-danger">DELETE</button>
                                        </form>
                                        </div>   
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="edit<?php echo $infolist_id?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel"><strong><?php echo $category_name;?></strong> ?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post">
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                <label>Edit Total Number Of <strong><?php echo $category_name;?></strong></label>
                                                    <input class="form-control" type="number" name="infolist_total" value="<?php echo $infolist_total; ?>" required autofocus="autofocus" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" value="<?php echo $infolist_id;?>" name="infolist_id" />
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="editTotal" class="btn btn-primary">Save</button>
                                        </form>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
</div>


<?php
    if(isset($_POST['addInfo'])){
        $fk_infoc_id = $_POST['fk_infoc_id'];
        $info_total = $_POST['info_total'];

        $query_addLot = mysqli_query($con, "INSERT INTO info_list(infolist_total, fk_category_id) 
        VALUES ('$info_total','$fk_infoc_id')");

        $_SESSION['message'] = 'Successfully update information';   
        echo '<script>window.location.href="Staff_Info.php?msg=success"</script>';

    }


    if(isset($_POST['deleteInfo'])){
        $infolist_id= $_POST['infolist_id'];

        $query_deleteInfo = mysqli_query($con, "DELETE FROM info_list WHERE infolist_id = '$infolist_id'");
        $_SESSION['message'] = 'Successfully delete information';   
        echo '<script>window.location.href="Staff_Info.php?msg=success"</script>';

    }

    //edit staff
    if(isset($_POST['editTotal'])){
        $infolist_id = $_POST['infolist_id'];
        $infolist_total = $_POST['infolist_total'];

        $query_update = mysqli_query($con,"UPDATE info_list SET infolist_total='$infolist_total' WHERE infolist_id='$infolist_id'");

        $_SESSION['message'] = 'Successfully update information';   
        echo '<script>window.location.href="Staff_Info.php?msg=success"</script>';

    }

?>
<?php include("Interface/footer.php"); ?>