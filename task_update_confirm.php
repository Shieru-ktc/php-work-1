<?php
$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';

if ($id === '' || $name === '') {
    exit('入力が不足しています。');
}
?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>更新確認</title>
</head>

<body>
    <h1>更新内容の確認</h1>
    <p>タスクID: <?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?></p>
    <p>タスク名: <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></p>
    <p>説明: <?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></p>

    <form method="post" action="task_update_execute.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>">
        <input type="hidden" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">
        <input type="hidden" name="description" value="<?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?>">
        <button type="submit">この内容で更新する</button>
        <button type="button" onclick="history.back()">修正する</button>
    </form>
</body>

</html>