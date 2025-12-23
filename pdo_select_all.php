<?php
Require 'pdo_connect.php';

// SQL組み立て（プリペアステートメント作成）
$sql ="SELECT * FROM tasks";
$prepare = $con->prepare($sql);

// SQL実行
$prepare->execute(); //SQL文を実行
$results = $prepare->fetchAll(PDO::FETCH_ASSOC); //実行結果を$resultsに代入
?>

<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>タスク一覧</title>
</head>
<body>
 
<h2>tasksテーブル一覧</h2>
 
<!-- 新規作成ボタン -->
<p>
<a href="task_create_form.php">新規作成</a>
</p>
 
<?php if ($results): ?>
<table border="1" cellspacing="0" cellpadding="6">
<tr>
<th>ID</th>
<th>作成日時</th>
<th>タスク名</th>
<th>操作</th>
</tr>
 
    <?php foreach ($results as $row): ?>
<?php
        $task_id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
        $task_name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
        $task_created_at = htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8');
      ?>
<tr>
<td><?= $task_id ?></td>
<td><?= $task_created_at ?></td>
<td><?= $task_name ?></td>
<td>
<!-- 変更ボタン -->
<a href="task_edit_form.php?id=<?= urlencode($row['id']) ?>">変更</a>
 
          <!-- 削除ボタン（GET削除は危険なのでPOST推奨） -->
<form method="post" action="task_delete.php" style="display:inline;">
  <input type="hidden" name="id" value="<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>">
  <button type="submit">削除</button>
</form>
</td>
</tr>
<?php endforeach; ?>
 
  </table>
<?php else: ?>
<p>タスクが見つかりませんでした。</p>
<?php endif; ?>
 
</body>
</html>
