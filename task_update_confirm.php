<?php
$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$completed = isset($_POST['completed']) ? 1 : 0;

if ($id === '' || $name === '') {
    exit('入力が不足しています。');
}
?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>更新確認</title>
    <style>
        :root {
            --bg: #f7f8fb;
            --card: #ffffff;
            --primary: #2d6cdf;
            --text: #111827;
            --muted: #6b7280;
            --border: #e5e7eb;
            --accent: #e0f2fe;
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
            width: min(720px, 100%);
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

        .summary {
            display: grid;
            gap: 12px;
            margin-bottom: 16px;
        }

        .row {
            display: grid;
            gap: 6px;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #f9fafb;
        }

        .label {
            color: var(--muted);
            font-size: 12px;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .value {
            font-weight: 700;
        }

        .actions {
            display: flex;
            gap: 12px;
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
            <h1>更新内容の確認</h1>
            <p class="muted">内容を確認して問題なければ更新してください。</p>

            <div class="summary">
                <div class="row">
                    <div class="label">タスクID</div>
                    <div class="value"><?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?></div>
                </div>
                <div class="row">
                    <div class="label">タスク名</div>
                    <div class="value"><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></div>
                </div>
                <div class="row">
                    <div class="label">説明</div>
                    <div class="value"><?= nl2br(htmlspecialchars($description, ENT_QUOTES, 'UTF-8')) ?></div>
                </div>
                <div class="row">
                    <div class="label">完了フラグ</div>
                    <div class="value"><?= $completed ? '完了' : '未完了' ?></div>
                </div>
            </div>

            <form method="post" action="task_update_execute.php">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="description" value="<?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="completed" value="<?= $completed ?>">
                <div class="actions">
                    <button class="btn btn-primary" type="submit">この内容で更新する</button>
                    <button class="btn btn-secondary" type="button" onclick="history.back()">修正する</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>