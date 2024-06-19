<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My Bolt Framework' ?></title>
</head>
<body>
    <header>
        <h1><?= $title ?? 'Welcome to My Bolt Framework' ?></h1>
    </header>
    <main>
        <?php include __DIR__ . "/$view.php"; ?>
    </main>
</body>
</html>
