<?php

  include_once 'dao.php';

  class UsuarioDAO extends DAO {
    function __construct () {
        $this->prepararBanco();
    }

    function cadastrar($nome, $usuario, $email, $senha) {
      $senhaCriptografada = md5($senha);
      
      $preparacao = $this->conexao->prepare("INSERT INTO usuario(nome, usuario, email, senha) VALUES(?, ?, ?, ?)");

      $preparacao->bindParam(1, $nome);
      $preparacao->bindParam(2, $usuario);
      $preparacao->bindParam(3, $email);
      $preparacao->bindParam(4, $senhaCriptografada);

      $resultado = null;
      
      try {
        $resultado = $preparacao->execute();
      } catch (\Throwable $th) {
        if(
          str_contains($th, "Duplicate entry") &&
          str_contains($th, "key 'email'")
        ) {
          return "Poxa vei! Já usaram esse e-mail. Assim tu me quebra parceiro.";
        } else if(
          str_contains($th, "Duplicate entry") &&
          str_contains($th, "key 'usuario'")
        ) {
          return "Poxa vei! Já usaram esse nome. Assim tu me quebra parceiro";
        }

        return "Deu uns bagui cabuloso aqui. Tenta de novo ai, na moral.";
      }

      return null;
    }

    function login($usuario, $senha) {
      $senhaCriptografada = md5($senha);

      $preparacao = $this->conexao->prepare("SELECT * FROM usuario WHERE usuario=? and senha=?;");

      $preparacao->bindParam(1, $usuario);
      $preparacao->bindParam(2, $senhaCriptografada);

      $resultado = $preparacao->execute();

      return $resultado;
    }

    function listar_usuarios($nome) {
      $comando = "";

      
      if($nome != null) {
        $comando = "SELECT * FROM usuario WHERE nome like '%$nome%';";
      } else {
        $comando = "SELECT * FROM usuario;";
      }
      
      $resultado = $this->conexao->query($comando);

      return $resultado;
    }
  }
