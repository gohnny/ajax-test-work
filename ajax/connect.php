<?php ## Соединение с базой данных
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=testworktrafgid',
        'root',
        '111111',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("set names utf8");
} catch (PDOException $e) {
    echo "Невозможно установить соединение с базой данных";
}
?>

