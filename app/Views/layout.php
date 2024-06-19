<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My Bolt Framework' ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>
<header>
    <?php include __DIR__ . "/partials/header.php"; ?>
</header>
<main>
    <?php include __DIR__ . "/$view.php"; ?>
</main>
<footer>
    <?php include __DIR__ . "/partials/footer.php"; ?>
</footer>
<script src="/js/script.js"></script>
<script src="/js/home.js"></script>
</body>
</html>
