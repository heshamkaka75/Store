<?php
ob_start();
 session_start();
 $pagetitle = '';
 if(isset($_SESSION['username'])) {
 include 'init.php';
 
                $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
                if ($do == 'manage') { 
                    echo 'wellcome';
                } elseif ($do == 'add') { // add page

                } elseif ($do == 'insert') { // insert page

                } elseif ($do == 'edit') { // edit page

                } elseif ($do == 'update') {  // update page

                } elseif ($do == 'delete') { //delete page

                } elseif($do == 'activate') { // activate
                
                }

      include $templ . 'footer.php'; 
            } else {
                        header("location:index.php");
                        exit();
            }

            ob_end_flush();
 ?>