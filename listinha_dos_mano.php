<?php

include_once 'usuario_dao.php';

$usuarioDAO = new UsuarioDAO();

$filtro = $_GET['filtro-nome'];

$usuarios = $usuarioDAO->listar_usuarios($filtro);

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="./estilo.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@300&display=swap" rel="stylesheet">
  </head>

  <body>
    <header>
      <h1>Listinha dos mano</h1>
    </header>

    <main id="pagina-listar-usuarios">

      <?php
        if($filtro != null) {
          ?>
          
          <form class="limpar-filtro" action="listinha_dos_mano.php">
            <button>Limpar</button>
          </form>

          <?php
        }
      ?>

      <form class="filtro-por-nome" action="listinha_dos_mano.php">
        <div class="grupo">
          <label>Filtro:</label>
          <input name="filtro-nome" />
        </div>
        <button type="submit">Pesquisar</button>
      </form>

      <?php
        if ($usuarios != NULL) {
          ?>

          <table>
            <thead>
              <tr>
                <th>id</th>
                <th>Nome</th>
                <th>Usuario</th>
                <th>E-mail</th>
              </tr>
            </thead>
            <tbody>
              <?php

                while ($linha = $usuarios->fetch(PDO::FETCH_ASSOC)) {
                  ?>

                  <tr>
                    <td><?php echo $linha["id"] ?></td>
                    <td><?php echo $linha["nome"] ?></td>
                    <td><?php echo $linha["usuario"] ?></td>
                    <td><?php echo $linha["email"] ?></td>
                  </tr>

                  <?php
                }

              ?>
            </tbody>
          </table>

          <?php
        }
        else {
          ?>

          <p>How! Tem ninguém com esse vulgo por essas quebrada não, mano. n</p>

          <?php
        }
      ?>
    </main>
  </body>
</html>