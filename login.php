<?php // PDO
require_once 'connection.php';

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if (isset($_POST['customer_name']) && isset($_POST['password'])) {

    $name = sanitise($pdo, $_POST['customer_name']);
    $pw_temp = sanitise($pdo, $_POST['password']);
    $query   = "SELECT * FROM customer WHERE customer_name=$name";
    $result  = $pdo->query($query);

    if (!$result->rowCount()) echo ("<h2>User not found</h2><br>");

    $row = $result->fetch();
    $name  = $row['customer_name'];
    $pw  = $row['password'];

    if (password_verify($pw_temp, $pw)) //compare the hashed psw and the raw psw
    {
        session_start();

        $_SESSION['customer_name'] = $name;

        header('location: index.php?page=homepage');
    } else echo ("<h2>Invalid username/password combination</h2>");
} else {

    echo "";
}

function sanitise($pdo, $str)
{
    $str = htmlentities($str);
    return $pdo->quote($str);
}
?>
<html>

<head>
    <title>Log In / Register | IT FOOD</title>
    <link rel="icon" href="images/icon.jpg" type="image" sizes="100%">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/stylesheets.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <style>
        .mwrow {
            content: "";
            display: table;
            clear: both;
            width: 100%;
            height: 105px;
            border: 1px;
            border-bottom: 1px;
        }

        .namecol {
            /*SansMarque Link Column*/
            float: left;
            padding: 0px;
            height: 100px;
            border: 1px;
            margin-left: 50px;
        }

        .mwcol {
            /* Men and Women Column*/
            border-left: 1px solid;
            width: 22%;
            height: 100px;
            padding: 10px;
            padding-top: 30px;
            float: left;
            margin-left: 10px;
        }

        .underline {
            display: inline;
            position: relative;
            overflow: hidden;
        }

        .underline:after {
            content: "";
            position: absolute;
            z-index: -1;
            left: 0;
            right: 100%;
            bottom: 30px;
            background: #000;
            height: 2px;
            transition-property: left right;
            transition-duration: 0.3s;
            transition-timing-function: ease-out;
        }

        .underline:hover:after,
        .underline:focus:after,
        .underline:active:after {
            right: 0;
        }

        .login-main {
            width: 90%;
            margin: 20px 150px;
            padding: 15px;
            height: auto;
        }

        .login-main-row {
            margin: 60px 280px;
            display: table;
            clear: both;
        }

        .login-main-section {
            width: 450px;
            float: left;
            margin: 0 100px;
            height: auto;
            padding: 15px;
            background-color: white;
            color: red;
            text-align: left;
            margin-right: 50px;
        }

        .login-form {
            height: auto;
            width: 350px;
            margin-top: 5px;
            border: 1px;
        }

        .form-column {
            height: auto;
            border-bottom: 1px solid black;
            margin: 25px 0px 30px 0px;
        }

        input {
            width: 100%;
            height: auto;
            border: none;
            margin: 5px 0;
            opacity: 0.85;
            display: inline-block;
            font-size: 12pt;
            line-height: 10px;
            font-family: Haas Groot;
            text-decoration: none;
            /* remove underline from anchors */
        }

        .form-footer {
            width: 100%;
        }

        .login-forgot-password {
            color: gray;
            font-size: 11pt;
        }

        .form-button {
            background-color: black;
            color: white;
            width: 100%;
            text-align: center;
            margin-top: 25px;
            height: 44px;
            font-size: 15pt;
            letter-spacing: -2px;
            word-spacing: 5px;
            font-family: Haas Groot;
            cursor: pointer;
            border: 0px;
        }

        .form-button:hover {
            background-color: #f2f2f2;
            color: black;
            box-shadow: 2px 2px 1px black;
        }

        .login-view-content {
            width: 80%;
            height: auto;
            margin-top: 50px;
            margin-bottom: 50px;
            margin-left: 5px;
            color: black;
            letter-spacing: 1px;
        }

        .icon {
            color: red;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        div {
            display: block;
        }

        #navbar {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
        }

        #main {
            transition: margin-left .5s;
            padding: 0px;
        }

        .nav1 {
            text-align: center;
            width: device-width;
            height: auto;
            font: 20pt Georgia;
            padding: 10px;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 2px;
            overflow: hidden;
            width: 100%;
            text-align: center;
        }

        li {
            float: left;
            text-align: center;
            padding: 1px 30px;
            width: 33.33%;
        }

        li a {
            display: block;
            color: black;
            padding: 2px 2px;
            text-decoration: none;
            width: auto;
            height: auto;
            cursor: pointer;
        }

        li a:hover:not(.active) {
            background-color: #eee;
            color: black;
            font-size: 120%;
        }
    </style>
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
    <!--main container-->
    <div class="login-main">
        <div class="login-main-row">
            <section class="login-main-section">
                <h2 style="font-size:20pt;font-family:Haas Groot;letter-spacing:-3px;word-spacing:10px;color:black">LOG IN</h2>

                <form class="login-form" action="login.php" method="post">
                    <div class="form-fields">

                        <div class="form-column">

                            <br>
                            <br>

                            <input type="text" size="100" name="customer_name" placeholder="Name">

                        </div>
                        <!--end of form-column-->

                        <div class="form-column">

                            <br>
                            <br>
                            <input type="password" size="12" name="password" placeholder="Password">
                        </div>
                        <!--end of form-column-->

                    </div>
                    <!--form-fields-->


                    <div class="form-footer">

                        <button class="form-button" type="submit" value="Login">
                            <span>LOG IN</span>
                        </button>

                    </div>
                    <!--end of form-footer-->

                </form>
                <!--End of Form-->
            </section>
            <!--end of log in column-->

            <!--Register column-->
            <section class="login-main-section">
                <h2 style="font-size:20pt;font-family: Haas Groot;letter-spacing:-3px;word-spacing:10px;color:black;">REGISTER</h2>

                <div class="login-view-content">
                    <p>If you still don't have a IT Food.com account,
                        use this option to access the registration form.
                    </p>


                    <a href="register.php">
                        <button class="form-button">
                            <span>CREATE ACCOUNT</span>

                        </button>

                    </a>
                    <br><br><br><br>
                    <br><br><br><br>

                    <a href="adminLogin.php">
                        <button class="form-button">
                            <i class="fa fa-user icon" style="color:white;"></i>
                            <span>ADMIN LOGIN</span>
                        </button>
                    </a>

                </div>

            </section>

            <!--end of register column-->
        </div>
        <!--end of login-main-row-->
    </div>
    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
</body>

</html>