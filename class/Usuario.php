<?php

class Usuario {
    private $idusuario;
    private $desLogin;
    private $desSenha;
    private $dtCadastro;

    public function getIdUsuario() {
        return $this->idusuario;
    }

    public function setIdUsuario($value) {
        $this->idusuario = $value;
    }

    public function getDesLogin() {
        return $this->desLogin;
    }

    public function setDesLogin($value) {
        $this->desLogin = $value;
    }

    public function getDesSenha() {
        return $this->desSenha;
    }

    public function setDesSenha($value) {
        $this->desSenha = $value;
    }

    public function getDtCadastro() {
        return $this->dtCadastro;
    }

    public function setDtCadastro($value) {
        $this->dtCadastro = $value;
    }

    public function loadById($id) {
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID" => $id
        ));

        if (count($results) > 0) {
            $row = $results[0];

            $this->setIdUsuario($row['idusuario']);
            $this->setDesLogin($row['deslogin']);
            $this->setDesSenha($row['dessenha']);
            $this->setDtCadastro(new DateTime($row['dtcadastro']));
        }
    }

    public static function getList() {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    public static function search($login) {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ":SEARCH" => "%" . $login . "%"
        ));
    }

    public function login($login, $password) {
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD" => $password
        ));

        if (count($results) > 0) {
            $row = $results[0];

            $this->setIdUsuario($row['idusuario']);
            $this->setDesLogin($row['deslogin']);
            $this->setDesSenha($row['dessenha']);
            $this->setDtCadastro(new DateTime($row['dtcadastro']));
        }
        else {
            echo "<script>";
            echo "alert('Login ou senha inválidos!');";
            echo "</script>";
            throw new Exception("Login ou senha inválidos.");
        }
    }

    #Retorna um JSON dos registros buscados quando o objeto se comportar como string
    public function __toString() {
        return json_encode(array(
            "idusuario" => $this->getIdUsuario(),
            "deslogin" => $this->getDesLogin(),
            "dessenha" => $this->getDesSenha(),
            "dtcadastro" => $this->getDtCadastro()->format("d/m/Y H:i:s")
        ));
    }
}

?>