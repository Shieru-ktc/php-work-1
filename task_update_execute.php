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

    // 更新できたか確認
    if ($stmt->rowCount() > 0) {
        echo "更新しました：ID = " . htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
        echo "<br>";
        echo '<a href="pdo_select_all.php"><button type="button">タスク一覧へ戻る</button></a>';
    } else {
        echo "更新対象が見つかりませんでした。<br>";
        echo '<a href="pdo_select_all.php">一覧へ戻る</a>';
    }
} catch (PDOException $e) {
    echo "更新に失敗しました。";
    // 開発中だけ詳細を見たいなら一時的に↓
    // echo "<br>" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
}
