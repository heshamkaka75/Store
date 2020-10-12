<?php
ob_start();
 session_start();
 $pagetitle = 'توريد';
 if(isset($_SESSION['username'])) {
 include 'init.php';
 ?>
        <h1 class="text-center"><i class='fa fa-edit'></i> توريد </h1>
        <div class="container">
            <form class="form-horizontal" action="in_store_insert.php" method="POST">

            <div class="form-group">
            <label class="col-sm-2 control-label">المادة</label>
            <div class="col-sm-10 col-md-6">
            <select name="name" class="form-control">
            
            <?php
                $stm = $con->prepare("SELECT * from items");
                $stm->execute();
                $items = $stm->fetchAll();
                foreach($items as $item) {
                    echo "<option value='" . $item['item_id'] . "'>" . $item['item_name'] . "</option>";
                }
            ?>

            </select>
            </div>
            </div>


            <div class="form-group">
            <label class="col-sm-2 control-label">المورد</label>
            <div class="col-sm-10 col-md-6">
            <select name="supplier" class="form-control">
            
            <?php
                $stm = $con->prepare("SELECT * from suppliers");
                $stm->execute();
                $items = $stm->fetchAll();
                foreach($items as $item) {
                    echo "<option value='" . $item['sup_id'] . "'>" . $item['sup_name'] . "</option>";
                }
            ?>

            </select>
            </div>
            </div>



            <div class="form-group">
            <label class="col-sm-2 control-label">العدد</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="number" class="form-control" placeholder="عدد المواد" required="required"/>
            </div>
            </div>

            <div class="form-group">
            <label class="col-sm-2 control-label">الحالة</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="state" class="form-control" placeholder="حالة المادة" required="required"/>
            </div>
            </div>


            <div class="form-group">
            <label class="col-sm-2 control-label">المخزن</label>
            <div class="col-sm-10 col-md-6">
            <select name="location" class="form-control">
            
            <?php
                $stm = $con->prepare("SELECT * from location");
                $stm->execute();
                $items = $stm->fetchAll();
                foreach($items as $item) {
                    echo "<option value='" . $item['loc_id'] . "'>" . $item['loc_name'] . "</option>";
                }
            ?>

            </select>
            </div>
            </div>

            <div class="form-group">
            <label class="col-sm-2 control-label">رقم الايصال</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="receipt" class="form-control" placeholder="رقم الفاتورة"/>
            </div>
            </div>

            <div class="form-group">
            <label class="col-sm-2 control-label">اسم المستلم</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="received" class="form-control" placeholder="اسم مستلم المواد"/>
            </div>
            </div>

            <div class="form-group">
            <label class="col-sm-2 control-label">ملاحظات</label>
            <div class="col-sm-10 col-md-6">
            <input type="text" name="note" class="form-control" placeholder="دون اي ملاحظة"/>
            </div>
            </div>

            <div class="form-group">
            <label class="col-sm-2 control-label">التاريخ</label>
            <div class="col-sm-10 col-md-6">
            <label class="form-control"/><?php echo date("Y/m/d") ; ?></label>
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


      include $templ . 'footer.php'; 
            } else {
                        header("location:index.php");
                        exit();
            }

            ob_end_flush();
 ?>