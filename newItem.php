<?php

require_once('functions.php');

$db = connectDB();

$newItem = $_POST;

$sanitisedItem = sanitiseInput($newItem);

$valid = checkValidInput($sanitisedItem);

if ($valid === false) {
    header('Location: index.php?error=wrongUser');
} else {
    $errorCheck = addNewItem($sanitisedItem, $db);
    if ($errorCheck === false) {
        header('Location: index.php?error=wrongUser');
    } else {
        header('Location: index.php?success=itemAdded');
    }
}