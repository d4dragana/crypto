<?php
include_once "session.php";
include_once "database.php";

$id = (int) $_POST['id'];
$content = $_POST['content'];
$user_id = $_SESSION['user_id'];

//pogledam za katero kriptovaluto gre
$query ="SELECT * FROM comments WHERE id = ?";
$stmt=$pdo->prepare($query);
$stmt->execute([$id]);
$crypto=$stmt->fetch();
$crypto_id=$crypto['cryptocurrency_id'];

//uredi le, če je trenutno prijavljeni lastnik avtor komentarja
$query = "UPDATE comments SET content=? WHERE id = ? AND user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$content, $id, $user_id]);

odziv("Komentar posodobljen");
 header("Location: cryptocurrency.php?id=$crypto_id#komentarji");
 die();



?>