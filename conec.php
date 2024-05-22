<?php
$env = parse_ini_file("/var/local/env");
$username = $env['username'];
$password = $env['password'];
$host = $env['host'];
$base = $env['base'];
$engine = "mysql";
$port = "3306";

// Establecer la conexión
try {
    $dsn = "$engine:host=$host;port=$port;dbname=$base";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );

    $dbh = new PDO($dsn, $username, $password, $options);
    echo "Conexión establecida exitosamente.";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Ejecutar la consulta SQL
$sql = "SELECT * FROM user";
$stmt = $dbh->query($sql);

// Recuperar los resultados
$results = $stmt->fetchAll();

echo $results

?>

