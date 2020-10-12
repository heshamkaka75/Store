
<?php
 session_start();
 $pagetitle = 'تقارير';
 if(isset($_SESSION['username'])) {
      include 'init.php';
?>

                <div class="container">
                  <center>

                <h1 class="jh">تقارير التوريد</h1>


                    <div class="table-responsive">
                    <table class="table text-center table-bordered m-t">
                        <tr>
                        <th>المادة</th>
                        <th>العدد</th>
                        <th>المورد</th>
                        <th>المخزن</th>
                        <th>التاريخ</th>
                        <th>الحالة</th>
                        <th>المستلم</th>
                        <th>الايصال</th>
                        <th>ملاحظات</th>
                        </tr>
            <?php
                $stmt = $con->prepare("SELECT in_store.*,items.item_name AS item_name, suppliers.sup_name AS sup_name, location.loc_name AS loc_name 
                                        FROM in_store
                                        INNER JOIN items
                                        ON items.item_id = in_store.item_id
                                        INNER JOIN suppliers
                                        ON suppliers.sup_id = in_store.sup_id
                                        INNER JOIN location
                                        ON location.loc_id = in_store.loc_id;");
                $stmt->execute();
                $rows = $stmt->fetchAll();

                foreach($rows as $row) {
                
                echo '<tr>';
                echo '<td>' . $row['item_name'] . '</td>';
                echo '<td>' . $row['in_number'] . '</td>';
                echo '<td>' . $row['sup_name'] . '</td>';
                echo '<td>' . $row['loc_name'] . '</td>';
                echo '<td>' . $row['in_date'] . '</td>';
                echo '<td>' . $row['state'] . '</td>';
                echo '<td>' . $row['received_by'] . '</td>';
                echo '<td>' . $row['receipt'] . '</td>';
                echo '<td>' . $row['in_note'] . '</td>';
                echo '</tr>';
                }
            ?>
                
                    </table>
                    </div>


                </div></center>
                </div>

<?php
      include $templ . 'footer.php'; 


 } else {
             header("location:index.php");
 }
 ?>