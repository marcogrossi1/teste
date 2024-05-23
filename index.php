<!DOCTYPE html>
<?php
  $db = mysqli_connect("localhost", "root", "", "banco-dos-tesouros");
  $db->set_charset("utf8");

  if (!$db) {
    $descricaoErro = "Erro: não foi possível conectar ao banco de dados. ";
    $descricaoErro = $descricaoErro . "Detalhes: " . mysqli_connect_error();
    die($descricaoErro);
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Controle de Estoque dos Tesouros</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" href="calice.ico">
  </head>
  <body>
    <h1>Gerenciador de Tesouros <?= 'By ' . "Marcão" ?></h1>
    <?php 
      $sql = "SELECT * FROM tesouros";
      $resultado = mysqli_query($db, $sql);
    ?>
    <table>
      <caption>Estes são os tesouros acumulados do Barba-Ruiva em suas aventuras</caption>
      <thead>
        <tr>
          <th>Tesouro</th>
          <th>Nome</th>
          <th>Valor unitário</th>
          <th>Quantidade</th>
          <th>Valor total</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $totalGeral = 0;
          foreach ($resultado as $tesouroAtual) {
        ?>
        <tr>
          <td><img src="<?= $tesouroAtual["icone"]; ?>"></td>
          <td><?= $tesouroAtual["nome"]; ?></td>
          <td><?= number_format($tesouroAtual["valorUnitario"], 2, ",", " "); ?></td>
          <td><?= number_format($tesouroAtual["quantidade"], 2, ","," "); ?></td>
          <?php $valorTotal = $tesouroAtual["valorUnitario"] * $tesouroAtual["quantidade"];?>
          <td><?= number_format($valorTotal, 2, ","," ")?></td>
          <?php $totalGeral += $valorTotal; ?>
        </tr>
        <?php
          }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="4">Total geral</td>
          <td><?= number_format($totalGeral, 2, ",", " ");?></td>
        </tr>
      </tfoot>
    </table>
    <p>Yarr Harr, marujo! Aqui é o temido Barba-Ruiva e você deve me ajudar
      a contabilizar os espólios das minhas aventuras!</p>
  </body>
</html>
