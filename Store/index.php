
<?php
 session_start();
 $nonavbar = '';
 $pagetitle = 'loging';
 if(isset($_SESSION['username'])) {
  header("location:home.php");
 }
 include 'init.php';
 

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $username = $_POST['user'];
     $password = $_POST['pass'];
     //$hashedpass = sha1($password);
    
$stmt = $con->prepare("SELECT user_id,user_name,password FROM users
 WHERE user_name = ? AND password = ? ");
     $stmt->execute(array($username, $password));
     $row = $stmt->fetch();
     $conut = $stmt->rowCount();
     
        if($conut > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $row['user_id'];
        
        header("location:home.php");
    } else {
      echo 'you are not register';
    
    }
 }
 ?>
          <div class="container">
            <center><h1>جامعة المغتربين</h1></center>
          <center><img src="layout/images/logo.jpg"/></center>
              <center><h1><i class="fa fa-cart-plus"></i> المخزن </h1></center>
              </div>

    <div class="container">

      <form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <input type="text" name="user" class="form-control" placeholder="أسم المستخدم" required autofocus>
        <input type="password" name="pass" class="form-control" placeholder="كلمة المرور" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me</label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">تسجيل الدخول</button>
      </form>

    </div> 


<?php include $templ . 'footer.php'; ?>

