<?php
require_once 'functions.php';

$message = '';
$messageType = '';
$id = $_GET['id'] ?? null;
$post = $id ? getPost($id) : null;

if (!$post) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (empty($title) || empty($content)) {
        $message = 'Please fill in all fields';
        $messageType = 'error';
    } else {
        if (updatePost($id, $title, $content)) {
            header("Location: view_post.php?id=$id");
            exit;
        } else {
            $message = 'Error updating post';
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
    <title>Edit Post - TechJourn</title>
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
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="edit_post.php?id=<?php echo $id; ?>">
            <h2 class="form-title">Edit Post</h2>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>

            <div class="post-actions">
                <div class="post-actions-left">
                    <button type="submit" class="button">Update Post</button>
                    <a href="view_post.php?id=<?php echo $id; ?>" class="button">Cancel</a>
                </div>
                <div class="post-actions-right">
                    <a href="delete_post.php?id=<?php echo $id; ?>" class="button delete" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                </div>
            </div>
        </form>
    </main>
</body>
</html>