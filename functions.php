<?php

/**
 * connects PHP to SQL database
 *
 * @return PDO database connection as $db
 */
function connectDB(): PDO
{
    $db = new PDO('mysql:host=db; dbname=shoppingList', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}


/**
 * retrieves shopping list from the database
 *
 * @param PDO $db the PDO connection to database
 *
 * @return array of shopping list items
 */
function getShoppingList(PDO $db): array
{
    $query = $db->prepare("SELECT `name` FROM `items`");
    $query->execute();
    $items = $query->fetchAll();
    return $items;
}


/**
 * displays shopping list items on front end
 *
 * @param array $items indexed array of assoc arrays of items
 *
 * @return string div containing display code for front-end
 */
function displayShoppingList(array $items): string
{
    $result = '';

    if (array_key_exists("name", $items[0])) {
        foreach ($items as $item) {
            $result .= '<div>
                    <ul>' . $item['name'] . '</ul>
                    </div>';
        }
    } else {
        return 'Incorrect SQL data; please contact administrator';
    }
    return $result;
}


/**
 * checks item input is valid
 *
 * @param array $newItem new item sent from user form
 *
 * @return bool shows if input is valid
 */
function checkUserInput(array $newItem): bool
{
    $valid = "";

    if (is_string($newItem['name']) === false) {
        $valid = false;
    } elseif (strlen($newItem['name']) > 255) {
        $valid = false;
    } elseif (strlen($newItem['name']) < 1) {
        $valid = false;
    } else {
        $valid = true;
    }
    return $valid;
}


/**
 * adds new item to shopping list database
 *
 * @param array $newItem new item being added
 *
 * @param $db PDO connection to database
 *
 * @return bool $results shows if add was successful
 */
function addNewItem($newItem, $db)
{
    $newItem = implode($newItem);
    $query = $db->prepare('INSERT INTO `items` (`name`) VALUES (:name);');
    $query->bindParam(':name', $newItem);
    $results = $query->execute();
    return $results;
}