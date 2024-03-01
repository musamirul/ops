<?php include("Interface/header.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-2 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-person-plus pt-2"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Add Category</span> <br/>
                    <span style="font-size: 14px; color: grey;">Create New Info Category</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5 ms-5 me-5">
            <div style="background-color: rgb(249, 250, 215); " class="col-4">
                <div class="row pt-3 mb-2">
                    <div class="col">
                        <div class="ms-3">
                            <center><span style="font-size: 23px;font-weight: bold;">Category</span></center>
                        </div>
                    </div>
                </div>
                <form method="post">
                <div class="col mb-3">
                    <div class="row-sm-4">
                        <label class="form-label">Category Name</label>
                        <input class="form-control " name="info_name" placeholder="Category Name" required>
                    </div>
                    <div class="row mt-3">
                        <button type="submit" name="addCategory" class="btn btn-primary btn-sm mt-2">Save</button>
                    </div>
                </div>
                </form>
            </div>
            <div style="background-color: rgb(219, 250, 215); " class="col ms-5">
                <div class="row mb-3">
                    <div class="overflow-auto p-3" style="max-width: auto; max-height: 600px;">
                        <ol class="list-group list-group-numbered">
                            <?php
                                $query_category = mysqli_query($con,"SELECT * FROM info_category ORDER BY infoc_id DESC ");
                                while($result_category = mysqli_fetch_array($query_category)){
                                    $infoc_id = $result_category['infoc_id'];
                                    $infoc_name = $result_category['infoc_name'];
                                
    
                            ?>
                            <li class="list-group-item d-flex align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">
                                        <?php echo $infoc_name; ?> 
                                    </div>      
                                </div>
                                <div class="p-2">
                                    <button type="submit"  class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $infoc_id  ?>">Edit Category</button>
                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $infoc_id  ?>">Delete</button>
                                </div>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="delete<?php echo $infoc_id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete <?php echo $infoc_name; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                                Are you want to delete? <strong><?php echo $infoc_name; ?></strong>      
                                            </div> 
                                            <div class="modal-footer">
                                            <form method="post">
                                                <input type="hidden" value="<?php echo $infoc_id; ?>" name="infoc_id" />
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="deleteCategory" class="btn btn-danger">DELETE</button>
                                            </form>
                                            </div>   
                                        </div>
                                    </div>
                                </div>


                                 <!-- Edit Modal -->
                                    <div class="modal fade" id="edit<?php echo $infoc_id?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit <strong><?php echo $infoc_name;?></strong> ?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                                <form method="post">
                                                <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <label>Name</label>
                                                        <input class="form-control" placeholder="Enter Category" name="infoc_name" value="<?php echo $infoc_name; ?>" required autofocus="autofocus" />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" value="<?php echo $infoc_id;?>" name="infoc_id" />
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="editCategory" class="btn btn-primary">Save</button>
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


<?php
    if(isset($_POST['addCategory'])){
        $info_name = $_POST['info_name'];
        // date_default_timezone_set("Asia/Kuala_Lumpur");
        // $todayDate = date('d/m/Y');
        // $todayTime = date('h:i a');

        $query_addCategory = mysqli_query($con, "INSERT INTO info_category(infoc_name) 
        VALUES ('$info_name')");

        $_SESSION['message'] = 'Successfully update information';   
        echo '<script>window.location.href="Staff_Info_Category.php?msg=success"</script>';

    }


    if(isset($_POST['deleteCategory'])){
        $infoc_id = $_POST['infoc_id'];

        $query_deleteCategory = mysqli_query($con, "DELETE FROM info_category WHERE infoc_id = '$infoc_id'");

        $query_deleteCategoryList = mysqli_query($con, "DELETE * FROM info_list WHERE fk_category_id = '$infoc_id'");
        $_SESSION['message'] = 'Successfully delete information';   
        echo '<script>window.location.href="Staff_Info_Category.php?msg=success"</script>';

    }

    //edit staff
    if(isset($_POST['editCategory'])){
        $infoc_id = $_POST['infoc_id'];
        $infoc_name = $_POST['infoc_name'];

        $query_update = mysqli_query($con,"UPDATE info_category SET infoc_name='$infoc_name' WHERE infoc_id='$infoc_id'");

        $_SESSION['message'] = 'Successfully update information';   
        echo '<script>window.location.href="Staff_Info_Category.php?msg=success"</script>';

    }
?>
<?php include("Interface/footer.php"); ?>