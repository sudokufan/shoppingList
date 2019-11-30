<?php

require_once('functions.php');

$db = connectDB();

$items = getShoppingList($db);

?>

<html lang="en-GB">
<head>
    <link rel="stylesheet" type="text/css" href="normalize.css"/>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maydinner</title>
</head>

<body>
<h1>Maydinner</h1>
<h2 class="header">Let's go shopping!</h2>

<div>
    <?php echo displayShoppingList($items); ?>
</div>

<form method="post" action="newItem.php">
    <p>Add new item:</p>
    <input type="text" name="item" placeholder="eg: Bananas" required">
    <input type="submit">
</form>

</body>
</html>
