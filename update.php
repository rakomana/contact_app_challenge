<?php
require_once 'app\Controllers\ContactController.php';
include ('layouts\header.php');
$row = show();
?>

     <div class="container">
        <div class="col pt-5">
            <h2>Update Data</h2>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id'];?>" method="post">
            <div class="form-group">
            <label for="update_full_name">Full Name</label>
            <input type="text" name="update_full_name" class="form-control" id="update_full_name" placeholder="Full Name" value="<?php echo $row['full_name'];?>" required>
            </div>
            <div class="form-group">
            <label for="update_phone_number">Phone Number</label>
            <input type="text" name="update_phone_number" class="form-control" id="update_phone_number" placeholder="Phone Number" value="<?php echo $row['phone_number'];?>" required>
            </div>
            <div class="form-group">
            <label for="update_email">Email</label>
            <input type="text" name="update_email" class="form-control" id="update_email" placeholder="Email" value="<?php echo $row['email'];?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

<?php
include ('layouts\footer.php');
?>