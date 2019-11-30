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
<h2>Let's go shopping!</h2>

</body>
</html>
