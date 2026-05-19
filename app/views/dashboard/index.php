<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; margin: 0; background-color: #f4f4f9; }
        header { background: #333; color: white; padding: 1rem; display: flex; justify-content: space-between; align-items: center; }
        .container { padding: 2rem; }
        a.button { background: #dc3545; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px; }
        a.button:hover { background: #c82333; }
    </style>
</head>
<body>
    <header>
        <h1>Dashboard</h1>
        <?php 
            $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        ?>
        <a href="<?php echo $baseUrl; ?>/login/logout" class="button">Logout</a>
    </header>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($data['username']); ?>!</h2>
        <p>You have successfully logged in.</p>
    </div>
</body>
</html>