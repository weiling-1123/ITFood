<?php 
  $host = 'localhost';
  $data = 'itfood';
  $user = 'root';
  $pass =  '';
  $attr = "mysql:host=$host;dbname=$data;";
  $tbl_name = 'customer';
  $opts =
  [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
?> 