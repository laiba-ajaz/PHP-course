<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "../model/likes.php";
include_once "../controller/post_controller.php";
include_once "../controller/comment_controller.php";

// Redirect if not logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$like_count = new like();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    body {
      background: #f4f6f9;
      font-family: Arial, sans-serif;
    }

    .posts {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
    }

    .post-card {
      background: #fff;
      border-radius: 15px;
      border: none;
      overflow: hidden;
      transition: 0.2s;
    }

    .post-header img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
      border: 1px solid #ddd;
    }

    .post_dropdown {
      position: absolute;
      top: 10px;
      right: 10px;
      z-index: 10;
    }

    .comment-section {
      background: #f8f9fa;
      padding: 10px;
      border-top: 1px solid #eee;
    }

    .comment-item {
      display: flex;
      gap: 10px;
      margin-bottom: 10px;
      align-items: flex-start;
      position: relative;
    }

    .comment-img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      object-fit: cover;
    }

    .comment-content {
      background: #eef0f2;
      border-radius: 12px;
      padding: 6px 12px;
      font-size: 0.85rem;
      max-width: 85%;
    }

    .comment-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .comment-user {
      font-weight: bold;
      display: block;
      font-size: 0.8rem;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg" style="background: linear-gradient(120deg,#6a11cb,#2575fc);">
    <div class="container-fluid">
      <span class="navbar-brand fw-bold text-white fs-5">My Blog App</span>
      <div class="d-flex align-items-center gap-2">
        <span class="px-3 py-1 rounded-pill text-white fw-bold" style="background:rgba(255,255,255,0.2);">
          👤
          <?= htmlspecialchars($_SESSION['username']) ?>
        </span>
        <a href="#" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>

      </div>
    </div>
  </nav>

  <div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center bg-white rounded p-4 mb-4 shadow-sm">
      <div>
        <h2 class="fw-bold mb-1">Welcome,
          <?= htmlspecialchars($_SESSION['username']) ?> 👋
        </h2>
        <p class="mb-0 text-muted">Share your thoughts with the world.</p>
      </div>
      <div class="d-flex gap-2">
        <a href="create-post.php" class="btn btn-primary">+ Create Post</a>
        <a href="profile.php" class="btn btn-success">My Profile</a>
      </div>
    </div>
    <!-- search bar -->
    <form class="d-flex justify-content-center my-3" method="GET" action="../controller/search_controller.php">
      <div class="input-group w-50">
        <input class="form-control" type="search" name="search" placeholder="Search...">
        <button class="btn btn-primary" type="submit">Search</button>
      </div>
    </form>
    <!-- all posts -->
    <h2 class="mb-3 fw-bold text-dark">All Posts</h2>

    <div class="posts">

      <?php while($row = mysqli_fetch_assoc($allpost)): 
    $likes = $like_count->likeCount($row['post_id']);
    $comments = $comment->allComment($row['post_id']);
  ?>

      <div class="card post-card shadow-sm position-relative">
        <!-- show dropdown to only logged-in user -->
        <?php if ($row["user_id"] === $_SESSION["user_id"]): ?>
        <div class="dropdown post_dropdown">
          <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown">
            <i class="bi bi-three-dots-vertical"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="edit_post.php?id=<?= $row['post_id'] ?>">Edit</a></li>
            <li><a href="#" class="dropdown-item text-danger delete-btn" data-id="<?= $row['post_id'] ?>">Delete</a>
            </li>
          </ul>
        </div>
        <?php endif; ?>
        <!-- post  -->
        <div class="d-flex align-items-center p-3 border-bottom post-header">
          <img src="../upload/<?= htmlspecialchars($row['profile_pic']) ?>">
          <div>
            <h6 class="mb-0 fw-bold">
              <?= htmlspecialchars($row['user_name']) ?>
            </h6>
            <small class="text-muted time" data-time="<?= $row['created_at'] ?>"></small>
          </div>
        </div>
        <div class="p-3">
          <h5 class="fw-bold">
            <?= htmlspecialchars($row['title']) ?>
          </h5>
          <p class="text-secondary small">
            <?= nl2br(htmlspecialchars($row['content'])) ?>
          </p>
        </div>

        <div class="px-3 pb-3 d-flex gap-2">

          <form method="POST" action="../controller/like_controller.php">
            <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>">
            <button class="btn btn-outline-primary post-action-btn">
              <i class="bi bi-hand-thumbs-up"></i>
              <?= $likes ?? 0 ?>
            </button>

            <button type="button" name="add" class="btn btn-outline-secondary post-action-btn" data-bs-toggle="collapse"
              data-bs-target="#comment-<?= $row['post_id'] ?>">
              <i class="bi bi-chat"></i> Comment
            </button>
          </form>

        </div>


        <div class="collapse comment-section" id="comment-<?= $row['post_id'] ?>">
          <!-- show comments -->
          <?php if($comments && $comments->num_rows > 0): ?>
          <?php while($comm = $comments->fetch_assoc()): ?>

          <div class="comment-item">

            <img src="../upload/<?= htmlspecialchars($comm['profile_pic']) ?>" class="comment-img">

            <div class="comment-content">

              <div class="comment-header">
                <span class="comment-user">
                  <?= htmlspecialchars($comm['user_name']) ?>
                </span>
                <!-- dropdown for comment's owner -->
                <?php if ($comm["user_id"] === $_SESSION["user_id"]): ?>
                <div class="dropdown">
                  <button class="btn btn-light btn-sm rounded-circle p-1" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="#" class="dropdown-item edit-comment-btn" data-id="<?= $comm['comment_id'] ?>">Edit</a>
                    </li>
                    <li><a href="#" class="dropdown-item text-danger delete-comment-btn"
                        data-id="<?= $comm['comment_id'] ?>">Delete</a>
                  </ul>
                </div>
                <?php endif; ?>
              </div>

              <div id="comment-text-<?= $comm['comment_id'] ?>">
                <?= nl2br(htmlspecialchars($comm['comment_text'])) ?>
              </div>

              <form class="edit-comment-form d-none mt-1" id="edit-form-<?= $comm['comment_id'] ?>" method="POST"
                action="../controller/comment_controller.php">
                <input type="hidden" name="comment_id" value="<?= $comm['comment_id'] ?>">
                <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>">
                <input type="text" name="comment_text" class="form-control form-control-sm"
                  value="<?= htmlspecialchars($comm['comment_text']) ?>" required>
                <div class="mt-1">
                  <button class="btn btn-sm btn-primary" name="update">Save</button>
                  <button type="button" class="btn btn-sm btn-secondary cancel-edit"
                    data-id="<?= $comm['comment_id'] ?>">Cancel</button>
                </div>
              </form>

            </div>

          </div>
          <?php endwhile; else: ?>
          <p class="text-muted small">No comments yet…</p>
          <?php endif; ?>
          <!-- comment form -->
          <form method="POST" action="../controller/comment_controller.php" class="d-flex gap-1 mt-2">
            <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>">
            <input type="text" name="comment_text" class="form-control form-control-sm" placeholder="Write a comment..."
              required>
            <button type="submit" class="btn btn-primary btn-sm" name="add_comment">
              <i class="bi bi-send-fill"></i>
            </button>

          </form>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>


  <!-- Logout Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to logout?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <!-- Logout form -->
          <form action="../controller/logout_controller.php" method="post">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Delete  Post Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="deleteForm" method="POST" action="../controller/post_controller.php">
          <input type="hidden" name="post_id" id="deletePostInput">
          <div class="modal-header">
            <h5 class="modal-title text-danger">Confirm Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">Are you sure you want to delete this post?</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Comment Modal -->
  <div class="modal fade" id="deleteCommentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="deleteCommentForm" method="POST" action="../controller/comment_controller.php">
          <input type="hidden" name="comment_id" id="deleteCommentInput">
          <div class="modal-header">
            <h5 class="modal-title text-danger">Delete Comment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this comment?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="delete_comment" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Time Ago
    function timeAgo(datetime) {
      const now = new Date();
      const time = new Date(datetime);
      const diff = Math.floor((now - time) / 1000);
      if (diff < 60) return 'just now';
      if (diff < 3600) return Math.floor(diff / 60) + ' minutes ago';
      if (diff < 86400) return Math.floor(diff / 3600) + ' hours ago';
      return Math.floor(diff / 86400) + ' days ago';
    }
    document.querySelectorAll('.time').forEach(span => {
      span.innerText = timeAgo(span.dataset.time);
      setInterval(() => { span.innerText = timeAgo(span.dataset.time); }, 60000);
    });

    // Delete Post Modal
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    document.querySelectorAll('.delete-btn').forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('deletePostInput').value = this.dataset.id;
        deleteModal.show();
      });
    });
    //delete comment Modal
    document.addEventListener('DOMContentLoaded', function () {

      const deleteCommentModal = new bootstrap.Modal(document.getElementById('deleteCommentModal'));

      document.querySelectorAll('.delete-comment-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
          e.preventDefault();
          const commentId = this.dataset.id;
          document.getElementById('deleteCommentInput').value = commentId;
          deleteCommentModal.show();
        });
      });
    });


    // Edit Comment
    document.querySelectorAll('.edit-comment-btn').forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        const id = this.dataset.id;
        document.getElementById('comment-text-' + id).classList.add('d-none');
        document.getElementById('edit-form-' + id).classList.remove('d-none');
      });
    });

    // Cancel Edit
    document.querySelectorAll('.cancel-edit').forEach(btn => {
      btn.addEventListener('click', function () {
        const id = this.dataset.id;
        document.getElementById('comment-text-' + id).classList.remove('d-none');
        document.getElementById('edit-form-' + id).classList.add('d-none');
      });
    });
  </script>
</body>

</html>