<?php

class taskModel {
    protected $db;

    public function __construct()
    {
      require_once 'config.php';
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS
        );
        $this->_deploy();
    }

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql = <<<'END'
CREATE TABLE `categorias` (
  `id` int(2) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Gaming', 'Potencia y velocidad para dominar cualquier juego'),
(2, 'Oficina', 'Rendimiento confiable para tu productividad diaria'),
(3, 'Estudio', 'Ligeras y eficientes, ideales para tus tareas y clases');

CREATE TABLE `notebooks` (
  `id` int(11) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` int(15) NOT NULL,
  `categoria_id` int(2) NOT NULL,
  `img` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `notebooks` (`id`, `modelo`, `descripcion`, `precio`, `categoria_id`, `img`) VALUES
(1, 'ASUS ROG Strix G15', 'Notebook Gamer con procesador AMD Ryzen 9, 16GB RAM, RTX 3070', 650000, 1, 'https://dlcdnwebimgs.asus.com/gain/6D1F9EF4-02D6-455B-9D43-348275816538/w1000/h732'),
(2, 'ASUS TUF Dash F15', 'Notebook Gamer con Intel i7, 16GB RAM, RTX 3060', 580000, 1, 'https://dlcdnwebimgs.asus.com/gain/769aaa49-031e-4a90-b03c-3091198e95a1/'),
(3, 'ASUS ZenBook 14', 'Notebook ultradelgada para oficina, Intel i5, 8GB RAM, SSD 512GB', 220000, 2, 'https://dlcdnwebimgs.asus.com/gain/838fbdac-6d10-4190-8e52-d4b9463f5d23/');

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'webadmin', '$2y$10$9nr7eFRdiN5MCpra5PYOI.yd.jD2eUO0/GAIA1vF.bRdhIkCtltrG', 'Admin'),
(2, 'thiago', '$2y$10$BrLYUiW3xw7hVkLjvATMROyckqnt0O9Oy8Haa1/jEF2kZNFYUPkO6', 'Miembro'),
(3, 'mateo', '$2y$10$IBvFTsdD41x0Y4aebzH0DOWw6l9ybmpbPTMP8uuKcAS31SaKiUVuW', 'Miembro');

ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `notebooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`categoria_id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `categorias`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `notebooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `notebooks`
  ADD CONSTRAINT `notebooks_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
END;
$this->db->query($sql);
  }
}


    function obtenerComputadoras() {
        $query = $this->db->prepare("SELECT * FROM notebooks");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function obtenerComputadorasID($id) {
        $query = $this->db->prepare("SELECT * FROM notebooks WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function agregarComputadoras($modelo,$descripcion,$precio,$gama,$imagen) {
    $agregar = $this->db->prepare("INSERT INTO notebooks (modelo,descripcion,precio,categoria_id,img) VALUES (?,?,?,?,?)");
    $agregar->execute([$modelo,$descripcion,$precio,$gama,$imagen]);
    }

    function eliminarComputadorax($id) {
        $eliminar = $this->db->prepare("DELETE FROM notebooks WHERE id = ?");
        $eliminar->execute([$id]);
    }

    function actualizarComputadorax($id, $modelo, $descripcion, $precio, $gama, $img) {
    $actualizar = $this->db->prepare("UPDATE notebooks SET modelo = ?, descripcion = ?, precio = ?, categoria_id = ?, img = ? WHERE id = ?");
    $actualizar->execute([$modelo, $descripcion, $precio, $gama, $img, $id]);
    }
}
