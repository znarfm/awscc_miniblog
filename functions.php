<?php
date_default_timezone_set('Asia/Manila');

function loadPosts() {
    $file = 'data/posts.json';
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
        return [];
    }
    return json_decode(file_get_contents($file), true) ?? [];
}

function savePosts($posts) {
    $file = 'data/posts.json';
    file_put_contents($file, json_encode($posts, JSON_PRETTY_PRINT));
}

function addPost($title, $content) {
    $posts = loadPosts();
    $newPost = [
        'id' => time(), // Using timestamp as a simple unique ID
        'title' => htmlspecialchars($title),
        'content' => htmlspecialchars($content),
        'created_at' => date('Y-m-d H:i:s')
    ];
    array_unshift($posts, $newPost); // Add new post at the beginning
    savePosts($posts);
    return $newPost['id'];
}

function getPost($id) {
    $posts = loadPosts();
    foreach ($posts as $post) {
        if ($post['id'] == $id) {
            return $post;
        }
    }
    return null;
}

function updatePost($id, $title, $content) {
    $posts = loadPosts();
    foreach ($posts as &$post) {
        if ($post['id'] == $id) {
            $post['title'] = htmlspecialchars($title);
            $post['content'] = htmlspecialchars($content);
            $post['updated_at'] = date('Y-m-d H:i:s');
            savePosts($posts);
            return true;
        }
    }
    return false;
}

function deletePost($id) {
    $posts = loadPosts();
    foreach ($posts as $key => $post) {
        if ($post['id'] == $id) {
            array_splice($posts, $key, 1);
            savePosts($posts);
            return true;
        }
    }
    return false;
}

function searchPosts($keyword) {
    $posts = loadPosts();
    $results = [];
    $keyword = strtolower($keyword);
    
    foreach ($posts as $post) {
        if (strpos(strtolower($post['title']), $keyword) !== false || 
            strpos(strtolower($post['content']), $keyword) !== false) {
            $results[] = $post;
        }
    }
    return $results;
}