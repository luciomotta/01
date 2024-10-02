<?php
    include_once('conn.php');

    $method = $_SERVER['REQUEST_METHOD'];

    // Resgata os dados do formulário
    if ($method === 'GET') {
        // Bordas
        $bordasQuery = $conn->query("SELECT * FROM bordas;");
        $bordas = $bordasQuery->fetchAll();

        // Massas
        $massasQuery = $conn->query("SELECT * FROM massas;");
        $massas = $massasQuery->fetchAll();

        // Sabores
        $saboresQuery = $conn->query("SELECT * FROM sabores;");
        $sabores = $saboresQuery->fetchAll();

        // print_r($sabores); exit; // Testar se está pegando os valores
    } else if ($method === 'POST') {
        $data = $_POST;

        // Certifique-se de que a chave existe em $_POST antes de usá-la
        $borda = isset($data['Borda']) ? $data['Borda'] : null;
        $massa = isset($data['Massa']) ? $data['Massa'] : null;
        $sabores = isset($data['Sabores']) ? $data['Sabores'] : [];

        // Validação de sabores máximos
        if (count($sabores) > 3) {
            $_SESSION["msg"] = "Selecione no máximo 3 sabores";
            $_SESSION["status"] = "warning";
        } else {
            try {
                // Salvando borda e massa na pizza
                $stm = $conn->prepare("INSERT INTO pizzas (borda_id, massa_id) VALUES (:borda, :massa);");

                // Filtrando inputs
                $stm->bindParam(':borda', $borda, PDO::PARAM_INT);
                $stm->bindParam(':massa', $massa, PDO::PARAM_INT);
                $stm->execute(); // Inserindo no banco

                // Salvando sabores na pizza [Tabela pivot]
                // Resgatando ID da última Pizza
                $pizza_id = $conn->lastInsertId();

                $stm = $conn->prepare("INSERT INTO pizza_sabor (pizza_id, sabores_id) VALUES (:pizza_id, :sabor_id);");

                // Repetir até terminar de salvar todos os sabores
                foreach ($sabores as $sabor) {
                    $stm->bindParam(':pizza_id', $pizza_id, PDO::PARAM_INT);
                    $stm->bindParam(':sabor_id', $sabor, PDO::PARAM_INT);
                    $stm->execute(); // Inserindo no banco
                }

                // Criar o pedido da pizza
                $stm = $conn->prepare("INSERT INTO pedidos (pizza_id, status_id) VALUES (:pizza_id, :status_id);");

                // Status -> sempre inicia com 1 [Que é PRODUÇÃO]
                $statusid = 1;

                // Filtrar inputs
                $stm->bindParam(":pizza_id", $pizza_id, PDO::PARAM_INT); // Corrigido aqui
                $stm->bindParam(":status_id", $statusid, PDO::PARAM_INT);  

                $stm->execute();

                // Exibir mensagem de sucesso
                $_SESSION["msg"] = "Pedido realizado com sucesso!";
                $_SESSION["status"] = "success";

            } catch (PDOException $e) {
                // Mensagem de erro
                echo "Erro: " . $e->getMessage();
            }
        }
        
        // Redireciona para a última página
        header("Location: ..");
        exit;
    }

    // Feche a conexão, se necessário (opcional)
    // $conn = null; // não precisa fechar a conexão, pois o PHP fecha automaticamente
    ?>
