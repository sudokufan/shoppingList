<?php

require_once('functions.php');

$db = connectDB();

$newItem = $_POST;

$errorCheck = addNewItem($newItem, $db);

if ($errorCheck === false) {
    header('Location: index.php?error=wrongUser');
} else {
    header('Location: index.php?success=itemAdded');
}