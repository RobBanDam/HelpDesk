-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2023 a las 02:04:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `helpdesk`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `td_ticketdetalle`
--

CREATE TABLE `td_ticketdetalle` (
  `tickid_id` int(11) NOT NULL,
  `tickid` int(11) NOT NULL,
  `usuid` int(11) NOT NULL,
  `tickid_desc` mediumtext NOT NULL,
  `fechcrea` datetime NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `td_ticketdetalle`
--

INSERT INTO `td_ticketdetalle` (`tickid_id`, `tickid`, `usuid`, `tickid_desc`, `fechcrea`, `est`) VALUES
(1, 1, 2, 'Te respondo', '2023-11-21 21:09:04', 1),
(2, 1, 1, 'Usuario respondiendo', '2023-11-22 17:57:42', 1),
(3, 1, 2, 'Soy el Soporte', '2023-11-22 17:58:56', 1),
(4, 1, 1, '<p>¿Alguna novedad?</p>', '2023-11-22 15:33:12', 1),
(5, 1, 2, '<p>Con gusto, dame unos momentos :)</p>', '2023-11-22 15:33:57', 1),
(6, 2, 2, '<p>Me indicas si reiniciando tu equipo se quita ese mensaje, quedo atento :)</p>', '2023-11-22 16:01:13', 1),
(7, 2, 1, '<p>Aún muestra error</p>', '2023-11-22 17:55:54', 1),
(8, 2, 2, '<p>Te comparto las siguientes claves</p><p style=\"grid-column: main / 11 main;\">Códigos de activación para Windows 10 Pro 32/64 bits</p><p></p><ul style=\"grid-column: main / 11 main;\"><li style=\"\">Windows 10 Pro:&nbsp;VK7JG-NPHTM-C97JM-9MPGT-3V66T</li></ul><ul style=\"grid-column: main / 11 main;\"><li style=\"\">Windows 10 Pro:&nbsp;NRG8B-VKK3Q-CXVCJ-9G2XF-6Q84J</li></ul><ul style=\"grid-column: main / 11 main;\"><li style=\"\">Windows 10 Pro Education:&nbsp;6TP4R-GNPTD-KYYHQ-7B7DP-J447Y</li></ul><ul style=\"grid-column: main / 11 main;\"><li style=\"\">Windows 10 Pro Education N:&nbsp;YVWGF-BXNMC-HTQYQ-CPQ99-66QFC</li></ul><ul style=\"grid-column: main / 11 main;\"><li style=\"\">Windows 10 Pro N:&nbsp;MH37W-N47XK-V7XM9-C7227-GCQG9</li></ul><ul style=\"grid-column: main / 11 main;\"><li style=\"\">Windows 10 Pro N:&nbsp;9FNHH-K3HBT-3W4TD-6383H-6XYWF</li></ul><ul style=\"grid-column: main / 11 main;\"><li style=\"\">Windows 10 Pro Serial:&nbsp;W269N-WFGWX-YVC9B-4J6C9-T83GX</li></ul><p><br></p><p>Me indicas si quedo resuelto el problema,&nbsp;<span style=\"background-color: rgb(251, 252, 253); color: rgb(52, 52, 52); font-size: 1rem;\">quedo atento :)</span></p><p></p>', '2023-11-22 17:59:29', 1),
(9, 2, 1, '<p>Listo, quedo resuelto el problema.</p><p>Gracias :)</p>', '2023-11-22 18:00:21', 1),
(10, 2, 2, '<p>Perfecto, cerramos incidencia</p><p><br></p>', '2023-11-22 18:01:07', 1),
(11, 1, 2, '<p>Se cierra incidencia dado que ya fue resuelto</p>', '2023-11-22 19:02:06', 1),
(12, 1, 2, 'Ticket Cerrado...', '2023-11-22 19:02:12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_categoria`
--

CREATE TABLE `tm_categoria` (
  `catid` int(11) NOT NULL,
  `catnom` varchar(150) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_categoria`
--

INSERT INTO `tm_categoria` (`catid`, `catnom`, `est`) VALUES
(1, 'Hardware', 1),
(2, 'Software', 1),
(3, 'Incidencia', 1),
(4, 'Petición de Servicio', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_ticket`
--

CREATE TABLE `tm_ticket` (
  `tickid` int(11) NOT NULL,
  `usuid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `ticktitulo` varchar(250) NOT NULL,
  `tickdesc` varchar(9000) NOT NULL,
  `tickest` varchar(15) DEFAULT NULL,
  `fechcrea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_ticket`
--

INSERT INTO `tm_ticket` (`tickid`, `usuid`, `catid`, `ticktitulo`, `tickdesc`, `tickest`, `fechcrea`, `est`) VALUES
(1, 1, 4, 'Solicitud de Teclado', 'Hola, de su apoyo por favor para reposición de teclado para PC&lt;/p&gt;', 'Cerrado', '2023-11-20 16:53:16', 1),
(2, 1, 2, 'Licencia de Windows', '<p>Hola</p><p>En ocasiones me aparece mensaje en la parte inferior izquierda que el windows no es original</p><p><img src=\"data:image/png;base64,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', 'Cerrado', '2023-11-22 15:53:23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_usuario`
--

CREATE TABLE `tm_usuario` (
  `usuid` int(11) NOT NULL,
  `usunom` varchar(150) DEFAULT NULL,
  `usuape` varchar(150) DEFAULT NULL,
  `usucorreo` varchar(150) NOT NULL,
  `usupass` varchar(30) NOT NULL,
  `rolid` int(11) DEFAULT NULL,
  `fechacrea` datetime DEFAULT NULL,
  `fechamod` datetime DEFAULT NULL,
  `fechaelim` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tm_usuario`
--

INSERT INTO `tm_usuario` (`usuid`, `usunom`, `usuape`, `usucorreo`, `usupass`, `rolid`, `fechacrea`, `fechamod`, `fechaelim`, `est`) VALUES
(1, 'Roberto', 'Martínez', 'admin@admin.com', '123456', 1, '2023-11-16 20:40:20', '2023-11-16 20:40:20', '2023-11-16 20:40:20', 1),
(2, 'Carlos', 'Aparicio', 'admin2@admin.com', '123456', 2, '2023-11-20 17:52:21', NULL, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `td_ticketdetalle`
--
ALTER TABLE `td_ticketdetalle`
  ADD PRIMARY KEY (`tickid_id`);

--
-- Indices de la tabla `tm_categoria`
--
ALTER TABLE `tm_categoria`
  ADD PRIMARY KEY (`catid`);

--
-- Indices de la tabla `tm_ticket`
--
ALTER TABLE `tm_ticket`
  ADD PRIMARY KEY (`tickid`);

--
-- Indices de la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  ADD PRIMARY KEY (`usuid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `td_ticketdetalle`
--
ALTER TABLE `td_ticketdetalle`
  MODIFY `tickid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tm_categoria`
--
ALTER TABLE `tm_categoria`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tm_ticket`
--
ALTER TABLE `tm_ticket`
  MODIFY `tickid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  MODIFY `usuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
