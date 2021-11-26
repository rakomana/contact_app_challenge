<?php
    require_once 'app\Controllers\ContactController.php';
    include('layouts\header.php');
?>
    <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">
            
            <h1>Contact Management  <a class="btn" href="insert.php">Add Contact</a></h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="search">
                <input type="text" name="value" placeholder="What are you looking for?">
                <button type="submit" class="btn">
                    Search
                </button>
            </div>
            </form>
          <?php index();?>
          </div>
        </div>
      </div>
<?php
    include('layouts\footer.php');
?>