<?php
require_once 'functions.php';

$id = $_GET['id'] ?? null;
$post = $id ? getPost($id) : null;

if (!$post) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['title']; ?> - TechJourn</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="header">
        <div class="container header-content">
            <h1><a href="index.php" class="site-title">TechJourn</a></h1>
            <nav class="header-nav">
                <a href="add_post.php">Add New Post</a>
            </nav>
        </div>
    </header>

    <nav class="nav">
        <div class="container">
            <a href="index.php">Home</a>
            <a href="add_post.php">Add New Post</a>
        </div>
    </nav>

    <main class="container">
        <article class="post">
            <h2 class="post-title"><?php echo $post['title']; ?></h2>
            <div class="post-meta">
                Posted on <?php echo $post['created_at']; ?>
                <?php if (isset($post['updated_at'])): ?>
                    | Updated on <?php echo $post['updated_at']; ?>
                <?php endif; ?>
            </div>
            
            <div class="post-content">
                <?php echo nl2br($post['content']); ?>
            </div>

            <div class="post-actions">
                <div class="post-actions-left">
                    <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="button">Edit</a>
                    <a href="index.php" class="button">Back to Home</a>
                </div>
                <div class="post-actions-right">
                    <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="button delete" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                </div>
            </div>
        </article>
    </main>
</body>
</html>