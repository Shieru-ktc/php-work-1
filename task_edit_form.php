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
    <style>
        :root {
            --bg: #f7f8fb;
            --card: #ffffff;
            --primary: #2d6cdf;
            --text: #111827;
            --muted: #6b7280;
            --border: #e5e7eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Inter", "Noto Sans JP", system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 40px 16px;
        }

        .card {
            width: min(760px, 100%);
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
        }

        h1 {
            margin: 0 0 10px;
            font-size: 24px;
            letter-spacing: 0.01em;
        }

        .muted {
            color: var(--muted);
            margin: 0 0 20px;
            font-size: 14px;
        }

        form {
            display: grid;
            gap: 16px;
        }

        label {
            display: block;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .static {
            font-weight: 700;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            background: #fdfefe;
        }

        textarea {
            min-height: 140px;
            resize: vertical;
        }

        .actions {
            display: flex;
            gap: 12px;
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
            gap: 6px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 10px 20px rgba(45, 108, 223, 0.25);
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
            <h1>タスク更新</h1>
            <p class="muted">内容を修正して確認画面へ進みます。</p>
            <form method="post" action="task_update_confirm.php">
                <div>
                    <label>ID（変更不可）</label>
                    <div class="static"><?= htmlspecialchars($task['id'], ENT_QUOTES, 'UTF-8') ?></div>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($task['id'], ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div>
                    <label for="name">タスク名</label>
                    <input id="name" name="name" required value="<?= htmlspecialchars($task['name'], ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div>
                    <label for="description">説明</label>
                    <textarea id="description" name="description"><?= htmlspecialchars($task['description'], ENT_QUOTES, 'UTF-8') ?></textarea>
                </div>

                <div class="actions">
                    <button class="btn btn-primary" type="submit">更新内容を確認する</button>
                    <a class="btn btn-secondary" href="pdo_select_all.php">戻る</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>