-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 05:56 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c-employers`
--

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `rol` int(1) NOT NULL,
  `archivo_n` varchar(255) NOT NULL,
  `archivo` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0,
  `tareas_realizadas` int(1) NOT NULL,
  `horas_trabajadas` int(1) NOT NULL,
  `asistenciaPorcentaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `rol`, `archivo_n`, `archivo`, `status`, `eliminado`, `tareas_realizadas`, `horas_trabajadas`, `asistenciaPorcentaje`) VALUES
(1, 'omar', 'chavezzz', 'cassiel@udg.mx', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'foto.jpg', '5e8602e68eb180d07a2c1aa1abd0e356.jpg', 1, 0, 5, 160, 92),
(2, 'sandra', 'puente', 'sandra@mail.com', 'd41d8cd98f00b204e9800998ecf8427e', 1, '', '', 1, 1, 0, 0, 0),
(3, 'pedro', 'loza', 'loza@gmail.com', 'xyz', 1, '', '', 1, 1, 0, 0, 0),
(4, 'pedro', 'loza', 'loza@gmail.com', 'xyz', 1, '', '', 1, 1, 0, 0, 0),
(10, 'mau', 'sanchez', 'mau@gmail.com', '4321', 1, '', '', 1, 1, 0, 0, 0),
(11, 'mau', 'sanchez', 'mau@gmail.com', '4321', 1, '', '', 1, 1, 0, 0, 0),
(12, '444', '444', '44', '0099', 1, '', '', 1, 1, 0, 0, 0),
(13, '444', '444', '44', '0099', 1, '', '', 1, 1, 0, 0, 0),
(14, 'juan', 'camanei', 'juan@gmail.com', 'qwer', 1, '', '', 1, 1, 0, 0, 0),
(15, 'omar', 'campos', 'campos@mail.com', '263bce650e68ab4e23f28263760b9fa5', 2, '', '', 1, 1, 0, 0, 0),
(16, 'pablo', 'cucei', 'pablo@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2, '', '', 1, 1, 0, 0, 0),
(17, 'juan', 'sanchez', 'juan@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2, '', '', 1, 1, 0, 0, 0),
(18, 'ivan', 'ponce', 'ivan@mail.com', 'd0e906bc72280100be5edb936401e268', 2, '', '', 1, 1, 0, 0, 0),
(19, 'perez', 'perez', 'perez@gamil.com', '1a1dc91c907325c69271ddf0c944bc72', 2, '', '', 1, 1, 0, 0, 0),
(20, 'cassiel', 'campos', 'cassiel@mail.com', '072a740d449903272a42b3e423dae733', 2, '', '', 1, 1, 0, 0, 0),
(21, 'Mariaa', 'Felixx', 'maria@mail.com', 'e2fc714c4727ee9395f324cd2e7f331f', 1, 'María_Félix_1947.jpg', 'd3fa6d317648c72733337af35ef5f419.jpg', 1, 1, 0, 0, 0),
(22, 'ryan', 'gosling', 'ryan@mail.com', '1a1dc91c907325c69271ddf0c944bc72', 1, 'RyanGosling10-19.JPG', '8b08e7b2c159c221a6f47d91f2253914.JPG', 1, 0, 4, 7, 0),
(23, 'javier', 'milei', 'javier@mail.com', 'eb0d02d6c9c288b5c742ed785c682c05', 1, 'descarga.jpg', '4e39ee6184b38f1b666fc1456f36d6bdjpg', 1, 1, 0, 0, 0),
(24, 'cameron', 'diaz', 'cameron@mail.com', '36e849f5e53a75e3a65caa5ab0061793', 2, 'cameron.jpeg', '824b326e4f12bcc2bd8f227815cd9106.jpeg', 1, 0, 0, 0, 0),
(25, 'dave', 'rodgers', 'dave@mail.com', '9e1e06ec8e02f0a0074f2fcc6b26303b', 1, 'dave_rodgers2.jpg', '8e06bbd05f19ea2792ffe453513bb982.jpg', 1, 0, 0, 0, 0),
(26, 'pedrito', 'chavez', 'pedrito@mail.com', '9e1e06ec8e02f0a0074f2fcc6b26303b', 1, 'A12_Crear_tablero_de_ajedrez_con_DIVs.jpg', '788af4b032a6705d0a91806747a5d4c0.jpg', 1, 1, 0, 0, 0),
(27, 'pedro', 'campos', 'pedro.campos@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'A3_Tabla_con_imagenes.jpg', '2bc71cf5134823eedba1efe720a3dab5.jpg', 1, 0, 0, 0, 0),
(28, 'sisoy', 'juanperez', 'sisoyyyy@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'for all the dogs.png', '0be43e74f53a6ea0046b36c36a1bca9c.png', 1, 0, 0, 0, 0),
(29, '777', '777', '777@email.com', '202cb962ac59075b964b07152d234b70', 1, 'renegul.jpg', '059f88ad281af3f829cd1daeb6220bca.jpg', 1, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
