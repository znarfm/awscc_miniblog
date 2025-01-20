<?php
require_once 'functions.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (empty($title) || empty($content)) {
        $message = 'Please fill in all fields';
        $messageType = 'error';
    } else {
        $id = addPost($title, $content);
        if ($id) {
            header("Location: view_post.php?id=$id");
            exit;
        } else {
            $message = 'Error adding post';
            $messageType = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post - TechJourn</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="header">
        <div class="container header-content">
            <h1><a href="index.php" class="site-title">TechJourn</a></h1>
        </div>
    </header>

    <nav class="nav">
        <div class="container">
            <a href="index.php">Home</a>
            <a href="add_post.php">Add New Post</a>
        </div>
    </nav>

    <main class="container">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="add_post.php">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" required></textarea>
            </div>

            <div class="post-actions">
                <div class="post-actions-left">
                    <button type="submit" class="button">Add Post</button>
                    <a href="index.php" class="button">Cancel</a>
                </div>
            </div>
        </form>
    </main>
</body>
</html>