<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>タスク登録</title>
    <style>
        :root {
            --bg: #f7f8fb;
            --card: #ffffff;
            --primary: #2d6cdf;
            --text: #1f2937;
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
            width: min(720px, 100%);
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
        }

        .title {
            margin: 0 0 16px;
            font-size: 24px;
            letter-spacing: 0.02em;
        }

        .subtitle {
            margin: 0 0 24px;
            color: var(--muted);
            font-size: 14px;
        }

        form {
            display: grid;
            gap: 16px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
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
            min-height: 120px;
            resize: vertical;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 8px;
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

        .spacer {
            height: 4px;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="card">
            <h1 class="title">タスク登録</h1>
            <p class="subtitle">IDとタスク名を入力して、必要なら説明も追加してください。</p>
            <form method="post" action="pdo_insert.php">
                <div>
                    <label for="id">ID</label>
                    <input id="id" type="text" name="id" required placeholder="例: task-001">
                </div>

                <div>
                    <label for="name">タスク名</label>
                    <input id="name" type="text" name="name" required placeholder="例: 仕様書作成">
                </div>

                <div>
                    <label for="description">説明</label>
                    <textarea id="description" name="description" placeholder="詳細やメモを入力"></textarea>
                </div>

                <div class="actions">
                    <button class="btn btn-primary" type="submit">登録する</button>
                    <a href="pdo_select_all.php" style="text-decoration:none;">
                        <button class="btn btn-secondary" type="button">一覧に戻る</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>