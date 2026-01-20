<?php
require 'pdo_connect.php';

// デバッグ用
// echo '<pre>';
// var_dump($_GET);
// var_dump($_POST);
// echo '</pre>';
// exit; 
//

$id = $_POST['id'] ?? '';

if ($id === '') {
    exit('IDが指定されていません。');
}

// 念のため、本当に存在するタスクか確認（1件取得）
$sql = "SELECT * FROM tasks WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->execute([$id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    exit('タスクが見つかりませんでした。');
}
?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>削除確認</title>
</head>

<body>
    <h1>削除確認</h1>
    <p>以下のタスクを削除します。よろしいですか？</p>
    <p>タスクID: <strong><?= htmlspecialchars($task['id'], ENT_QUOTES, 'UTF-8') ?></strong></p>
    <p>タスク名: <strong><?= htmlspecialchars($task['name'], ENT_QUOTES, 'UTF-8') ?></strong></p>

    <form method="post" action="task_delete_execute.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($task['id'], ENT_QUOTES, 'UTF-8') ?>">
        <button type="submit">本当に削除する</button>
        <a href="pdo_select_all.php"><button type="button">キャンセル</button></a>
    </form>
</body>

</html>