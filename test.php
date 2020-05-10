<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
TEST
<?php
echo '<h1>'.password_hash('amaramar', PASSWORD_DEFAULT).'</h1>';
if(password_verify ( 'amaramar' , '$2y$10$hTcQ4qzY1JwQvgJUi8p9iuIfXeEKnpFA6Ff4BIzzRgv/mmj3lKk.C' ))
    echo 'TAČNO'
?>
</body>
</html>
