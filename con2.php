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
    echo "Conexión establecida exitosamente.<br>";

    // Ejecutar la consulta SQL sin ninguna validación
    if (isset($_GET['sql']) && !empty($_GET['sql'])) {
        $sql = $_GET['sql'];
        $stmt = $dbh->query($sql);
        
        // Recuperar los resultados
        $results = $stmt->fetchAll();
        
        // Mostrar los resultados de forma insegura
        echo "<pre>";
        print_r($results);
        echo "</pre>";
    } else {
        echo "No se proporcionó ninguna consulta SQL.";
    }

    // Cerrar la conexión
    $dbh = null;
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
