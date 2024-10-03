
<?php
    include_once("Templates/header.php")
?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Explicação do Formulário PHP e MySQL</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                margin: 0;
                padding: 20px;
                color: #333;
            }
            h1 {
                color: #4CAF50;
                text-align: center;
            }
            .container {
                max-width: 800px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h2 {
                color: #333;
                border-bottom: 2px solid #4CAF50;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }
            p {
                line-height: 1.6;
                margin-bottom: 20px;
            }
            code {
                background-color: #f4f4f9;
                padding: 2px 6px;
                border-radius: 4px;
                color: #c7254e;
            }
            .example {
                background-color: #e0e0e0;
                padding: 15px;
                margin-bottom: 20px;
                border-left: 4px solid #4CAF50;
                font-family: Consolas, monospace;
            }
            .select-box {
                background-color: #f4f4f9;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Explicação do Formulário PHP com MySQL</h1>
            
            <h2>O que este formulário faz?</h2>
            <p>Este formulário conecta-se a um banco de dados MySQL usando PHP e, em seguida, preenche automaticamente um campo de seleção (<code>&lt;select&gt;</code>) com valores extraídos de uma tabela do banco de dados.</p>
            
            <h2>Etapas do processo:</h2>
            
            <h3>1. Conectar ao Banco de Dados</h3>
            <p>O PHP utiliza a extensão <code>PDO</code> para conectar-se ao banco de dados. No código, as variáveis que definem o nome do banco de dados, usuário, senha e host são configuradas, e a conexão é estabelecida usando um bloco <code>try...catch</code> para tratar possíveis erros.</p>
            
            <div class="example">
                <code>
                $conn = new PDO("mysql:host=localhost;dbname=pizzaria", "root", "");
                </code>
            </div>
            
            <h3>2. Consulta ao Banco de Dados</h3>
            <p>Depois de conectar ao banco de dados, uma consulta é feita para buscar todos os valores da tabela <code>bordas</code>. Os resultados dessa consulta são armazenados em um array para uso posterior.</p>
            
            <div class="example">
                <code>
                $bordasQuery = $conn->query("SELECT * FROM bordas;");<br>
                $bordas = $bordasQuery->fetchAll();
                </code>
            </div>
            
            <h3>3. Inserir os Valores no Campo Select</h3>
            <p>Após a consulta, os valores da tabela <code>bordas</code> são inseridos no campo de seleção (<code>&lt;select&gt;</code>) para que o usuário possa escolher uma opção disponível. O PHP gera dinamicamente os elementos <code>&lt;option&gt;</code> com os dados do banco.</p>
            
            <div class="example">
                <code>
                &lt;select name="Borda" id="borda"&gt;<br>
                &nbsp;&nbsp;&lt;?php foreach($bordas as $borda): ?&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;option value="&lt;?= $borda['id'] ?&gt;"&gt;&lt;?= $borda['tipo'] ?&gt;&lt;/option&gt;<br>
                &nbsp;&nbsp;&lt;?php endforeach; ?&gt;<br>
                &lt;/select&gt;
                </code>
            </div>
            
            <h2>Exemplo de Campo de Seleção:</h2>
            <div class="select-box">
                <select>
                    <option value="1">Cheddar</option>
                    <option value="2">Catupiry</option>
                    <!-- Os valores aqui seriam gerados dinamicamente pelo PHP -->
                </select>
            </div>
            
            <h2>Resumo</h2>
            <p>O objetivo deste processo é fornecer uma interface dinâmica em PHP que se conecta a um banco de dados MySQL para carregar valores em um formulário de maneira automática. Isso simplifica a manutenção e garante que o formulário esteja sempre atualizado com os dados mais recentes do banco de dados.</p>
        </div>
    </body>
    </html>

<i  class="fas fa-sync-alt"></i>
<?php
    include_once("Templates/footer.php")
?>