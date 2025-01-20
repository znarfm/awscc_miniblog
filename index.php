<?php
require_once 'functions.php';
$posts = loadPosts();
$search = isset($_GET['search']) ? $_GET['search'] : '';

if ($search) {
    $posts = searchPosts($search);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechJourn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
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

    <main class="container">
        <form class="search-form" method="GET" action="index.php">
            <div class="form-group">
                <input type="text" name="search" placeholder="Search posts..." value="<?php echo htmlspecialchars($search); ?>">
                <div class="search-buttons">
                    <button type="submit" class="button">Search</button>
                    <a href="index.php" class="button">Clear</a>
                </div>
            </div>
        </form>

        <hr class="themed-hr">

        <?php if (empty($posts)): ?>
            <p>No posts found.</p>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <article class="post">
                    <div class="post-content">
                        <a href="view_post.php?id=<?php echo $post['id']; ?>" class="post-title-link">
                            <h2 class="post-title"><?php echo $post['title']; ?></h2>
                        </a>
                        <div class="post-meta">
                            Posted on <?php echo $post['created_at']; ?>
                            <?php if (isset($post['updated_at'])): ?>
                                | Updated on <?php echo $post['updated_at']; ?>
                            <?php endif; ?>
                        </div>
                        <p><?php echo nl2br(substr($post['content'], 0, 200)) . '...'; ?></p>
                        <div class="post-actions">
                            <div class="post-actions-left">
                                <a href="view_post.php?id=<?php echo $post['id']; ?>" class="button">Read More</a>
                                <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="button">Edit</a>
                            </div>
                            <div class="post-actions-right">
                                <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="button delete" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>
</body>
</html>