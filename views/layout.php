<?php global $content; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Projet Tiny House</title>
    <link rel="stylesheet" href="./styles/navbar.css">
    <link rel="stylesheet" href="./styles/footer.css">
    <link rel="stylesheet" href="./styles/home.css">
</head>
<body>
<?php include 'partials/_header.php'; ?>

<main>
    <?php echo $content; ?>
</main>

<?php include_once 'partials/_footer.php'; ?>
</body>
</html>
