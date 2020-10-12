<?php
ob_start();
 session_start();
 $pagetitle = 'اضافة للمخزن';
 if(isset($_SESSION['username'])) {
 include 'init.php';
 
 
                        echo '<h1 class="text-center">اضافة</h1>';
                        echo "<div class='container'>";
                        $item_name = $_POST['name'];
                        $supplier = $_POST['supplier'];
                        $number = $_POST['number'];
                        $location = $_POST['location'];
                        $receipt = $_POST['receipt'];
                        $received = $_POST['received'];
                        $note = $_POST['note'];
                        $state = $_POST['state'];
          
                        $formErrors = array();
 
                        
                        foreach($formErrors as $error) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                        }

                        if (empty($formErrors)) {
                        $stmt = $con->prepare("INSERT INTO in_store(item_id, sup_id, in_number, loc_id, receipt, received_by, in_note, state, in_date) values(?,?,?,?,?,?,?,?,now())");
                        $stmt->execute(array($item_name, $supplier, $number, $location ,$receipt,  $received ,$note,$state));
                        $theMsg = '<div class="alert alert-success">' . $stmt->rowcount() . ' Record Insert </div>';
                        redirhome($theMsg,'index.php');
                   
                        } 
                        

                   
                    echo "</div>";



      include $templ . 'footer.php'; 
            } else {
                        header("location:index.php");
                        exit();
            }

            ob_end_flush();
 ?>