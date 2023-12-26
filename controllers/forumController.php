<?php
require_once './models/forumManager.php';
require_once './models/rolesManager.php';
require_once './config/database.php';

$forumManager = new ForumManager();
$rolesManager = new RolesManager();

$userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$userRole = $userId ? $rolesManager->getRole($userId)['name'] : null;

$posts = $forumManager->getPosts();
$commentsByPost = [];
$likesByPost = [];
$participationsByPost = [];
$userLikedPosts = [];
$userParticipatedPosts = [];

foreach ($posts as $post) {
    $commentsByPost[$post['id']] = $forumManager->getCommentsByPost($post['id']);
    $likesByPost[$post['id']] = $forumManager->getLikesByPost($post['id']);
    $participationsByPost[$post['id']] = $forumManager->getParticipationsByPost($post['id']);
    $userLikedPosts[$post['id']] = $forumManager->hasUserLikedPost($post['id'], $userId);
    $userParticipatedPosts[$post['id']] = $forumManager->hasUserParticipatedInPost($post['id'], $userId);
}

if ($userRole) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addComment'])) {
        $forumManager->addComment($_POST['postId'], $userId, $_POST['content']);
        header("Location: index.php?page=forum");
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['likePost'])) {
        if (!array_key_exists($userId, $likesByPost[$_POST['postId']])) {
            $forumManager->likePost($_POST['postId'], $userId);
        }
        header("Location: index.php?page=forum");
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['participatePost'])) {
        if (!array_key_exists($userId, $participationsByPost[$_POST['postId']])) {
            $forumManager->participateInPost($_POST['postId'], $userId);
        }
        header("Location: index.php?page=forum");
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['deleteComment'])) {
        $forumManager->deleteComment($_GET['commentId']);
        header("Location: index.php?page=forum");
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['unlikePost'])) {
        $forumManager->unlikePost($_POST['postId'], $userId);
        header("Location: index.php?page=forum");
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancelParticipation'])) {
        $forumManager->cancelParticipation($_POST['postId'], $userId);
        header("Location: index.php?page=forum");
        exit;
    }
}

if ($userRole === 'modo' || $userRole === 'admin') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createPost'])) {
        $forumManager->createPost($_POST['title'], $_POST['content'], $userId);
        header("Location: index.php?page=forum");
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['deletePost'])) {
        $forumManager->deletePost($_GET['postId']);
        header("Location: index.php?page=forum");
        exit;
    }
}

ob_start();
include './views/pages/forum.php';
$content = ob_get_clean();

include './views/layout.php';