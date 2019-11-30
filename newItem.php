<?php

require_once('functions.php');

$db = connectDB();

$newItem = $_POST;

$validItem = checkUserInput($newItem);

if ($validItem === false) {
    header('Location: index.php?error=wrongUser');
} else {
    $errorCheck = addNewItem($validItem, $db);
    if ($errorCheck === false) {
        header('Location: index.php?error=wrongUser');
    } else {
        header('Location: index.php?success=itemAdded');
    }
}