<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Previsão do Tempo</title>
</head>
<body>
    <h2>Previsão do Tempo</h2>

    <form action="index.php" method="GET">
        <label>Insira o código da cidade em que você deseja saber a previsão do tempo:</label><br>
        <input type="text" name="codigo" required placeholder="Ex: 709"><br>
        <button type="submit">Buscar Previsão</button>
    </form>

    <br><hr><br>

    <form action="http://servicos.cptec.inpe.br/XML/listaCidades" method="GET" target="_blank">
        <label>Não sabe o código da cidade? Digite o nome da cidade abaixo (sem acentuação, caso haja):</label><br>
        <input type="text" name="city" required placeholder="Ex: Balneario"><br>
        <button type="submit">Buscar Código da Cidade</button>
    </form>

    <br><hr>

    <?php
    if (isset($_GET['codigo'])) {
        $codigo = $_GET['codigo'];
        $url = "http://servicos.cptec.inpe.br/XML/cidade/$codigo/previsao.xml";

        $xml = simplexml_load_file($url);

        if ($xml) {
            $nomeCidade = $xml->nome;
            echo "<h3>Previsão do Tempo de $nomeCidade:</h3>";
            foreach ($xml->previsao as $dia) {
                echo "<strong>Data:</strong> " . $dia->dia . "<br>";
                echo "Mínima: " . $dia->minima . "°C<br>";
                echo "Máxima: " . $dia->maxima . "°C<br>";
                echo "<hr>";
            }
        } else {
            echo "Erro ao acessar a previsão do tempo. Verifique o código da cidade.";
        }
    }
    ?>
</body>
</html>
