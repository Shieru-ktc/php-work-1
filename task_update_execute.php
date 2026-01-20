<?php
require 'pdo_connect.php';

// POST以外は弾く処理（直アクセス対策）
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('POSTで送信してください。');
}

// 受け取り
$id = trim($_POST['id'] ?? '');
$name = (string)($_POST['name']);
$description = (string)($_POST['description']);

// 入力チェック
if ($id === '' || $name === '') {
    exit('IDとタスク名を入力してください。');
}

try {
    // 更新実行
    $sql = "UPDATE tasks SET name = ?, description = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$name, $description, $id]);

    $safe_id = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
    if ($stmt->rowCount() > 0) {
        $status = 'success';
        $message = "更新しました：ID = {$safe_id}";
    } else {
        $status = 'empty';
        $message = "更新対象が見つかりませんでした。";
    }
} catch (PDOException $e) {
    $status = 'error';
    $message = "更新に失敗しました。";
}
?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>更新結果</title>
    <style>
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #475569;
            --border: #e2e8f0;
            --primary: #2563eb;
            --success: #16a34a;
            --warn: #f59e0b;
            --error: #dc2626;
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
            text-align: center;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 13px;
            margin-bottom: 14px;
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

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 16px;
            border-radius: 8px;
            border: none;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            background: var(--primary);
            color: #fff;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.25);
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
            <?php if ($status === 'success'): ?>
                <div class="pill" style="background:#dcfce7;color:#15803d;">更新完了</div>
                <h1 class="title">タスクを更新しました</h1>
                <p class="muted"><?= $message ?></p>
            <?php elseif ($status === 'empty'): ?>
                <div class="pill" style="background:#fef3c7;color:#b45309;">対象なし</div>
                <h1 class="title">更新対象が見つかりません</h1>
                <p class="muted"><?= $message ?></p>
            <?php else: ?>
                <div class="pill" style="background:#fee2e2;color:#b91c1c;">エラー</div>
                <h1 class="title">更新に失敗しました</h1>
                <p class="muted"><?= $message ?></p>
            <?php endif; ?>
            <a class="btn" href="pdo_select_all.php">タスク一覧へ戻る</a>
        </div>
    </div>
</body>

</html>