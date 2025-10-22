# TPE Parte 1 - Tienda de Notebooks ASUS

## Integrantes del grupo
- Planes Mateo Valentín - mateo62009mp@gmail.com
- Ramos Thiago - tr9282321@yahoo.com

## Temática del TPE
**Catalogo de Notebooks ASUS.**  

## Descripción
El sitio contendrá un catalogo de Notebooks ASUS por Categorias (Estudio, Oficina, Gamer)

## Diagrama de Entidad-Relación (DER)
El archivo que contiene el DER del modelo de datos se encuentra en:  
**`DER_notebooks_asus.png`**
https://i.imgur.com/IcNRW6g.png

### Descripción general del DER
El modelo incluyo:  
- **Producto**: Representa cada notebook ASUS disponible.
    ID: Autoincrementable y único
    Modelo: Modelo del Producto, EJ: 'ASUS Vivobook E1504F'
    Descripcion: Descripción del Producto.
    Precio: Precio (En Pesos Argentinos).
    Categoria_ID: Categoria del Producto (Estudio, Oficina, Gamer)
    Img: Imagen en formato URL.

- **Categoria**: Información de la categoria antes Nombrada.
    ID: Representa la Categoria:
        1- Gamer
        2- Oficina
        3- Estudio

## Código SQL de la BBDD
El código SQL para ejecutar desde phpMyAdmin para crear la base de datos se encuentra en:  
**`db_asus.sql`**
```sql
CREATE TABLE `categorias` (
  `id` int(2) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Gaming', 'Potencia y velocidad para dominar cualquier juego'),
(2, 'Oficina', 'Rendimiento confiable para tu productividad diaria'),
(3, 'Estudio', 'Ligeras y eficientes, ideales para tus tareas y clases');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notebooks`
--

CREATE TABLE `notebooks` (
  `id` int(11) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` int(15) NOT NULL,
  `categoria_id` int(2) NOT NULL,
  `img` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `notebooks`
--

INSERT INTO `notebooks` (`id`, `modelo`, `descripcion`, `precio`, `categoria_id`, `img`) VALUES
(1, 'ASUS ROG Strix G15', 'Notebook Gamer con procesador AMD Ryzen 9, 16GB RAM, RTX 3070', 650000, 1, 'https://dlcdnwebimgs.asus.com/gain/6D1F9EF4-02D6-455B-9D43-348275816538/w1000/h732'),
(2, 'ASUS TUF Dash F15', 'Notebook Gamer con Intel i7, 16GB RAM, RTX 3060', 580000, 1, 'https://dlcdnwebimgs.asus.com/gain/769aaa49-031e-4a90-b03c-3091198e95a1/'),
(3, 'ASUS ZenBook 14', 'Notebook ultradelgada para oficina, Intel i5, 8GB RAM, SSD 512GB', 220000, 2, 'https://dlcdnwebimgs.asus.com/gain/838fbdac-6d10-4190-8e52-d4b9463f5d23/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

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
(2, 'thiago', '$2y$10/jEF2kZNFYUPkO6', 'Miembro'),
(3, 'mateo', '$2y$10', 'Miembro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `notebooks`
--
ALTER TABLE `notebooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `notebooks`
--
ALTER TABLE `notebooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notebooks`
--
ALTER TABLE `notebooks`
  ADD CONSTRAINT `notebooks_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;
```
