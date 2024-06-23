<?php

require_once "../boot.php";

$id = $_REQUEST["id"];

$db->query("DELETE FROM students WHERE id=:id", ["id" => $id]);

redirect("/students/index.php");
