<?php
ob_start();
 session_start();
 $pagetitle = 'الادارات والكليات';
 if(isset($_SESSION['username'])) {
 include 'init.php';
 
                $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
                if ($do == 'manage') {  // manage

                $stmt = $con->prepare("SELECT * FROM customers;");
                $stmt->execute();
                $rows = $stmt->fetchAll();

                     ?>
                     <h1 class="text-center he1">الادارات والكليات</h1>
                    <div class="container">
                    <div class="table-responsive">
                    <table class="table text-center table-bordered m-t">
                        <tr>
                        <th>#ID</th>
                        <th>الادارة -الكلية</th>
                        <th>الملاحظة</th>
                        <th>control</th>
                        </tr>
            <?php

                foreach($rows as $row) {
                
                echo '<tr>';
                echo '<td>' . $row['cus_id'] . '</td>';
                echo '<td>' . $row['cus_name'] . '</td>';
                echo '<td>' . $row['cus_note'] . '</td>';
                echo '<td>
                <a href="customers.php?do=edit&cus_id=' . $row['cus_id'] . ' "  class="btn btn-success"><i class="fa fa-edit"></i> تعديل</a>'; 
?>
              
                <a href="customers.php?do=delete&cus_id=<?php echo $row['cus_id']?>" onclick="return confirm('Are you sure !!');" class="btn btn-danger"><i class="fa fa-close"></i> حذف</a>                
<?php           
/*            if ($row['approve'] == 0) {
                    
                    echo '<a href="customers.php?do=approve&cus_id=' . $row['cus_id'] . ' "  onclick="return confirm();" class="btn btn-info"><i class="fa fa-check"></i> Approve</a>';
                } */
                echo '</td>';
                echo '</tr>';
                }
            ?>
                
                    </table>
                    </div>
                    <a href="customers.php?do=add" class="btn btn-primary"> <i class="fa fa-plus"></i> اضافة جديد</a>
        
                    </div>

                    <?php


                } elseif ($do == 'add') { // add page


    ?>
        <h1 class="text-center"><i class='fa fa-edit'></i> اضافة قسم جديدة</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=insert" method="POST">

            <div class="form-group">
            <label class="col-sm-2 control-label">الاسم</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="name" class="form-control" placeholder="Name of the item" required="required"/>
            </div>
            </div>

            <div class="form-group">
            <label class="col-sm-2 control-label">ملاحظة</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="note" class="form-control" placeholder="Description of the item" required="required"/>
            </div>
            </div>

            <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" value="Add" class="btn btn-primary" />

            </div>
            </div>

            </form>
        </div>

    <?php


                } elseif ($do == 'insert') { // insert page

                    
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        echo '<h1 class="text-center">اضافة قسم</h1>';
                        echo "<div class='container'>";
                        $name = $_POST['name'];
                        $note = $_POST['note'];
          
                        $formErrors = array();
                        if (strlen($name) < 4) {
                            $formErrors[] = 'Name cant be less than 4';
                        }

                        if (empty($name)) {
                            $formErrors[] = 'Name cant be empty';
                        }

                        if (empty($note)) {
                            $formErrors[] = 'note cant be empty';
                        }

                        
                        foreach($formErrors as $error) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                        }

                        if (empty($formErrors)) {
                        $stmt = $con->prepare("INSERT INTO customers(cus_name, cus_note) values(?, ?)");
                        $stmt->execute(array($name,$note));
                        $theMsg = '<div class="alert alert-success">' . $stmt->rowcount() . ' Record Insert </div>';
                        redirhome($theMsg,'customers.php');
                   
                        } 
                        

                    } else { 
                    $theMsg = 'you cant browse this page directry';
                    redirhome($theMsg,'index.php');

                    }
                    echo "</div>";



                } elseif ($do == 'edit') { // edit page


                $cus_id = isset($_GET['cus_id']) && is_numeric($_GET['cus_id'])  ? intval($_GET['cus_id']) : 0;
              
                $stmt = $con->prepare("SELECT * FROM customers WHERE cus_id = ? limit 1");
                    $stmt->execute(array($cus_id));
                    $row = $stmt->fetch();
                    $conut = $stmt->rowCount();
                    
                        if($conut > 0) {
                        
    ?>
        <h1 class="text-center">تعديل علي قسم</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=update" method="POST">
            <input type="hidden" name="cus_id" value="<?php echo $cus_id ?>">

            <div class="form-group">
            <label class="col-sm-2 control-label">اسم القسم</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="name" value="<?php echo $row['cus_name'] ?>" class="form-control" autocomplete="off" required="required"/>
            </div>
            </div>

            <div class="form-group">
            <label class="col-sm-2 control-label">ملاحظة</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="note" value="<?php echo $row['cus_note'] ?>" class="form-control" required="required" />
            </div>
            </div>

  

            <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" value="Save" class="btn btn-primary" />

            </div>
            </div>

            </form>
        </div>

    <?php
                } else {
                    $theMsg = 'No id select';
                    redirhome($theMsg,'customers.php');
                }

                } elseif ($do == 'update') {  // update page


                    echo '<h1 class="text-center">تعديل علي قسم</h1>';
                    echo "<div class='container'>";
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $cus_id = $_POST['cus_id'];
                        $name = $_POST['name'];
                        $note = $_POST['note'];

                        $formErrors = array();
                        if (strlen($name) < 4) {
                            $formErrors[] = ' cus name cant be less than 4';
                        }

                        if (empty($name)) {
                            $formErrors[] = 'name cant be empty';
                        }

                        foreach($formErrors as $error) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                        }

                        if (empty($formErrors)) {
                            
                        $stmt = $con->prepare("UPDATE customers set cus_name = ?, cus_note=? WHERE cus_id = ? limit 1");
                        $stmt->execute(array($name, $note, $cus_id));
                        $theMsg = '<div class="alert alert-success">' . $stmt->rowcount(). ' Record update </div>';
                        redirhome($theMsg,'customers.php'); 
                        }
                        

                    } else {
                        $theMsg =  'you cant browse this page';
                        redirhome($theMsg,'customers.php');
                    }
                    echo "</div>";

                } elseif ($do == 'delete') { //delete page

            
                    echo '<h1 class="text-center">Delete Item</h1>';
                    echo "<div class='container'>";

                    $cus_id = isset($_GET['cus_id']) && is_numeric($_GET['cus_id'])  ? intval($_GET['cus_id']) : 0;
                    $stmt = $con->prepare("SELECT * FROM customers WHERE cus_id = ? limit 1");
                    $stmt->execute(array($cus_id));
                    $conut = $stmt->rowCount();
                    
                        if($conut > 0) {
                            $stmt = $con->prepare("DELETE from customers where cus_id = $cus_id");
                            $stmt->execute();
                        $theMsg = '<div class="alert alert-success">' . $stmt->rowcount() . ' Record Delete </div>';
                        redirhome($theMsg,'customers.php');

                        } else {
                            $theMsg =  '<div class="alert alert-danger">this id not exest</div>';
                            redirhome($theMsg,'customers.php');
                        }

                    echo '</div>';

                } elseif($do == 'approve') { // approve
                
                echo '<h1 class="text-center">Approve customers</h1>';
                    echo "<div class='container'>";


                    $cus_id = isset($_GET['cus_id']) && is_numeric($_GET['cus_id'])  ? intval($_GET['cus_id']) : 0;                 
                    $conut = chechItem ('cus_id', 'items', $cus_id);
                    
                        if($conut > 0) {
                            $stmt = $con->prepare("UPDATE customers set approve =1  WHERE cus_id = $cus_id");
                            $stmt->execute();
                            $theMsg = '<div class="alert alert-success">' . $stmt->rowcount() . ' Record Activated </div>';
                            redirhome($theMsg,'customers.php');

                        } else {
                            $theMsg =  '<div class="alert alert-danger">this id not exest</div>';
                            redirhome($theMsg,'customers.php');
                        }

                    echo '</div>';

                }

      include $templ . 'footer.php'; 
            } else {
                        header("location:index.php");
                        exit();
            }

            ob_end_flush();
 ?>