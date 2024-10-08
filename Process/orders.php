<?php
include_once("conn.php");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {

    $pedidosQuery = $conn->query("SELECT * FROM pedidos");
    $pedidos = $pedidosQuery->fetchAll();
    $pizzas = [];

    // Montando o array de pizzas
    foreach ($pedidos as $pedido) {
        $pizza = [];
        // Definir array para a pizza
        $pizza["id"] = $pedido["pizza_id"];

        // Resgatar a pizza
        $pizzaQuery = $conn->prepare("SELECT * FROM pizzas WHERE id = :pizza_id");
        $pizzaQuery->bindParam(":pizza_id", $pedido["pizza_id"]);
        $pizzaQuery->execute();
        $pizzaData = $pizzaQuery->fetch(PDO::FETCH_ASSOC);

        // Resgatando a borda da pizza
        $bordaQuery = $conn->prepare("SELECT * FROM bordas WHERE id = :borda_id");
        $bordaQuery->bindParam(":borda_id", $pizzaData["borda_id"]);
        $bordaQuery->execute();
        $borda = $bordaQuery->fetch(PDO::FETCH_ASSOC);
        $pizza["borda"] = $borda["tipo"];

        // Resgatando a massa da pizza
        $massaQuery = $conn->prepare("SELECT * FROM massas WHERE id = :massa_id");
        $massaQuery->bindParam(":massa_id", $pizzaData["massa_id"]);
        $massaQuery->execute();
        $massa = $massaQuery->fetch(PDO::FETCH_ASSOC);
        $pizza["massa"] = $massa["tipo"];

        // Resgatando os sabores da pizza
        $saboresQuery = $conn->prepare("SELECT * FROM pizza_sabor WHERE pizza_id = :pizza_id");
        $saboresQuery->bindParam(":pizza_id", $pizzaData["id"]);
        $saboresQuery->execute();
        $sabores = $saboresQuery->fetchAll(PDO::FETCH_ASSOC);

        // Resgatando o Nome dos sabores
        $saboresDaPizza = [];
        $saborQuery = $conn->prepare("SELECT * FROM sabores WHERE id = :sabores_id");

        foreach ($sabores as $sabor) {
            $saborQuery->bindParam(":sabores_id", $sabor["sabores_id"]);
            $saborQuery->execute();
            $saborPizza = $saborQuery->fetch(PDO::FETCH_ASSOC);

            if ($saborPizza) { // Verifica se a consulta retornou um resultado
                array_push($saboresDaPizza, $saborPizza["nome"]);
            }
        }

        $pizza["sabores"] = $saboresDaPizza;

        // Adicionar o STATUS do pedido
        $statusQuery = $conn->prepare("SELECT tipo FROM status WHERE id = :status_id");
        $statusQuery->bindParam(":status_id", $pedido["status_id"]);
        $statusQuery->execute();
        $status = $statusQuery->fetch(PDO::FETCH_ASSOC);
        $pizza["status"] = $status ? $status["tipo"] : 'Desconhecido';

        // Adicionar o array de pizza ao array de pizzas
        array_push($pizzas, $pizza);
    }

    // Exibir as pizzas
    //print_r($pizzas);

    // Resgatando os status
    $statusQuery = $conn->query("SELECT * FROM status");
    $status = $statusQuery->fetchAll();
} else if ($method == 'POST') {
    // Código para o método POST
}
?>
