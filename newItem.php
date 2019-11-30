<?php

require_once('functions.php');

$db = connectDB();

$newItem = $_POST;

addNewItem($newItem, $db);