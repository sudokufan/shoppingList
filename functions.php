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

    foreach ($items as $item) {
        $result .= '<div>
                    <h3>' . $item['name'] . '</h3>
                    </div>';
    }
    return $result;
}