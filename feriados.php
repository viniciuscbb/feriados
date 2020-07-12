<?php
require_once './db/config.php';

session_start();
if(!isset($_SESSION['login']) == true){
  unset($_SESSION['login']);
  echo "<script>window.location = './login.php'</script>";
}

function getTipo($tipo)
{
  switch ($tipo) {
    case 0:
      return 'Nenhum';
      break;
    case 1:
      return 'Feriado Nacional';
      break;
    case 2:
      return 'Feriado Estadual';
      break;
    case 3:
      return 'Feriado Municipal';
      break;
    case 4:
      return 'Facultativo';
      break;
  }
}

function mostrarFeriados(){
  $conection = conection();
  $sql = "SELECT * FROM feriados order by data";
  $query = mysqli_query($conection, $sql);
  while ($row = mysqli_fetch_array($query)) {
    $id_feriado = $row['id_feriado'];
    $nome       = $row['nome'];
    $data       = $row['data'];
    $data =  date("d/m/Y", strtotime($data));
    $tipo       = getTipo($row['tipo']);
    echo '
    <tr>
      <td>' . $nome . '</td>
      <td>' . $data . '</td>
      <td>' . $tipo . '</td>
      <td>
        <form method="post">
          <input type="hidden" name="idFeriado" value=' . $id_feriado . '> 
          <form method="post"><button type="submit" name="apagar" title="Clique aqui para remover o feriado">X</button></form>
        </form>
      </td>
    </tr>';
  }
}

//Apaga o feriado
if (isset($_POST['apagar'])) {
  $id_feriado = $_POST['idFeriado'];
  $conection = conection();

  $result = mysqli_query($conection, "DELETE FROM feriados WHERE id_feriado = '$id_feriado'");
  if (!$result) {
    echo "Erro ao deletar feriado";
  }
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
  <link rel="stylesheet" href="css/feriados.css">
  <title>Cadastrar - Feriados</title>
</head>

<body>
  <div class="container">
    <form action="" method="post">
      <div class="login">
        <h1>Feriados List 🥳</h1>
        <p>Lista dos feriados cadastrados.</p>
        <div class="tabela">
          <table>
            <tr>
              <th>Nome</th>
              <th>Data</th>
              <th>Tipo</th>
              <th>#</th>
            </tr>
            <?php echo mostrarFeriados(); ?>
          </table>
        </div>
      </div>
    </form>

  </div>
</body>
<script src="./js/index.js"></script>

</html>