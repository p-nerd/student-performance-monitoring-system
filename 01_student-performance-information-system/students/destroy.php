<?php

require_once "../views/layouts/header.php";


$id = $_REQUEST["id"];

$db->query("DELETE FROM students WHERE id=:id", ["id" => $id]);

redirect("/students/index.php");
