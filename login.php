<?php
require_once './db/config.php';

function login($usuario, $senha)
{
  $conection = conection();
  $sql = "SELECT * FROM user WHERE usuario='$usuario' and senha='$senha'";
  $query = mysqli_query($conection, $sql);

  if (mysqli_num_rows($query) >= 1) {
    return true;
  } else {
    return false;
  }
}


if (isset($_POST['entrar'])) {
  $usuario = $_POST['usuario'];
  $senha = md5($_POST['senha']);

  if (login($usuario, $senha)) {

    @session_start();
    $_SESSION['login'] = true;
    $_SESSION['usuario'] = $usuario;

    header("location: index.php");
  } else {
    echo "<script>alert('Usuário ou senha inválidos!')</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/login.css">
  <title>Login - Feriados</title>
</head>

<body>
  <div class="container">
    <form action="" method="post">
      <div class="login">
        <h1>Feriados List 🥳</h1>
        <p>Insira usuário e senha</p>
        <input type="text" name="usuario" placeholder="Usuário" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit" name="entrar">Entrar</button>
      </div>
    </form>

  </div>
</body>

</html>