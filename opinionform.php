<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Opinions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        fieldset {
            border: none;
            padding: 0;
        }
        legend {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #333;
        }
        input[type="text"], input[type="email"], textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
            margin-right: 10px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .opinions {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .opinion-entry {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }
        .opinion-entry:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset style="background-color: lightgreen">
            <legend>Give us your opinion about PHP</legend>
            Name: <input type="text" name="name"><br>
            Mail: <input type="email" name="mail"><br>
            Vos commentaires sur le site:<br>
            <textarea name="comment" rows="10" cols="40"></textarea><br>
            <input type="submit" name="action" value="Send">
            <input type="submit" name="action" value="Show">
        </fieldset>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            $file = 'opinions.txt';

            if ($action == 'Send') {
                $name = htmlspecialchars($_POST['name']);
                $mail = htmlspecialchars($_POST['mail']);
                $comment = htmlspecialchars($_POST['comment']);
                $date = date('Y-m-d H:i:s');

                $entry = "Date: $date\nName: $name\nMail: $mail\nComment: $comment\n\n";

                file_put_contents($file, $entry, FILE_APPEND);
                echo "<div class='opinions'>Your opinion has been recorded.</div>";
            } elseif ($action == 'Show') {
                echo "<div class='opinions'>";
                if (file_exists($file)) {
                    $opinions = file_get_contents($file);
                    echo nl2br($opinions);
                } else {
                    echo "No opinions recorded yet.";
                }
                echo "</div>";
            }
        } else {
            echo "<div class='opinions'>No action specified.</div>";
        }
    }
    ?>
</body>
</html>
