<?php
ob_start();
 session_start();
 $pagetitle = 'Items';
 if(isset($_SESSION['username'])) {
 include 'init.php';
 
                $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
                if ($do == 'manage') {  // manage

                $stmt = $con->prepare("SELECT * FROM items;");
                $stmt->execute();
                $rows = $stmt->fetchAll();

                     ?>
                     <h1 class="text-center he1">المواد</h1>
                    <div class="container">
                    <div class="table-responsive">
                    <table class="table text-center table-bordered m-t">
                        <tr>
                        <th>#ID</th>
                        <th>الاسم</th>
                        <th>الملاحظة</th>
                        <th>control</th>
                        </tr>
            <?php

                foreach($rows as $row) {
                
                echo '<tr>';
                echo '<td>' . $row['item_id'] . '</td>';
                echo '<td>' . $row['item_name'] . '</td>';
                echo '<td>' . $row['item_note'] . '</td>';
                echo '<td>
                <a href="items.php?do=edit&item_id=' . $row['item_id'] . ' "  class="btn btn-success"><i class="fa fa-edit"></i> تعديل</a>'; 
?>
              
                <a href="items.php?do=delete&item_id=<?php echo $row['item_id']?>" onclick="return confirm('Are you sure !!');" class="btn btn-danger"><i class="fa fa-close"></i> حذف</a>                
<?php           
/*            if ($row['approve'] == 0) {
                    
                    echo '<a href="items.php?do=approve&item_id=' . $row['item_id'] . ' "  onclick="return confirm();" class="btn btn-info"><i class="fa fa-check"></i> Approve</a>';
                } */
                echo '</td>';
                echo '</tr>';
                }
            ?>
                
                    </table>
                    </div>
                    <a href="items.php?do=add" class="btn btn-primary"> <i class="fa fa-plus"></i> اضافة جديد</a>
        
                    </div>

                    <?php


                } elseif ($do == 'add') { // add page


    ?>
        <h1 class="text-center"><i class='fa fa-edit'></i> اضافة مادة جديدة</h1>
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
                        echo '<h1 class="text-center">Insert Items</h1>';
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
                        $stmt = $con->prepare("INSERT INTO items(item_name, item_note) values(?, ?)");
                        $stmt->execute(array($name,$note));
                        $theMsg = '<div class="alert alert-success">' . $stmt->rowcount() . ' Record Insert </div>';
                        redirhome($theMsg,'items.php');
                   
                        } 
                        

                    } else { 
                    $theMsg = 'you cant browse this page directry';
                    redirhome($theMsg,'index.php');

                    }
                    echo "</div>";



                } elseif ($do == 'edit') { // edit page


                $item_id = isset($_GET['item_id']) && is_numeric($_GET['item_id'])  ? intval($_GET['item_id']) : 0;
              
                $stmt = $con->prepare("SELECT * FROM items WHERE item_id = ? limit 1");
                    $stmt->execute(array($item_id));
                    $row = $stmt->fetch();
                    $conut = $stmt->rowCount();
                    
                        if($conut > 0) {
                        
    ?>
        <h1 class="text-center">تعديل علي المادة</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=update" method="POST">
            <input type="hidden" name="item_id" value="<?php echo $item_id ?>">

            <div class="form-group">
            <label class="col-sm-2 control-label">اسم المادة</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="name" value="<?php echo $row['item_name'] ?>" class="form-control" autocomplete="off" required="required"/>
            </div>
            </div>

            <div class="form-group">
            <label class="col-sm-2 control-label">ملاحظة</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="note" value="<?php echo $row['item_note'] ?>" class="form-control" required="required" />
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
                    redirhome($theMsg,'items.php');
                }

                } elseif ($do == 'update') {  // update page


                    echo '<h1 class="text-center">تعديل علي المادة</h1>';
                    echo "<div class='container'>";
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $item_id = $_POST['item_id'];
                        $name = $_POST['name'];
                        $note = $_POST['note'];

                        $formErrors = array();
                        if (strlen($name) < 4) {
                            $formErrors[] = ' Item name cant be less than 4';
                        }

                        if (empty($name)) {
                            $formErrors[] = 'name cant be empty';
                        }

                        foreach($formErrors as $error) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                        }

                        if (empty($formErrors)) {
                            
                        $stmt = $con->prepare("UPDATE items set item_name = ?, item_note=? WHERE item_id = ? limit 1");
                        $stmt->execute(array($name, $note, $item_id));
                        $theMsg = '<div class="alert alert-success">' . $stmt->rowcount(). ' Record update </div>';
                        redirhome($theMsg,'items.php'); 
                        }
                        

                    } else {
                        $theMsg =  'you cant browse this page';
                        redirhome($theMsg,'items.php');
                    }
                    echo "</div>";

                } elseif ($do == 'delete') { //delete page

            
                    echo '<h1 class="text-center">Delete Item</h1>';
                    echo "<div class='container'>";

                    $item_id = isset($_GET['item_id']) && is_numeric($_GET['item_id'])  ? intval($_GET['item_id']) : 0;
                    $stmt = $con->prepare("SELECT * FROM items WHERE item_id = ? limit 1");
                    $stmt->execute(array($item_id));
                    $conut = $stmt->rowCount();
                    
                        if($conut > 0) {
                            $stmt = $con->prepare("DELETE from items where item_id = $item_id");
                            $stmt->execute();
                        $theMsg = '<div class="alert alert-success">' . $stmt->rowcount() . ' Record Delete </div>';
                        redirhome($theMsg,'items.php');

                        } else {
                            $theMsg =  '<div class="alert alert-danger">this id not exest</div>';
                            redirhome($theMsg,'items.php');
                        }

                    echo '</div>';

                } elseif($do == 'approve') { // approve
                
                echo '<h1 class="text-center">Approve Item</h1>';
                    echo "<div class='container'>";


                    $item_id = isset($_GET['item_id']) && is_numeric($_GET['item_id'])  ? intval($_GET['item_id']) : 0;                 
                    $conut = chechItem ('item_id', 'items', $item_id);
                    
                        if($conut > 0) {
                            $stmt = $con->prepare("UPDATE items set approve =1  WHERE item_id = $item_id");
                            $stmt->execute();
                            $theMsg = '<div class="alert alert-success">' . $stmt->rowcount() . ' Record Activated </div>';
                            redirhome($theMsg,'items.php');

                        } else {
                            $theMsg =  '<div class="alert alert-danger">this id not exest</div>';
                            redirhome($theMsg,'items.php');
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