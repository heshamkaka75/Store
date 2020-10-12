
<?php
 session_start();
 $pagetitle = 'dashbord';
 if(isset($_SESSION['username'])) {
      include 'init.php';
?>

    <div class="container text-center">
    <h1 class="he1"><i class="fa fa-home"></i> Dashbord</h1>
    <div class='row'>

    <div class='col-md-3'>
    <div class='stat tm'><i class="fa fa-users"></i> Total Members
    <span><a href="members.php"><?php echo countItem ('userid', 'users')  ?></a></span>
    </div>
    </div>

    <div class='col-md-3'>
    <div class='stat pm'>Pending Members
    <span><a href="members.php?do=manage&page=Pending"><?php echo chechItem ('regstatus', 'users', 0);  ?></a></span>
    </div>
    </div>

    <div class='col-md-3'>
    <div class='stat ti'>Total Item
    <span><a href="items.php"><?php echo countItem ('item_id', 'items');  ?></a></span>
    </div>
    </div>

    <div class='col-md-3'>
    <div class='stat tc'>Total Comments
    <span>774</span>
    </div>
    </div>

    </div>
    </div>

            <div class="container last">
            <div class="row">

            <div class="col-sm-6">
            <div class="panel panel-default">
            <div class="panel-heading">
            Lastest 5 Registerd Users
            </div>
            <div class="panel-body">
            <ul class="list-unstyled">
            <?php
            $lastusers = getlast('*', 'users', 'userid', 5);
            foreach($lastusers as $last) {
                  echo '<li class="ulli">' . $last['username'] . '</li>';
            }
            ?>
            </ul>
            </div>
            </div>
            </div>

            <div class="col-sm-6">
            <div class="panel panel-default">
            <div class="panel-heading">
            Lastest Items Added
            </div>
            <div class="panel-body">
            <ul class="list-unstyled">
<?php
            $last_items = getlast('*', 'items', 'item_id');
            foreach($last_items as $last) {
                  echo '<li class="ulli">' . $last['name'] . '</li>';
            }

?>       
            </ul>
            </div>
            </div>
            </div>


            </div>
            </div>

<?php

      include $templ . 'footer.php'; 
      
 } else {
             header("location:index.php");
 }


 ?>