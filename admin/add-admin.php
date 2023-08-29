<!DOCTYPE html>
<html lang="en">
<?php

require('includes/head.php');

?>
<body>
    
<?php
require('includes/nav.php');
if($_SESSION['admin']['role'] == 'admin'){ 
  header('location: ./index.php');
}
?>

    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Add Admin</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form Action="./handlars/createAdmin.php" method="post" enctype="multipart/form-data">
                        <!-- Alerts errors-->
                        
                        <?php require('./includes/alerts.php');?>

                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                              <label>Status</label>
                             <select name="is_active" class="form-control">
                              <option value="1">active<option>
                              <option value="0">not active<option>
                             </select>
                            </div>
                            <div class="form-group">
                              <label>Image</label>
                              <input type="file" class="form-control" name="image">
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-dark" href="#">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
require('includes/script.php');
?>
</body>
</html>