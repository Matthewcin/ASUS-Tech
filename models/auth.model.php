<?php
class authModel
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS
        );
    }

    function verificarUsuarioExiste($username)
    {
        $query = $this->db->prepare("SELECT COUNT(*) FROM usuarios WHERE username = ?");
        $query->execute([$username]);
        return $query->fetchColumn() > 0; // Si el contador es mayor que 0, el usuario existe
    }

    function getLogin($username, $password)
    {
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE username = ?");
        $query->execute([$username]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    }

    function getRegister($username, $password)
    {
        $passwordEncriptada = password_hash($password, PASSWORD_BCRYPT);
        $query = $this->db->prepare("INSERT INTO usuarios (username, password, role) VALUES (?, ?, ?)");
        $query->execute([$username, $passwordEncriptada, "Miembro"]);
    }

    function getRole($username)
    {
        $query = $this->db->prepare("SELECT role FROM usuarios WHERE username = ?");
        $query->execute([$username]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /*function agregarCategorias($categoria,$descripcion) {
        $agregar = $this->db->prepare("INSERT INTO categorias (nombre,descripcion) VALUES (?,?)");
        $agregar->execute([$categoria,$descripcion]);
    }*/
}