<?php //PDO
require_once 'connection.php';

if (isset($_POST['customer_name']) && isset($_POST['psw']) && isset($_POST['confirm_psw']) && isset($_POST['phone'])) {

    try {
        $pdo = new PDO($attr, $user, $pass, $opts);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    // sent from form and sanitise
    $mycustomer_name    =  sanitise($pdo, $_POST['customer_name']);
    $mypassword    =  sanitise($pdo, $_POST['psw']);
    $mypassword =  password_hash($mypassword, PASSWORD_DEFAULT);
    $phone        =  sanitise($pdo, $_POST['phone']);
    //call validation here
    //.= accumulate, if the previous has error then accumulate the error msg, combine become long validation line
    $validation = data_validation($_POST['customer_name'], "/^[a-zA-Z]{5,50}$/", "customer_name");
    $validation .= data_validation($_POST['psw'], '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,12}$/', "password- at least one letter, at least one number, and there have to be 6-12 characters");
    $validation .= data_validation($_POST['phone'], '/^\d{10}$/', "phone");

    if ($validation == "") { //if 0 error, nothing from above
        $query = "INSERT INTO $tbl_name (id, customer_name, password, telephone) 
        VALUES(NULL, $mycustomer_name, '$mypassword', $phone)"; //null because auto increment, insert accordingly

        $result = $pdo->query($query); //run the query string

        if (!$result) {
            die('Error: ' . mysqli_error($myConnection));
        }
        header("location:index.php?page=login");
    } else {
        echo $validation;
    }
}

function sanitise($pdo, $str)
{
    $str = htmlentities($str);
    return $pdo->quote($str);
}

function data_validation($data, $data_pattern, $data_type) //put all the validation together
{
    if (preg_match($data_pattern, $data)) { //custom make a function, if they cannot match
        return "";
    } else { //then invalid
        return "Invalid data for " . $data_type . ";";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register | IT FOOD</title>

    <link rel="icon" href="images/icon.jpg" type="image" sizes="19X19">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/stylesheets.css" rel="stylesheet" type="text/css">

    <style>
        #navbar {
            text-align: center;
            position: fixed;
            background-color: white;
            opacity: 100%;
            height: auto;
            padding-top: 20px;
            max-width: 100%;
            min-width: 1290px;
            z-index: 9;
            margin-top: -8px;
            margin-left: -10px;
            padding-bottom: 20px;
            border-bottom: 2px solid gray;
        }

        #navbar a {
            padding: 40px 38px;
            text-decoration: none;
            color: black;
            opacity: 100%;
            font-size: 12px;
            transition: 0.2s;
        }

        #navbar img {
            width: 30px;
            float: left;
            margin-left: 35px;
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

        .registermain-row {
            width: 100%;
            border: 5px;
            padding-top: 110px;
        }

        .registercontentwrapper {
            max-width: 1000px;
            padding-left: 300px;
            border: 2px;
            padding-bottom: 50px;
        }

        .registertextbox {
            margin-bottom: 10px;
            width: 100%;
            font: 15pt sans-serif;
            border: 2px;
        }

        form {
            display: block;
            border: 1px;
            padding-top: 20px;
            padding-left: 10px;
            height: auto;
        }

        .form-grp-1 {
            margin-bottom: 2.5rem;
        }

        .row-register-1 {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding: 5px;
        }

        .form-col-1 {
            position: relative;
            width: 50%;
            padding-right: 15px;
            padding-left: 15px;
        }

        textarea {
            overflow: auto;
            resize: vertical;
        }

        input[type="text"i],
        input[type="tel"i],
        input[type="password"i] {
            padding: 5px 10px;
        }

        .input {
            font-size: 13px;
            padding: 20px 10px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        .form-control-1 {
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .75rem .75rem;
            margin-top: 1px;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: none;
            border-radius: .10rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .form-control-1 {
            border-bottom: 1px solid #666;
        }

        textarea.form-control {
            height: auto;
        }

        input {
            text-rendering: auto;
            /* color: -internal-light-dark-color(black, white); */
            letter-spacing: -0.5px;
            word-spacing: normal;
            display: inline-block;
            text-align: start;
            -webkit-appearance: textfield;
            background-color: -internal-light-dark-color(rgb(255, 255, 255), rgb(59, 59, 59));
            -webkit-rtl-ordering: logical;
            cursor: text;
            margin: 0em;
            font: 400 13.3333px Arial;
            padding: 1px 2px;
            border-width: 1px;
            border-style: inset;
            border-color: -internal-light-dark-color(rgb(118, 118, 118), rgb(195, 195, 195));
            border-image: initial;
        }

        .help-block {
            color: red;
        }

        [type=button]:not(:disabled),
        [type=reset]:not(:disabled),
        [type=button]:not(:disabled),
        button:not(:disabled) {
            cursor: pointer;
        }

        .register-submit-btn {
            background-color: #ff914d;
            font-size: 14px;
            width: auto;
            height: 40px;
            border: none;
            color: black;
            font-style: aleo;
            font-weight: bold;
            padding: 10px 50px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 3px;
            margin-left: 500px;
            margin-top: 20px;
        }

        .register-submit-btn:hover {
            background-color: darkgray;
            color:white;
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
        }

        button,
        select {
            text-transform: none;
        }

        button,
        input {
            overflow: visible;
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        button {
            -webkit-appearance: button;
            text-rendering: auto;
            color: -internal-light-dark-color(buttontext, rgb(170, 170, 170));
            letter-spacing: normal;
            word-spacing: normal;
            text-transform: none;
            text-indent: 0px;
            text-shadow: none;
            display: inline-block;
            text-align: center;
            align-items: flex-start;
            cursor: default;
            background-color: -internal-light-dark-color(rgb(239, 239, 239), rgb(74, 74, 74));
            box-sizing: border-box;
            font: 400 13.3333px Arial;
            padding: 1px 6px;
            border-width: 2px;
            border-style: outset;
            border-color: -internal-light-dark-color(rgb(118, 118, 118), rgb(195, 195, 195));
            border-image: initial;
        }
    </style>
</head>

<body>
    <div class="registermain-row">
        <div class="registercontentwrapper">
            <div class="registertextbox">
                <h1 style="letter-spacing:-3px;word-spacing:2px;">Write your personal details</h1>

            </div>

            <div class="register-controller">

                <form id="personal-form" class="register-personal-form" action="" method="POST">
                    <div class="form-grp-1">
                        <div class="row-register-1">
                            <div class="form-col-1">
                                <label for="customer_name" style="color:darkgray;">Username</label>
                                <br>
                                <br>
                                <input type="text" name="customer_name" class="form-control-1 input" id="customer_name" placeholder="Enter Your Full Name">
                            </div>

                            <div class="form-col-1">

                            </div>
                        </div>
                    </div>

                    <div class="form-grp-1">
                        <div class="row-register-1">
                            <div class="form-col-1">
                                <label for="psw" style="color:darkgray;">Password</label>
                                <br>
                                <br>
                                <input type="password" name="psw" maxlength="12" class="form-control-1 input" id="psw" placeholder="Enter Password">
                            </div>

                            <div class="form-col-1">
                                <label for="confirm_psw" style="color:darkgray;">Re-enter Password</label>
                                <br>
                                <br>
                                <input type="password" name="confirm_psw" maxlength="12" class="form-control-1 input" id="confirm_psw" placeholder="Enter Password">
                            </div>

                        </div>
                    </div>

                    <div class="form-grp-1">
                        <div class="row-register-1">
                            <div class="form-col-1">
                                <label for="phone" style="color:darkgray;">Telephone</label>
                                <br>
                                <br>
                                <input type="tel" name="phone" class="form-control-1 input" id="phone" placeholder="e.g 0123456789">
                            </div>

                        </div>
                    </div>
                    <a href="login.php" style="background-color:#ccc;border:2px solid yellow;padding:10px;text-decoration:none;margin:25px;">Cancel</a>
                    <input type="submit" name="submit" class="submit-btn register-submit-btn" value="Sign Up"><br>

                </form>
            </div>
        </div>
    </div>


</body>

</html>