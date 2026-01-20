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
    <style>
        :root {
            --bg: #fef2f2;
            --card: #ffffff;
            --primary: #dc2626;
            --text: #111827;
            --muted: #6b7280;
            --border: #fecaca;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Inter", "Noto Sans JP", system-ui, -apple-system, sans-serif;
            background: linear-gradient(145deg, #fff1f2, #fef9c3);
            color: var(--text);
        }

        .page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 40px 16px;
        }

        .card {
            width: min(680px, 100%);
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 26px;
            box-shadow: 0 12px 30px rgba(220, 38, 38, 0.12);
        }

        h1 {
            margin: 0 0 10px;
            font-size: 24px;
            letter-spacing: 0.01em;
        }

        .muted {
            color: var(--muted);
            margin: 0 0 18px;
            font-size: 14px;
        }

        .danger-box {
            border: 1px solid var(--border);
            background: #fff7ed;
            border-radius: 10px;
            padding: 14px;
            margin-bottom: 16px;
        }

        .row {
            margin: 6px 0;
        }

        .label {
            color: var(--muted);
            font-size: 12px;
            letter-spacing: 0.02em;
        }

        .value {
            font-weight: 700;
            font-size: 15px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 12px;
        }

        .btn {
            appearance: none;
            border: none;
            border-radius: 8px;
            padding: 12px 18px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: transform 0.05s ease, box-shadow 0.15s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-danger {
            background: var(--primary);
            color: white;
            box-shadow: 0 10px 20px rgba(220, 38, 38, 0.25);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: var(--text);
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn:active {
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="card">
            <h1>削除確認</h1>
            <p class="muted">この操作は取り消せません。内容を確認してください。</p>
            <div class="danger-box">
                <div class="row">
                    <div class="label">タスクID</div>
                    <div class="value"><?= htmlspecialchars($task['id'], ENT_QUOTES, 'UTF-8') ?></div>
                </div>
                <div class="row">
                    <div class="label">タスク名</div>
                    <div class="value"><?= htmlspecialchars($task['name'], ENT_QUOTES, 'UTF-8') ?></div>
                </div>
            </div>

            <form method="post" action="task_delete_execute.php">
                <input type="hidden" name="id" value="<?= htmlspecialchars($task['id'], ENT_QUOTES, 'UTF-8') ?>">
                <div class="actions">
                    <button class="btn btn-danger" type="submit">本当に削除する</button>
                    <a class="btn btn-secondary" href="pdo_select_all.php">キャンセル</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>