<?php

require __DIR__ . "/../boot.php";

$id = $_REQUEST["id"];

$db->query("DELETE FROM courses WHERE id=:id", ["id" => $id]);

redirect("/courses");
