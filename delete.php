<?php
require 'db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $stmt = $pdo->prepare('DELETE FROM biodata WHERE id = :id');
    $stmt->execute([':id' => $id]);
}

header('Location: records.php?deleted=1');
exit;
