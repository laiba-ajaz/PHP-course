<?php
$path = __DIR__ . '/intro.txt';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>File Viewer</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 30px;


        }

        .container {
            background: #ffffff;
            width: 80%;
            max-width: 700px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        h1,
        h4 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .content {
            background: #dddee0ff;
            padding: 20px;
            border-radius: 8px;
            border-left: 5px solid #667eea;
            font-size: 15px;
            line-height: 1.6;
            white-space: pre-wrap;
            color: #444;
            max-height: 400px;
            overflow-y: auto;
        }

        .error {
            background: #ffe5e5;
            color: #b00020;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>📄 File Content</h1>
        <h4>(File Get Content Method)</h4>

        <?php
    if (!file_exists($path)) {
     echo "<div class='error'> Something went wrong. File not found.</div>";
    } else {
        $content = htmlspecialchars(file_get_contents($path));
        echo "<div class='content'>$content</div>";
    }
    ?>

    </div>

    <div class="container">
        <h1>📄 File Content</h1>
        <h4>(fread and fopen Method)</h4>

        <?php

    if (!file_exists($path)) {
        echo "<div class='error'> Something went wrong. File not found.</div>";
    } else {
        $file = fopen($path, "r");
        $contents = fread($file, filesize($path));
         fclose($file);

    echo "<div class='content'><pre>" . htmlspecialchars($contents) . "</pre></div>";
}
?>

    </div>





</body>

</html>