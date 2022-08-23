<?php //PDO
session_start();
if(!isset($_SESSION['customer_name']))
{
	header("location: login.php");
}

if (isset($_SESSION['customer_name']))
  {
    $customer_name = htmlspecialchars($_SESSION['customer_name']);
       
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) { //10 min
        destroy_session_and_data();
    
        echo "<h1 style='text-decoration:underline;text-align:center;'>Session time out!! <br></h1>";
        echo "<h2 style='text-align:center;color:red;'>Please <a href=login.php>Click Here</a> to log in again.</h2>";
    }
    else{
            echo "<h2 style='text-align:center;'><br>Hi $customer_name. Inactive 10 minutes will auto logout</h2>";
        }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
  }
  else echo "Please <a href='login.php'>Click Here</a> to log in.";

  function destroy_session_and_data()
{
   unset($_SESSION['customer_name']);
   $_SESSION = array();
   session_unset();
   setcookie(session_name(), '', time() - 2592000, '/');
   session_destroy();
}

include_once 'functions.php';
// $pdo = pdo_connect_mysql();
// Page is set to home (homepage.php) by default
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'homepage';

include_once $page . '.php';

require_once "config.php";

?>