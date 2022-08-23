<?php //PDO
require_once 'connection.php';
try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
// Template header
function template_header($title)
{
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="css/stylesheets.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="icon" href="images/icon.jpg" type="image" sizes="100%">
	</head>
    <body>
        <header>
        <div id="navbar" class="sticky" style="z-index:99;">
        <div id="main">
					<nav class="nav1">
						<ul>							
							<li><a href="index.php?page=login" class="fa fa-user" title="Profile" style="float:left"></a></li>
                            <li><a class="homepage" href="index.php?page=homepage" title="Home"><img src="images/icon.jpg" style="width:75px;height:75px;"></a></li>
                            <li><a href="index.php?page=cart" class="cart fa fa-shopping-cart" title="View Cart" style="float:right"></a></li>
						</ul>
					</nav>
				</div>
                </div>
        </header>
    <main>
EOT;
}

// footer
function template_footer()
{
    // $year = date('Y');
    echo <<<EOT
    <div id="footer" class="footer-box" style="text-align:center;">
    </div>

    <hr>
    <br><br>
    <p style="color:black;">&copy 2022 IT FOOD. ALL RIGHTS RESERVED.</p>
    <!--end of Footer-->
</body>
</html>

EOT;
}
