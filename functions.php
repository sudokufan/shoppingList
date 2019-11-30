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
 * sanitised new item user input
 *
 * @param array $newItem item input by user
 *
 * @return array $newItem user-entered item now sanitised for safety
 */
function sanitiseInput(array $newItem): array
{
    $newItem['name'] = preg_replace('/[^\w]/i', ' ', $newItem['name']);
    $newItem['name'] = preg_replace('/\s{2,}/', '', $newItem['name']);

    $sanitisedItem = $newItem;
    return $sanitisedItem;
}


/**
 * checks item input is valid
 *
 * @param array $sanitisedItem new sanitised item from user form
 *
 * @return bool $result bool showing validation true/false
 */
function checkValidInput(array $sanitisedItem): bool
{
    $valid = '';
    if (is_string($sanitisedItem['name']) === false) {
        $valid = false;
    } elseif (strlen($sanitisedItem['name']) > 255) {
        $valid = false;
    } elseif (strlen($sanitisedItem['name']) < 1) {
        $valid = false;
    } else {
        $valid = true;
    }
        return $valid;
}


/**
 * adds new item to shopping list database
 *
 * @param array $sanitisedItem new item being added
 *
 * @param $db PDO connection to database
 *
 * @return bool $results shows if add was successful
 */
function addNewItem($sanitisedItem, $db): bool
{
    $sanitisedItem = implode($sanitisedItem);
    $query = $db->prepare('INSERT INTO `items` (`name`) VALUES (:name);');
    $query->bindParam(':name', $sanitisedItem);
    $results = $query->execute();
    return $results;
}