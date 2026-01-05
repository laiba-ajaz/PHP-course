<?php
$postFile = "post.txt";
$commentFile = "comment.txt";

$postContent = "";
$commentContent = "";

if (file_exists($postFile)) {
    $postContent = file_get_contents($postFile);
}

if (file_exists($commentFile)) {
    $commentContent = file_get_contents($commentFile);
}

if (isset($_POST['btn'])) {
    $text = trim($_POST['message']);
    if ($text !== "") {
        file_put_contents($postFile, $text);
        $postContent = $text;
    }
}

if (isset($_POST['commentBtn'])) {
    $info = trim($_POST['commentText']);
    if ($info !== "") {
        file_put_contents($commentFile, $info . PHP_EOL, FILE_APPEND);
        $commentContent = file_get_contents($commentFile);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5 d-flex flex-column align-items-center gap-4">

    <!-- POST FORM -->
    <div class="card w-100" style="max-width: 600px;">
        <div class="card-body">
            <form method="post" name="post">
                <div class="mb-3">
                    <textarea class="form-control" name="message" rows="4" placeholder="What's on your mind?"></textarea>
                </div>
                <button type="submit" name="btn" class="btn btn-primary w-100">Post</button>
            </form>
        </div>
    </div>

    <!-- POST CARD -->
    <?php if ($postContent !== ""): ?>
    <div class="card w-100" style="max-width: 600px;">
        <div class="card-body">
            <p class="card-text bg-light p-3 rounded"><?php echo htmlspecialchars($postContent); ?></p>

            <!-- COMMENT FORM -->
            <form class="d-flex flex-column gap-2 mt-3" method="post">
                <textarea class="form-control" name="commentText" rows="2" placeholder="Write a comment..."></textarea>
                <button type="submit" name="commentBtn" class="btn btn-secondary align-self-end">Comment</button>
            </form>

            <!-- SHOW COMMENT -->
            <?php if ($commentContent !== ""): ?>
                <div class="mt-3 p-2 bg-secondary bg-opacity-10 rounded">
                    <?php echo nl2br(htmlspecialchars($commentContent)); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
