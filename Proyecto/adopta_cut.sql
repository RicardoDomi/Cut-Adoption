-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-11-2024 a las 06:50:23
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `adopta_cut`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `ID_Admin` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Contrasena` varchar(255) NOT NULL,
  `FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `FotoURL` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_Admin`),
  UNIQUE KEY `Correo` (`Correo`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`ID_Admin`, `Nombre`, `Correo`, `Contrasena`, `FechaRegistro`, `Estado`, `FotoURL`) VALUES
(1, 'Ricardo', 'ricardo@gmail.com', '$2y$10$6TSyf0pXv3h/u7Ca57cs0OI057US4Ag4MV0YBdqaW0R9ezND25ph2', '2024-11-19 04:37:10', 'Activo', 'Resource/admin/673c15f6224ef1.25745297.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adopciones`
--

DROP TABLE IF EXISTS `adopciones`;
CREATE TABLE IF NOT EXISTS `adopciones` (
  `ID_Adopcion` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ID_Mascota` int UNSIGNED NOT NULL,
  `ID_Adoptante` int UNSIGNED NOT NULL,
  `FechaAdopcion` date NOT NULL,
  `Estado` enum('Pendiente','Aprobada','Rechazada') DEFAULT 'Pendiente',
  PRIMARY KEY (`ID_Adopcion`),
  KEY `ID_Adoptante` (`ID_Adoptante`),
  KEY `idx_adopciones_mascota_adoptante` (`ID_Mascota`,`ID_Adoptante`),
  KEY `idx_estado_adopcion` (`Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adoptantes`
--

DROP TABLE IF EXISTS `adoptantes`;
CREATE TABLE IF NOT EXISTS `adoptantes` (
  `ID_Adoptante` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `FechaRegistro` date NOT NULL,
  PRIMARY KEY (`ID_Adoptante`),
  UNIQUE KEY `idx_correo_adoptante` (`Correo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `adoptantes`
--

INSERT INTO `adoptantes` (`ID_Adoptante`, `Nombre`, `Telefono`, `Correo`, `Direccion`, `FechaRegistro`) VALUES
(2, 'adonai', '7894612313', '123@gmail.com', 'qwert123', '2024-11-18'),
(3, 'Jorge', '3313631516', 'jorgekastolo@gmail.com', 'Loma amarilla 7691', '2024-11-14'),
(4, '123', '123657', '12@gmail.com', 'Loma amarilla 76981', '2024-11-14'),
(5, '678', '987546', '098@gmail.com', 'Loma amarilla 4562', '2024-11-16'),
(6, '963', '7412', '369@gmail.com', 'Loma amarilla 6548', '2024-11-16'),
(8, '963', '7412', '654@gmail.com', 'Loma amarilla 6548', '2024-11-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interacciones`
--

DROP TABLE IF EXISTS `interacciones`;
CREATE TABLE IF NOT EXISTS `interacciones` (
  `ID_Interaccion` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ID_Mascota` int UNSIGNED NOT NULL,
  `ID_Adoptante` int UNSIGNED NOT NULL,
  `Mensaje` text,
  `FechaSolicitud` date NOT NULL,
  PRIMARY KEY (`ID_Interaccion`),
  KEY `ID_Adoptante` (`ID_Adoptante`),
  KEY `idx_interacciones_mascota_adoptante` (`ID_Mascota`,`ID_Adoptante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

DROP TABLE IF EXISTS `mascotas`;
CREATE TABLE IF NOT EXISTS `mascotas` (
  `ID_Mascota` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Edad` int UNSIGNED NOT NULL,
  `Raza` varchar(50) DEFAULT NULL,
  `Sexo` enum('Macho','Hembra') NOT NULL,
  `Descripcion` text,
  `ImagenURL` varchar(255) DEFAULT NULL,
  `FechaIngreso` date NOT NULL,
  PRIMARY KEY (`ID_Mascota`),
  KEY `idx_nombre_mascota` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`ID_Mascota`, `Nombre`, `Edad`, `Raza`, `Sexo`, `Descripcion`, `ImagenURL`, `FechaIngreso`) VALUES
(2, 'Max', 12, 'Husky', 'Macho', 'Un perro muy amigable', 'Resource/00006-263722516.png', '2024-01-01'),
(3, 'chuwys', 4, 'shit ztu', 'Macho', NULL, 'Resource/673bfc945d96b2.11100506.jpg', '2024-11-18'),
(4, 'bullet', 9, 'Pastor aleman', 'Macho', NULL, 'Resource/673c06af36dd48.36589384.jpg', '2024-11-14'),
(5, 'Chorizo', 2, 'Salchicha', 'Macho', 'Fiel compañero con un herramientas', 'Resource/673c08e6711ac8.20081484.jpg', '2024-11-18');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
