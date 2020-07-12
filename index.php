<?php
require_once './db/config.php';

session_start();
if(!isset($_SESSION['login']) == true){
  unset($_SESSION['login']);
  echo "<script>window.location = './login.php'</script>";
}

if (isset($_POST['cadastrar'])) {
  $feriado = $_POST['feriado'];
  $data = $_POST['data'];
  $tipo = $_POST['tipo'];

  $conection = conection();
    $sql = "INSERT INTO feriados (nome, data, tipo) VALUES ('$feriado', '$data', '$tipo')";
    $query = mysqli_query($conection, $sql);
    if ($query) {
      header("location: feriados.php");
    } else {
      echo "<script>alert('Erro ao cadastrar feriados!')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <title>Cadastrar - Feriados</title>
</head>

<body>
  <div class="container">
    <form action="" method="post">
      <div class="login">
        <h1>Feriados List 🥳</h1>
        <p>Preencha abaixo para cadastrar um novo feriado</p>
        <div class="form">
          <p>Nome do feriado</p>
          <input type="text" name="feriado" placeholder="Feriado" required>

          <p>Data do feriado</p>
          <input type="date" name="data" placeholder="Data" required>

          <p>Tipo de feriado</p>
          <select name="tipo">
            <option selected>Escolher...</option>
            <option value="1">Feriado Nacional</option>
            <option value="2">Feriado Estadual</option>
            <option value="3">Feriado Municipal</option>
            <option value="4">Facultativo</option>
          </select>
        </div>
        <div class="botoes">
          <button type="submit" name="cadastrar">Cadastrar</button>
          <button type="button" class="visualizar">Visualizar</button>
        </div>

      </div>
    </form>

  </div>
</body>
<script src="./js/index.js"></script>

</html>