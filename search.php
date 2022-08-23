<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itfood";
include_once 'functions.php';

?>
<?= template_header("Search | IT FOOD") ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<style>
    .container {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    form {
        outline: 0;
        float: left;
        -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        -webkit-border-radius: 4px;
        border-radius: 4px;
        margin-top: 50px;
    }

    form>.textbox {
        outline: 0;
        height: 42px;
        width: 700px;
        line-height: 42px;
        padding: 0 16px;
        background-color: rgba(255, 255, 255, 0.8);
        color: #212121;
        border: 0;
        float: left;
        -webkit-border-radius: 4px 0 0 4px;
        border-radius: 4px 0 0 4px;
    }

    form>.textbox:focus {
        outline: 0;
        background-color: black;
        color: white;
    }

    form>.button {
        outline: 0;
        background: none;
        background-color: rgba(38, 50, 56, 0.8);
        float: left;
        height: 42px;
        width: 42px;
        text-align: center;
        line-height: 42px;
        border: 0;
        color: #FFF;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: 16px;
        text-rendering: auto;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
        -webkit-transition: background-color .4s ease;
        transition: background-color .4s ease;
        -webkit-border-radius: 0 4px 4px 0;
        border-radius: 0 4px 4px 0;
    }

    form>.button:hover {
        background-color: rgba(0, 150, 136, 0.8);
        cursor: pointer;
    }
</style>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>


<div class="row align-items-center">
    <div class="container">
        <form action="" method="POST">
            <input type="text" name="inputtext" class="textbox" />
            <button type="submit" name="search" class="button"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<?php
if (isset($_POST["search"])) {
    $to_find = $_POST["inputtext"];
    $sql = "select * from fooditems where name like '%$to_find%'";
} else {
    $sql = "SELECT * FROM fooditems ORDER BY store_id DESC";
}
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->error) {
    echo 'Connection Errors: ' . $conn->error;
} else {
    $product = $conn->query($sql);
    echo " <div class='fooditems content-wrapper' style='width:auto;height:auto;margin:50px;'>";
    echo "<div class='fooditems-wrapper' style='padding:20px;'>";
    while ($row = $product->fetch_assoc()) {
        echo "<a href='index.php?page=product&id=" . $row["id"] . "' class='product' >";
        echo '<img src=" images/' . $row['img'] . '"' . " alt=" . $row["name"] . ' style="width:300px;height:300px;margin:5px;">';
        echo "<span class='name' style='margin-left:15px;'>" . $row["name"] . "</span>";
        echo "<span class='price' style='margin-left:15px;'>";
        echo "RM " . $row["price"];
        echo "</span>";
        echo "</a>";
    }
}
echo "</div>";
?>

</div>