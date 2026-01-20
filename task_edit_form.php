<?php
require 'pdo_connect.php';

$id = $_GET['id'] ?? '';

if ($id === '') {
    exit('IDが指定されていません。');
}

// レコードを1件取得
$sql = "SELECT * FROM tasks WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->execute([$id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    exit('該当するタスクが見つかりません。');
}
?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>タスク更新</title>
</head>

<body>
    <h1>タスク更新フォーム</h1>
    <form method="post" action="task_update_confirm.php">
        <div>
            ID（変更不可）：
            <strong><?= htmlspecialchars($task['id'], ENT_QUOTES, 'UTF-8') ?></strong>
            <input type="hidden" name="id" value="<?= htmlspecialchars($task['id'], ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <br>
        <div>
            <label>タスク名
                <input name="name" required value="<?= htmlspecialchars($task['name'], ENT_QUOTES, 'UTF-8') ?>">
            </label>
        </div>
        <br>
        <div>
            <label>説明
                <textarea name="description"><?= htmlspecialchars($task['description'], ENT_QUOTES, 'UTF-8') ?></textarea>
            </label>
        </div>
        <br>
        <button type="submit">更新内容を確認する</button>
    </form>
    <br>
    <a href="pdo_select_all.php">戻る</a>
</body>

</html>