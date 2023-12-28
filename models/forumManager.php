<?php
require_once './config/database.php';

class ForumManager
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->dbConnect();
    }

    public function getPosts()
    {
        $stmt = $this->db->prepare("SELECT POST.id, POST.title, POST.content, POST.postDate, USERS.username 
                                FROM POST 
                                INNER JOIN USERS ON POST.userId = USERS.id 
                                ORDER BY POST.postDate DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPost($title, $content, $userId)
    {
        $stmt = $this->db->prepare("INSERT INTO POST (title, content, postDate, userId) VALUES (:title, :content, NOW(), :userId)");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deletePost($postId)
    {
        $this->db->beginTransaction();

        try {
            $stmt = $this->db->prepare("DELETE FROM POST WHERE id = :postId");
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $this->db->prepare("DELETE FROM LIKES WHERE postId = :postId");
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $this->db->prepare("DELETE FROM PARTICIPATION WHERE postId = :postId");
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $this->db->prepare("DELETE FROM COMMENT WHERE postId = :postId");
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $stmt->execute();

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getCommentsByPost($postId)
    {
        $stmt = $this->db->prepare("SELECT COMMENT.id, COMMENT.content, COMMENT.commentDate, COMMENT.postId, COMMENT.userID, USERS.username
                                FROM COMMENT 
                                INNER JOIN USERS ON COMMENT.userId= USERS.id  
                                WHERE postId = :postId");
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComment($postId, $userId, $content)
    {
        $stmt = $this->db->prepare("INSERT INTO COMMENT (content, commentDate, postId, userId) VALUES (:content, NOW(), :postId, :userId)");
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteComment($commentId)
    {
        $stmt = $this->db->prepare("DELETE FROM COMMENT WHERE id = :commentId");
        $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function likePost($postId, $userId)
    {
        $stmt = $this->db->prepare("INSERT INTO LIKES (postId, userId) VALUES (:postId, :userId)");
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function unlikePost($postId, $userId)
    {
        $stmt = $this->db->prepare("DELETE FROM LIKES WHERE postId = :postId AND userId = :userId");
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getLikesByPost($postId)
    {
        $stmt = $this->db->prepare("SELECT LIKES.id, LIKES.postId, LIKES.userId, USERS.username 
                                FROM LIKES 
                                INNER JOIN USERS ON LIKES.userId= USERS.id 
                                WHERE postId = :postId");
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hasUserLikedPost($postId, $userId): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM LIKES WHERE postId = ? AND userId = ?");
        $stmt->execute([$postId, $userId]);
        return $stmt->fetchColumn() > 0;
    }

    public function participateInPost($postId, $userId)
    {
        $stmt = $this->db->prepare("INSERT INTO PARTICIPATION (postId, userId) VALUES (:postId, :userId)");
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function cancelParticipation($postId, $userId)
    {
        $stmt = $this->db->prepare("DELETE FROM PARTICIPATION WHERE postId = :postId AND userId = :userId");
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getParticipationsByPost($postId)
    {
        $stmt = $this->db->prepare("SELECT PARTICIPATION.id, PARTICIPATION.postId, PARTICIPATION.userId, USERS.username 
                                FROM PARTICIPATION 
                                INNER JOIN USERS ON PARTICIPATION.userId= USERS.id 
                                WHERE postId = :postId");
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hasUserParticipatedInPost($postId, $userId): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM PARTICIPATION WHERE postId = ? AND userId = ?");
        $stmt->execute([$postId, $userId]);
        return $stmt->fetchColumn() > 0;
    }
}
