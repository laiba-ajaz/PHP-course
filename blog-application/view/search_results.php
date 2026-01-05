<?php

if(!isset($_SESSION['user_id'])){
   header("Location: login.php");
   exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
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
            transition: 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .post-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }

        .post-header {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .post-header img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
            border: 1px solid #ddd;
        }

        .post-card h5 {
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .post-card p {
            font-size: 0.9rem;
            color: #555;
        }

        .time {
            font-size: 0.75rem;
            color: #888;
        }

        .no-results {
            text-align: center;
            font-size: 1rem;
            color: #666;
            margin-top: 50px;
        }
    </style>
</head>

<body>


    <div class="posts">
        <?php
         if($content && $content->num_rows > 0):
            while($row = $content->fetch_assoc()):
         ?>
        <div class="post-card p-2">
            <div class="post-header">
                <img src="../upload/<?= htmlspecialchars($row['profile_pic']) ?>" alt="Profile Pic">
                <div>
                    <h6 class="mb-0 fw-bold">
                        <?= htmlspecialchars($row['user_name']) ?>
                    </h6>
                </div>
            </div>

            <div class="p-3">
                <h5 class="fw-bold">
                    <?= htmlspecialchars($row['title']) ?>
                </h5>
                <p>
                    <?= nl2br(htmlspecialchars($row['content'])) ?>
                </p>
            </div>
        </div>
        <?php
    endwhile;
else:
?>
        <p class="no-results">No results found for '<strong>
                <?= htmlspecialchars($_GET['search'] ?? '') ?>
            </strong>'</p>
        <?php
endif;
?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>