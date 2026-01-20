<?php
require 'pdo_connect.php';

// POST以外は弾く処理（直アクセス対策）
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('POSTで送信してください。');
}

// 受け取り
// ?? ''->NULLの時に''
// trim 前後の空白を削除 "user01"
$id = trim($_POST['id'] ?? '');
// (string)強制的に文字型に変換
$name = (string)($_POST['name']);
$description = (string)($_POST['description']);

// 入力チェック
if ($id === '' || $name === '') {
    exit('IDとタスク名を入力してください。');
}

$sql = "INSERT INTO tasks (id, name, description, created_at) VALUES (?, ?, ?, NOW())";
$stmt = $con->prepare($sql);
$stmt->execute([$id, $name, $description]);

$safe_id = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>登録完了</title>
    <style>
        :root {
            --bg: #f0fdf4;
            --card: #ffffff;
            --primary: #16a34a;
            --text: #0f172a;
            --muted: #475569;
            --border: #d1fae5;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Inter", "Noto Sans JP", system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #ecfdf3, #f8fafc);
            color: var(--text);
        }

        .page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 40px 16px;
        }

        .card {
            width: min(700px, 100%);
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 12px 30px rgba(22, 163, 74, 0.12);
        }

        .title {
            margin: 0 0 8px;
            font-size: 24px;
            letter-spacing: 0.01em;
        }

        .muted {
            margin: 0 0 20px;
            color: var(--muted);
            font-size: 14px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 999px;
            background: #dcfce7;
            color: #15803d;
            font-weight: 700;
            font-size: 13px;
            margin-bottom: 14px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 12px 16px;
            border-radius: 8px;
            border: none;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            background: #1d4ed8;
            color: #fff;
            box-shadow: 0 10px 20px rgba(29, 78, 216, 0.25);
            transition: transform 0.05s ease, box-shadow 0.15s ease;
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
            <div class="pill">登録完了</div>
            <h1 class="title">タスクを登録しました</h1>
            <p class="muted">ID: <?= $safe_id ?></p>
            <a class="btn" href="pdo_select_all.php">タスク一覧へ戻る</a>
        </div>
    </div>
</body>

</html>