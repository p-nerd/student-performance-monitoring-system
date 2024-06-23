<?php

require_once "../boot.php";

$id = $_REQUEST["id"];

$db->query("DELETE FROM courses WHERE id=:id", ["id" => $id]);

redirect("/courses/index.php");
