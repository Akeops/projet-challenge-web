<?php
echo "<div class='forum-page'>";
foreach ($posts as $post) {
    echo "<div class='post'>";
    echo "<div class='post-header'>";
    echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
    echo "<br>";
    echo "<p>" . htmlspecialchars($post['content']) . "</p>";
    echo "<br>";
    echo "<p>Date: " . htmlspecialchars($post['postDate']) . "</p>";
    echo "<p>Auteur: " . htmlspecialchars($post['username']) . "</p>";
    echo "</div>";

    foreach ($commentsByPost[$post['id']] as $comment) {
        echo "<div class='comment'>";
        echo "<p>" . htmlspecialchars($comment['content']) . '<br> <br> Posté par: ' . htmlspecialchars($comment['username']) . "</p>";
        if ($userId == $comment['id'] || $userRole === 'modo' || $userRole === 'admin') {
            echo "<a href='index.php?page=forum&deleteComment&commentId=" . $comment['id'] . "'>Supprimer</a>";
        }
        echo "</div>";
    }

    if ($userRole === 'modo' || $userRole === 'admin') {
        echo "<div class='likes-details'>";
        foreach ($likesByPost[$post['id']] as $like) {
            echo "<p>Like numéro: " . htmlspecialchars($like['id']) . ", Username: " . htmlspecialchars($like['username']) . "</p>";
            echo "<a href='index.php?page=forum&deleteLike&likeId=" . $like['id'] . "'>Supprimer Like</a>";
        }
        echo "</div>";

        echo "<div class='participations-details'>";
        foreach ($participationsByPost[$post['id']] as $participation) {
            echo "<p>Participation numéro: " . htmlspecialchars($participation['id']) . ", Username: " . htmlspecialchars($participation['username']) . "</p>";
            echo "<a href='index.php?page=forum&cancelParticipation&participationId=" . $participation['id'] . "'>Annuler Participation</a>";
        }
        echo "</div>";
    }

    echo "<br>";
    echo "<p>Likes: " . count($likesByPost[$post['id']]) . "</p>";
    echo "<p>Participations: " . count($participationsByPost[$post['id']]) . "</p>";

    if ($userId) {
        echo "<form method='post' action='index.php?page=forum'>";
        echo "<input type='hidden' name='postId' value='" . $post['id'] . "'>";
        echo "<textarea name='content' placeholder='Votre commentaire'></textarea>";
        echo "<button type='submit' name='addComment'>Commenter</button>";
        echo "</form>";

        if (!$userLikedPosts[$post['id']]) {
            echo "<form method='post' action='index.php?page=forum'>";
            echo "<input type='hidden' name='postId' value='" . $post['id'] . "'>";
            echo "<button type='submit' name='likePost'>Like</button>";
            echo "</form>";
        } else {
            echo "<form method='post' action='index.php?page=forum'>";
            echo "<input type='hidden' name='postId' value='" . $post['id'] . "'>";
            echo "<button type='submit' name='unlikePost'>Unlike</button>";
            echo "</form>";
        }

        if (!$userParticipatedPosts[$post['id']]) {
            echo "<form method='post' action='index.php?page=forum'>";
            echo "<input type='hidden' name='postId' value='" . $post['id'] . "'>";
            echo "<button type='submit' name='participatePost'>Participer</button>";
            echo "</form>";
        } else {
            echo "<form method='post' action='index.php?page=forum'>";
            echo "<input type='hidden' name='postId' value='" . $post['id'] . "'>";
            echo "<button type='submit' name='cancelParticipation'>Annuler Participation</button>";
            echo "</form>";
        }
    }

    if ($userRole === 'modo' || $userRole === 'admin') {
        echo "<a href='index.php?page=forum&deletePost&postId=" . $post['id'] . "'>Supprimer le post</a>";
    }
    echo "</div>";
}

if ($userRole === 'modo' || $userRole === 'admin') {
    echo "<div class='create-post'>";
    echo "<form method='post' action='index.php?page=forum'>";
    echo "<input type='text' name='title' placeholder='Titre du post'>";
    echo "<textarea name='content' placeholder='Contenu du post'></textarea>";
    echo "<button type='submit' name='createPost'>Créer</button>";
    echo "</form>";
    echo "</div>";
}
echo "</div>";