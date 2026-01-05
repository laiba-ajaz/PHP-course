<?php
 include "../controller/profile_controller.php";
 
 //redirecct if not logged in 
  if(!isset($_SESSION['user_id'])){
     header("Location: login.php");
      exit;
    }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f9;
            font-weight: 500;
            font-size: 14px;

        }

        .navbar {
            background: linear-gradient(120deg, #6a11cb, #2575fc);
            color: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            text-decoration: none;
            color: #fff;
            font-weight: 700;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            background: #fff;
            padding: 15px 20px;
            border-radius: 12px;
            margin-top: 20px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }


        .info h2 {
            margin-top: 10px;
            font-weight: 700;
            font-size: 30px;
        }

        .info p {
            font-size: 17px;
        }

        .posts-section h3 {
            margin-bottom: 15px;
            font-weight: 700;
            font-size: 24px;
        }

        .post-card h4 {
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 16px;
        }

        .post-card .content {
            color: #555;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .post-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            font-weight: 500;
        }

        .no-post {
            padding: 10px;
            color: #666;
            font-weight: 500;
            font-size: 14px;
        }

        .profile-pic-wrapper {
            position: relative;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #2575fc;
        }

        .profile-pic-wrapper img {
            width: calc(100% + 10px);
            height: calc(100% + 10px);
            object-fit: cover;
            display: block;
            border-radius: 50%;
            margin: -5px;
        }

        .camera-icon {
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: 0.3s ease-in-out;
        }

        .profile-pic-wrapper:hover .camera-icon {
            opacity: 1;
        }

        #profileInput {
            display: none;
        }

        .posts-section {
            margin-top: 20px;
            padding: 15px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
        }

        .post-card {
            border: 1px solid #eee;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 12px;
            transition: .2s;
            position: relative;
        }

        .post-card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, .1);
            transform: translateY(-2px);
        }

        .dropdown {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div><a href="main.php">← Dashboard</a></div>
        <div><a href="#" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#logoutModal">
                Logout
            </a>
        </div>
    </div>

    <div class="container">
        <div class="profile-header">
            <div class="profile-pic-wrapper">
                <img src="../upload/<?= !empty($profilePic) ? $profilePic : 'default.jpg' ?>" alt="profile_pic">
                <!-- Camera Overlay -->
                <form action="../controller/profile_controller.php" method="POST" enctype="multipart/form-data"
                    class="upload-form"> <label for="profileInput" class="camera-icon">📷</label> <input type="file"
                        name="profile_pic" id="profileInput">
                 </form>
            </div>
            <div class="info">
                <h2>
                    <?= $_SESSION['username']?>
                </h2>
                <p>Total Posts:
                    <?= $postCount ?>
                </p>
            </div>
        </div>
    </div>


    <!-- User Posts Section -->
    <div class="posts-section">

        <h3>Your Posts</h3>

        <?php if($user_post && $user_post->num_rows > 0){ ?>

        <?php while($post = $user_post->fetch_assoc()){ ?>

        <div class="post-card">
            <h4>
                <?= htmlspecialchars($post['title']) ?>
            </h4>

            <p class="content">
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>

            <div class="post-footer">
                <span>
                    <?= date("d M Y - h:i A", strtotime($post['created_at'])) ?>
                </span>


            </div>
            <div class="dropdown">
                <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    &#x22EE;
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="edit_post.php?id=<?= $post['post_id'] ?>"> Edit</a></li>
                    <li><a class="dropdown-item text-danger delete-btn" href="#"
                            data-id="<?= $post['post_id'] ?>">Delete</a></li>
                </ul>
            </div>

        </div>

        <?php } ?>

        <?php } else { ?>

        <p class="no-post">You haven't posted anything yet..</p>

        <?php } ?>

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
    <!-- Delete Confirmation Modal -->

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteForm" method="POST" action="../controller/post_controller.php">
                    <input type="hidden" name="post_id" id="deletePostInput">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this post? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('profileInput').addEventListener('change', function () {
            this.form.submit();
        });

        //modal js
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const postId = this.dataset.id;
                document.getElementById('deletePostInput').value = postId;
                deleteModal.show();
            });
        });

    </script>

</body>

</html>