<?php

/** データベース接続URL */
$dsn = 'mysql:host=localhost:3306;dbname=phpdb;charset=utf8mb4';
/** ユーザー名 */
$username = 'root';
/** パスワード */
$password = '';
/**
 * データベースの接続を取得する。
 * @var PDO $con
 */
$con = new PDO($dsn, $username, $password);
try {
    // 文字セットをUTF-8に設定
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec("SET NAMES utf8mb4");
} catch (PDOException $e) {
    exit("接続失敗: " . $e->getMessage());
}
