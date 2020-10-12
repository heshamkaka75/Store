
<?php
 session_start();
 $pagetitle = 'تقارير';
 if(isset($_SESSION['username'])) {
      include 'init.php';
?>

                <div class="container">
                  <center>

                <h1 class="jh">تقارير الادارات</h1>
                            
                </div></center>
                </div>

<?php
      include $templ . 'footer.php'; 


 } else {
             header("location:index.php");
 }
 ?>