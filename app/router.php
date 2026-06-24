<?php
require "database.php";


class Router {
    private $dbConnection = null;

    public function __construct() {
        $this->dbConnection = new Database()->db();
    }

    public function add() {
        $currentDate = new DateTimeImmutable();

        $stmt = $this->dbConnection->prepare('INSERT INTO tfli (shortened, uri, expires) VALUES (:shortened, :uri, :expires)');
        $stmt->bindValue(':shortened', 'example', SQLITE3_TEXT);
        $stmt->bindValue(':uri', 'https://example.com/', SQLITE3_TEXT);
        $stmt->bindValue(':expires', $currentDate->format('Y-m-d H:i:s'), SQLITE3_TEXT);

        $result = $stmt->execute();
    }

    public function getAll(): array {
        $routes = [];
        $routesQuery = $this->dbConnection->query('select * from tfli');
        while ($row = $routesQuery->fetchArray()) {
            $routes[] = [
                'shortened' => $row['shortened'],
                'uri' => $row['URI'],
                'expires' => $row['expires'],
            ]; 
        }

        return $routes;
    }

    public function redirect(string $route): void {
        $stmt = $this->dbConnection->prepare('SELECT URI FROM tfli WHERE shortened = :short LIMIT 1');
        $stmt->bindValue(':short', $route, SQLITE3_TEXT);

        $result = $stmt->execute()->fetchArray();
        if (count($result) > 0) {
            $redirect = $result['URI'];
            header("Location: $redirect");
        }
        
        // if (array_key_exists($route, $this->routes)) {
        //     $redirect = $this->routes[$route];
        //     header("Location: $redirect");
        // }

        // header("HTTP/1.1 404 Not Found");
    }

    public function loadDatabase() {
        var_dump($this->dbConnection->query('select * from tfli'));
        
    }
}
