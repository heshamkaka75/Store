
<?php
 session_start();
 $pagetitle = 'Home';
 if(isset($_SESSION['username'])) {
      include 'init.php';
?>

                <div class="container">
                  <center>

                      <div class="jumbotron">
                        <h1 class="jh">مخازن جامعة المغتربين</h1>
                              <p class="lead">
                                    نظام لإدارة جميع عمليات التخزين في الجامعة
                                     ، تبدا من مرحلة الشراء من الموردين المعتمدين والاسواق 
                                    والتخزين عن طريق امين المخزن ، ثم
                                     تاتي مرحلة التسليم للإدارات والكليات بعد حصول الإذن من المدير المالي
		                  </p>
                              </div>
                              


                <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-2"><h1 class="rrr"><a href="reports.php">تقارير</a></h1></div>
                <div class="col-sm-2"><h1 class="rrr"> <a href="store_now.php">المخزن</a></h1></div>
                <div class="col-sm-2"><h1 class="rrr"><a href="out_store.php">تسليم</a> </h1></div>
                <div class="col-sm-2"><h1 class="rrr"><a href="in_store.php">توريد</a></h1></div>
                <div class="col-sm-2"></div>

                </div></center>
                </div>




<?php
      include $templ . 'footer.php'; 


 } else {
             header("location:index.php");
 }
 ?>