<?php
require 'pdo_connect.php';

// SQL組み立て（プリペアステートメント作成）
$sql = "SELECT * FROM tasks";
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
  <style>
    :root {
      --bg: #f5f6fb;
      --card: #ffffff;
      --primary: #2d6cdf;
      --text: #111827;
      --muted: #6b7280;
      --border: #e5e7eb;
      --danger: #dc2626;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: "Inter", "Noto Sans JP", system-ui, -apple-system, sans-serif;
      background: radial-gradient(circle at 20% 20%, #eef2ff 0, rgba(238, 242, 255, 0) 35%),
        radial-gradient(circle at 80% 0%, #e0f2fe 0, rgba(224, 242, 254, 0) 30%),
        var(--bg);
      color: var(--text);
      min-height: 100vh;
    }

    .wrap {
      max-width: 1080px;
      margin: 0 auto;
      padding: 32px 18px 48px;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    h1 {
      margin: 0;
      font-size: 24px;
      letter-spacing: 0.01em;
    }

    .muted {
      color: var(--muted);
      font-size: 13px;
      margin-top: 4px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 10px 14px;
      border-radius: 8px;
      font-weight: 700;
      font-size: 14px;
      text-decoration: none;
      transition: transform 0.05s ease, box-shadow 0.15s ease;
      border: none;
      cursor: pointer;
    }

    .btn-primary {
      background: var(--primary);
      color: #fff;
      box-shadow: 0 10px 20px rgba(45, 108, 223, 0.25);
    }

    .btn-outline {
      background: #eef2ff;
      color: var(--primary);
      border: 1px solid #dbeafe;
    }

    .btn-danger {
      background: #fee2e2;
      color: var(--danger);
      border: 1px solid #fecaca;
    }

    .btn:hover {
      transform: translateY(-1px);
    }

    .btn:active {
      transform: translateY(0);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05);
    }

    thead {
      background: #f9fafb;
    }

    th,
    td {
      padding: 12px 14px;
      text-align: left;
      border-bottom: 1px solid var(--border);
      font-size: 14px;
    }

    tr:last-child td {
      border-bottom: none;
    }

    th {
      color: var(--muted);
      font-weight: 700;
      letter-spacing: 0.01em;
    }

    tbody tr:hover {
      background: #f8fafc;
    }

    .actions {
      display: flex;
      gap: 8px;
      align-items: center;
    }

    .empty {
      margin-top: 20px;
      color: var(--muted);
    }
  </style>
</head>

<body>

  <div class="wrap">
    <header>
      <div>
        <h1>タスク一覧</h1>
        <div class="muted">tasksテーブルに登録されたタスクを表示します</div>
      </div>
      <a class="btn btn-primary" href="task_create_form.php">＋ 新規作成</a>
    </header>

    <?php if ($results): ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>作成日時</th>
            <th>タスク名</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>

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
                <div class="actions">
                  <a class="btn btn-outline" href="task_edit_form.php?id=<?= urlencode($row['id']) ?>">変更</a>
                  <form method="post" action="task_delete.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <button class="btn btn-danger" type="submit">削除</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    <?php else: ?>
      <p class="empty">タスクが見つかりませんでした。</p>
    <?php endif; ?>
  </div>

</body>

</html>