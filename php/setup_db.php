<?php
$db = new SQLite3('database.db');

$db->exec('CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE,
    password TEXT
)');

echo "Banco de dados configurado!";
?>