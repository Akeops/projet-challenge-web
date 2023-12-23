<?php global $content; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Projet Tiny House</title>
    <link rel="icon" href="./img/flavicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/navbar.css">
    <link rel="stylesheet" href="./styles/footer.css">
    <link rel="stylesheet" href="./styles/home.css">
    <link rel="stylesheet" href="./styles/profile.css">
</head>
<body>
<?php include './views/partials/_header.php'; ?>

<main>
    <?php echo $content; ?>
</main>

<?php include_once './views/partials/_footer.php'; ?>
</body>
</html>
