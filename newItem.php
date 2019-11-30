<?php

require_once('functions.php');

$db = connectDB();

$newItem = $_POST;

$validityCheck = checkUserInput($newItem);

if ($validityCheck === true) {

    $errorCheck = addNewItem($newItem, $db);

    if ($errorCheck === false) {
        header('Location: index.php?error=wrongUser');
    } else {
        header('Location: index.php?success=itemAdded');
    }
} else {
    header('Location: index.php?error=wrongUser');
}
