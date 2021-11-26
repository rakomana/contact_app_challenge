<?php
require_once 'app\Controllers\ContactController.php';
include ('layouts\header.php');
?>

<div class="container">
    <div class="row">
        <div class="col pt-5">
            <h2>Insert Data</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full Name">
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <hr>
            <?php index() ?>
        </div>
    </div>
</div>

<?php
include ('layouts\footer.php');
?>