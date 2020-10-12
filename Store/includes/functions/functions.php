<?php
// get title
function gettitle() {
        global $pagetitle;
        if (isset($pagetitle)) {
            echo $pagetitle;
        } else {
            echo 'defulte';
        }
}

// redircet func

function redirhome($theMsg, $url = 'index.php', $sec = 3) {
  //  if ($url == null) { $url = 'index.php'; }
    echo '<div class="container"> <br/>';
    echo   $theMsg ;
    echo '<div class="alert alert-info">you will be redircet to ' . $url . ' after ' . $sec . ' Seconds</div>';
    echo '</div>';
    header("refresh:$sec;url=$url");
    exit();
}

// chek items

function chechItem ($select, $from, $value) {
    global $con;
    $stetment = $con->prepare("SELECT $select from $from where $select = ? ");
    $stetment->execute(array($value));
    $count = $stetment->rowCount();
    return $count;

}


function countItem ($item, $table) {
    global $con;
    $stet3 = $con->prepare("SELECT COUNT($item) from $table");
    $stet3->execute();
    return $stet3->fetchColumn();
}


// get last item
            function getlast($select, $table, $order, $limit=5) {
            global $con;
            $getstm = $con->prepare("SELECT $select from $table order by $order desc limit $limit");
            $getstm->execute();
            $rows = $getstm->fetchAll();
            return $rows;
            }

            
?>




