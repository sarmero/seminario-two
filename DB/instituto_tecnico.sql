-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2024 a las 07:28:35
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `instituto_tecnico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `offer_subject_id` int(11) NOT NULL,
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admission`
--

CREATE TABLE `admission` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `state_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `admission`
--

INSERT INTO `admission` (`id`, `date`, `state_id`, `person_id`, `offer_id`) VALUES
(1, '2024-01-04', 1, 2, 3),
(2, '2024-01-04', 1, 3, 3),
(3, '2024-01-04', 1, 4, 3),
(4, '2024-01-04', 1, 5, 3),
(5, '2024-01-04', 1, 6, 3),
(6, '2024-01-04', 1, 7, 3),
(7, '2024-01-04', 1, 8, 3),
(8, '2024-01-04', 1, 9, 3),
(9, '2024-01-04', 1, 10, 3),
(10, '2024-01-04', 1, 11, 3),
(11, '2024-01-04', 1, 12, 3),
(12, '2024-01-04', 1, 13, 3),
(13, '2024-01-04', 1, 14, 3),
(14, '2024-01-04', 1, 15, 3),
(15, '2024-01-04', 1, 16, 3),
(16, '2024-01-04', 1, 17, 1),
(17, '2024-01-04', 1, 18, 1),
(18, '2024-01-04', 1, 19, 1),
(19, '2024-01-04', 1, 20, 1),
(20, '2024-01-04', 1, 21, 1),
(21, '2024-01-04', 1, 22, 1),
(22, '2024-01-04', 1, 23, 1),
(23, '2024-01-04', 1, 24, 1),
(24, '2024-01-04', 1, 25, 1),
(25, '2024-01-04', 1, 26, 1),
(26, '2024-01-04', 1, 27, 1),
(27, '2024-01-04', 1, 28, 1),
(28, '2024-01-04', 1, 29, 1),
(29, '2024-01-04', 1, 30, 1),
(30, '2024-01-04', 1, 31, 1),
(31, '2024-01-04', 1, 32, 2),
(32, '2024-01-04', 1, 33, 2),
(33, '2024-01-04', 1, 34, 2),
(34, '2024-01-04', 1, 35, 2),
(35, '2024-01-04', 1, 36, 2),
(36, '2024-01-04', 1, 37, 2),
(37, '2024-01-04', 1, 38, 2),
(38, '2024-01-04', 1, 39, 2),
(39, '2024-01-04', 1, 40, 2),
(40, '2024-01-04', 1, 41, 2),
(41, '2024-01-04', 1, 42, 2),
(42, '2024-01-04', 1, 43, 2),
(43, '2024-01-04', 1, 44, 2),
(44, '2024-01-04', 1, 45, 2),
(45, '2024-01-04', 1, 46, 2),
(46, '2024-01-04', 1, 47, 4),
(47, '2024-01-04', 1, 48, 4),
(48, '2024-01-04', 1, 49, 4),
(49, '2024-01-04', 1, 50, 4),
(50, '2024-01-04', 1, 51, 4),
(51, '2024-01-04', 1, 52, 4),
(52, '2024-01-04', 1, 53, 4),
(53, '2024-01-04', 1, 54, 4),
(54, '2024-01-04', 1, 55, 4),
(55, '2024-01-04', 1, 56, 4),
(56, '2024-01-04', 1, 57, 4),
(57, '2024-01-04', 1, 58, 4),
(58, '2024-01-04', 1, 59, 4),
(59, '2024-01-04', 1, 60, 4),
(60, '2024-01-04', 1, 61, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `calendar`
--

INSERT INTO `calendar` (`id`, `description`) VALUES
(1, '2023-A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `district`
--

INSERT INTO `district` (`id`, `description`) VALUES
(1, 'Nuevo Milenio'),
(2, 'Bajito'),
(3, 'Morrito'),
(4, 'Once de Noviembre'),
(5, 'Obrero'),
(6, 'Ciudadela'),
(7, 'Humberto Manzi'),
(8, 'Las Flores'),
(9, 'Los Angeles'),
(10, 'Ciudad 2000'),
(11, 'El Progreso'),
(12, 'Venecia'),
(13, 'San Judas'),
(14, 'Linbertadores'),
(15, 'La Playa'),
(16, 'Carbonera'),
(17, 'Libertad'),
(18, 'Caballito Garces'),
(19, 'Modelo'),
(20, 'Primavera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscription_subject`
--

CREATE TABLE `inscription_subject` (
  `id` int(11) NOT NULL,
  `note` float DEFAULT NULL,
  `offer_subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `inscription_subject`
--

INSERT INTO `inscription_subject` (`id`, `note`, `offer_subject_id`, `student_id`) VALUES
(1, 3, 1, 2),
(2, 2, 2, 2),
(3, 4, 3, 2),
(4, 4, 4, 2),
(5, 1, 5, 2),
(6, 5, 6, 2),
(7, 3.5, 1, 3),
(8, 4, 2, 3),
(9, 3, 3, 3),
(10, 1, 4, 3),
(11, 3, 5, 3),
(12, 5, 6, 3),
(13, 4, 1, 4),
(14, 2, 2, 4),
(15, 4, 3, 4),
(16, 4, 4, 4),
(17, 2, 5, 4),
(18, 3, 6, 4),
(19, 3, 1, 5),
(20, 4, 2, 5),
(21, 1, 3, 5),
(22, 2, 4, 5),
(23, 4, 5, 5),
(24, 3, 6, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_23_001608_activity', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modality`
--

CREATE TABLE `modality` (
  `id` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `modality`
--

INSERT INTO `modality` (`id`, `description`) VALUES
(1, 'Precencial'),
(2, ' Hibrida'),
(3, 'Virtual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `quotas` int(11) NOT NULL,
  `calendar_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `modality_id` int(11) NOT NULL,
  `state_offer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `offer`
--

INSERT INTO `offer` (`id`, `code`, `quotas`, `calendar_id`, `program_id`, `modality_id`, `state_offer_id`) VALUES
(1, '67844633', 20, 1, 2, 1, 1),
(2, '67895538', 70, 1, 4, 2, 1),
(3, '67873094', 30, 1, 1, 1, 2),
(4, '67867140', 50, 1, 3, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offer_subject`
--

CREATE TABLE `offer_subject` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `calendar_id` int(11) NOT NULL,
  `quotas` int(100) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `offer_subject`
--

INSERT INTO `offer_subject` (`id`, `subject_id`, `calendar_id`, `quotas`, `teacher_id`) VALUES
(1, 1, 1, 28, 1),
(2, 2, 1, 15, 2),
(3, 3, 1, 27, 3),
(4, 4, 1, 30, 4),
(5, 5, 1, 23, 5),
(6, 6, 1, 19, 1),
(7, 23, 1, 24, 6),
(8, 24, 1, 28, 7),
(9, 25, 1, 14, 8),
(10, 26, 1, 20, 9),
(11, 27, 1, 14, 10),
(12, 28, 1, 21, 8),
(13, 45, 1, 19, 11),
(14, 46, 1, 22, 12),
(15, 47, 1, 18, 13),
(16, 48, 1, 24, 14),
(17, 49, 1, 14, 15),
(18, 50, 1, 13, 13),
(19, 67, 1, 21, 16),
(20, 68, 1, 23, 17),
(21, 69, 1, 20, 18),
(22, 70, 1, 23, 19),
(23, 71, 1, 28, 20),
(24, 72, 1, 30, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `document` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gender` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `district_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`id`, `document`, `first_name`, `last_name`, `gender`, `district_id`, `role_id`, `image`, `email`, `phone`) VALUES
(1, '1002345678', 'Cristian Camilo', 'Solarte Duarte', 'M', 11, 2, '0001.png', 'camilo@mail.com', '3122345678'),
(2, '1024191001', 'Daniela', 'Quinones López', 'F', 4, 1, '0008.png', 'Daniela@mail.com', '3155679876'),
(3, '1024191002', 'John', 'Cardona Estrada', 'M', 17, 1, '0005.png', 'John@mail.com', '3178954353'),
(4, '1024191003', 'Santos', 'Marín Aroca', 'M', 11, 1, '0003.png', 'Santos@mail.com', '3202228830'),
(5, '1024191004', 'Iris', 'Fernanda Pampas', 'F', 5, 1, '0007.png', 'Iris@mail.com', '3225503307'),
(6, '1024191005', 'Liz', 'David Díaz', 'F', 11, 1, '0008.png', 'Liz@mail.com', '3248777784'),
(7, '1024191006', 'Alejandra', 'Rosero Boa', 'F', 12, 1, '0008.png', 'Alejandra@mail.com', '3272052261'),
(8, '1024191007', 'Doris', 'Villa Carrasco', 'F', 9, 1, '0007.png', 'Doris@mail.com', '3295326738'),
(9, '1024191008', 'Dina', 'Moreno Pérez', 'F', 10, 1, '0007.png', 'Dina@mail.com', '3228601215'),
(10, '1024191009', 'Gina', 'Bravo Villada', 'F', 15, 1, '0008.png', 'Gina@mail.com', '3041875692'),
(11, '1024191010', 'Cristian', 'Mercedes Martines', 'M', 7, 1, '0004.png', 'Cristian@mail.com', '3015150169'),
(12, '1024191011', 'Duvan', 'Cardona Mandes', 'M', 7, 1, '0002.png', 'Valdano@mail.com', '3048424646'),
(13, '1024191012', 'Paulino', 'Quispe Apoza', 'M', 5, 1, '0004.png', 'Paulino@mail.com', '3001699123'),
(14, '1024191013', 'Pinto', 'Castrillón Alegría', 'M', 15, 1, '0004.png', 'Pinto@mail.com', '3034973600'),
(15, '1024191029', 'Natalia', 'María Andrea', 'F', 11, 1, '0008.png', 'Natalia@mail.com', '3058248077'),
(16, '1024191030', 'Mario', 'Hincapié Cardona', 'M', 14, 1, '0002.png', 'Mario@mail.com', '3181522554'),
(17, '1024191014', 'Ronald', 'Flores Carrasco', 'M', 10, 1, '0004.png', 'Ronald@mail.com', '3115929607'),
(18, '1024191015', 'Luisa', 'Borda Olarte', 'F', 16, 1, '0008.png', 'Luisa@mail.com', '3172346514'),
(19, '1024191016', 'Daysi', 'Bravo Pahua', 'F', 8, 1, '0007.png', 'Daysi@mail.com', '3228763421'),
(20, '1024191017', 'Elva', 'Villa Nina', 'F', 6, 1, '0007.png', 'Elva@mail.com', '3285180328'),
(21, '1024191018', 'Juan De Dios', 'Huachara Montes', 'M', 5, 1, '0005.png', 'Juandedios@mail.com', '3041597235'),
(22, '1024191019', 'Diego', 'Vélez yepes', 'M', 5, 1, '0005.png', 'Diego@mail.com', '3138014142'),
(23, '1024191020', 'Willian', 'Flórez Vanegas', 'M', 1, 1, '0003.png', 'Willian@mail.com', '3154431049'),
(24, '1024191021', 'Jhon', 'Sánchez Estiben', 'M', 11, 1, '0002.png', 'Jhon@mail.com', '3150847956'),
(25, '1024191022', 'Cindy', 'Quintero Vásquez', 'F', 12, 1, '0007.png', 'Cindy@mail.com', '3167264863'),
(26, '1024191023', 'Juan Camilo', 'Quispe Angulo', 'M', 8, 1, '0004.png', 'Juancamilo@mail.com', '3023681770'),
(27, '1024191024', 'Geovanny', 'Flores Bravo', 'M', 8, 1, '0005.png', 'Geovanny@mail.com', '3280098677'),
(28, '1024191025', 'Gilva', 'Álzate Peña', 'F', 3, 1, '0007.png', 'Gilva@mail.com', '3036515584'),
(29, '1024191026', 'Pedro José', 'León Lopez', 'M', 15, 1, '0001.png', 'Pedrojose@mail.com', '3002932491'),
(30, '1024191027', 'Steven', 'Chocla Montoya', 'M', 14, 1, '0003.png', 'Steven@mail.com', '3249349398'),
(31, '1024191028', 'Carlos', 'Meléndez López', 'M', 16, 1, '0006.png', 'Carlos@mail.com', '3205766305'),
(32, '1024191011', 'Carlos', 'Álzate Alarcón', 'M', 16, 1, '0004.png', 'Carlos@mail.com', '3226410099'),
(33, '1024191112', 'Pinto', 'Jaime Coracha', 'M', 14, 1, '0006.png', 'Pinto@mail.com', '3156874321'),
(34, '1024191113', 'Evangelina', 'Camilo Flores', 'F', 14, 1, '0007.png', 'Evangelina@mail.com', '3223547567'),
(35, '1024191114', 'Juan', 'Ríos Manuel', 'M', 5, 1, '0005.png', 'Juan@mail.com', '3170220813'),
(36, '1024191115', 'Yeison', 'mendes Rionegro', 'M', 4, 1, '0002.png', 'Yeison@mail.com', '3156894059'),
(37, '1024191116', 'Ana', 'Aroca Mirella', 'F', 6, 1, '0007.png', 'Ana@mail.com', '3123567305'),
(38, '1024191117', 'Maicol', 'Arrosca Arias', 'M', 7, 1, '0004.png', 'Maicol@mail.com', '3010240551'),
(39, '1024191118', 'Laura', 'Olarte Hernández', 'F', 17, 1, '0008.png', 'Laura@mail.com', '3156913797'),
(40, '1024191119', 'Camila', 'Mendoza Sánchez', 'F', 8, 1, '0007.png', 'Camila@mail.com', '3123587043'),
(41, '1024191120', 'Diana', 'Gallego Cecilia', 'F', 8, 1, '0008.png', 'Diana@mail.com', '3190260289'),
(42, '1024191121', 'Juan', 'Gaviria Quintana', 'M', 1, 1, '0003.png', 'Juan@mail.com', '3156933535'),
(43, '1024191122', 'Hermelinda', 'Abelardo Boa', 'F', 6, 1, '0008.png', 'Hermelinda@mail.com', '3123606781'),
(44, '1024191123', 'Príncipe', 'angulo Jara', 'M', 7, 1, '0003.png', 'Príncipe@mail.com', '3180280027'),
(45, '1024191124', 'Alejandro', 'Pérez Ponce', 'M', 7, 1, '0005.png', 'Alejandro@mail.com', '3056953273'),
(46, '1024191130', 'Juan', 'Pérez Peralta', 'M', 6, 1, '0006.png', 'Juan@mail.com', '3023626519'),
(47, '1024191001', 'Juliana', 'salazar Peña', 'F', 11, 1, '0008.png', 'Juliana@mail.com', '3230710505'),
(48, '1024191002', 'Dina', 'caicedo Paceros', 'F', 10, 1, '0007.png', 'Dina@mail.com', '3189284756'),
(49, '1024191003', 'Érika', 'villa Alarcón', 'F', 9, 1, '0008.png', 'Érika@mail.com', '3147859007'),
(50, '1024191004', 'Gilda', 'Quispe Flores', 'F', 10, 1, '0007.png', 'Gilda@mail.com', '3106433258'),
(51, '1024191005', 'Mateo', 'Carrasco mendez', 'M', 17, 1, '0004.png', 'Mateo@mail.com', '3065007509'),
(52, '1024191006', 'Pedro', 'Peralta Díaz', 'M', 16, 1, '0003.png', 'Pedro@mail.com', '3023581760'),
(53, '1024191007', 'Wilson', 'Morales Díaz', 'M', 3, 1, '0002.png', 'Wilson@mail.com', '3282156011'),
(54, '1024191008', 'Noé', 'Borda Pachigua', 'M', 3, 1, '0006.png', 'Noé@mail.com', '3240730262'),
(55, '1024191009', 'Llanela', 'Pérez Humala', 'F', 4, 1, '0007.png', 'Llanela@mail.com', '3299304513'),
(56, '1024191010', 'Pablo', 'Arara Valverde', 'M', 4, 1, '0001.png', 'Pablo@mail.com', '3257878764'),
(57, '1024191011', 'Mari', 'Borda Peseros', 'F', 14, 1, '0007.png', 'Mari@mail.com', '3286453015'),
(58, '1024191012', 'Diana', 'Aroca Alarcón', 'F', 12, 1, '0007.png', 'Diana@mail.com', '3275027266'),
(59, '1024191013', 'Louis', 'Montoya Aroca', 'F', 6, 1, '0007.png', 'Louis@mail.com', '3273601517'),
(60, '1024191029', 'Eva', 'Borda Carrasco', 'F', 8, 1, '0007.png', 'Eva@mail.com', '3292175768'),
(61, '1024191030', 'Álvaro', 'Díaz Ochoa', 'M', 5, 1, '0004.png', 'Álvaro@mail.com', '3250750019'),
(62, '1024191211', 'Maria Alejandra', 'Angulo Alegria', 'M', 16, 3, '0003.png', 'Maria_Alejandra@mail.com', '3216410099'),
(63, '1024191212', 'Junior Andres', 'Recoba Rojas', 'M', 14, 3, '0001.png', 'Junior_Andres@mail.com', '3166874321'),
(64, '1024191213', 'Jhonas', 'Arquimedes rosero', 'F', 14, 3, '0007.png', 'Jhonas@mail.com', '3023547567'),
(65, '1024191214', 'Stiven', 'Montagua Mendez', 'M', 5, 3, '0001.png', 'Stiven@mail.com', '3180220813'),
(66, '1024191215', 'Monica', 'Duarte Mendez', 'F', 4, 3, '0007.png', 'Monica@mail.com', '3176894059'),
(67, '1024191216', 'Alba maria', 'Rodriguez Milei', 'F', 6, 3, '0007.png', 'Alba_maria@mail.com', '3103567305'),
(68, '1024191217', 'Mary', 'Zapata Lulei', 'F', 7, 3, '0007.png', 'Mary@mail.com', '3010240551'),
(69, '1024191218', 'Mirian', 'Alegria Montes', 'F', 6, 3, '0007.png', 'Mirian@mail.com', '3010240511'),
(70, '1024191219', 'Dulce Maria', 'Moreno Angulo', 'F', 3, 3, '0008.png', 'Dulce_Maria@mail.com', '3010240521'),
(71, '1024191220', 'Olga', 'Ocoro Arara', 'F', 6, 3, '0008.png', 'Olga@mail.com', '3010240351'),
(72, '1024191221', 'Mario', 'Mina Lopez', 'M', 2, 3, '0006.png', 'Mario@mail.com', '3010240451'),
(73, '1024191222', 'Carlos Julio', 'Araujo Benavides', 'M', 9, 3, '0002.png', 'CarlosJulio@mail.com', '3010240851'),
(74, '1024191223', 'Lizeth', 'Fernandez Lopez', 'F', 17, 3, '0008.png', 'Lizeth@mail.com', '3166913797'),
(75, '1024191224', 'Camilo Javier', 'Quintero Angulo', 'M', 8, 3, '0006.png', 'CamiloJavier@mail.com', '3183587043'),
(76, '1024191225', 'Diana leidy', 'Castañeda Rodriguez', 'F', 8, 3, '0007.png', 'Dianaleidy@mail.com', '3010260289'),
(77, '1024191226', 'Juan Pedro', 'Quiñones Angulo', 'M', 1, 3, '0002.png', 'JuanPedro@mail.com', '3106933535'),
(78, '1024191227', 'Jolanda', 'Mosquera Managuas', 'F', 6, 3, '0008.png', 'Jolanda@mail.com', '3128606781'),
(79, '1024191228', 'Maite', 'Mora Rivera', 'F', 7, 3, '0007.png', 'Maite@mail.com', '3150280027'),
(80, '1024191229', 'Javier Andres', 'Santa Cruz', 'M', 7, 3, '0004.png', 'JavierAndres@mail.com', '3046953273'),
(81, '1024191230', 'Lina', 'Perlaza Quiñones', 'M', 6, 3, '0002.png', 'Lina@mail.com', '3013626519');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `program`
--

INSERT INTO `program` (`id`, `name`, `description`, `image`) VALUES
(1, 'Tecnico en Manipulacion de Alimentos', 'El tecnico en manipulacion de alimentos domina las tecnicas de almacenamiento, preparacion y manipulacion, manteniendo una coreografia perfecta en la cocina. Con su conocimiento sobre normativas sanitarias y sus poderes de deteccion de peligros invisibles, este experto en alimentos es el escudo contra enfermedades alimentarias y el sello de calidad que garantiza que cada plato sea un deleite seguro para todos los comensales. En resumen, el tecnico en manipulacion de alimentos es el protagonista detras de escena, el guardian de la inocuidad y el embajador de la excelencia en la industria alimentaria, cuyo compromiso esencial es hacer que cada comida sea una experiencia deliciosa y sin preocupaciones.', '1701407266.png'),
(2, 'Tecnico en secretariado', 'El técnico en secretariado es un profesional capacitado para brindar apoyo administrativo y organizativo en entornos empresariales y de oficina. Su función principal es facilitar la gestión eficiente de las tareas administrativas y secretariales, contribuyendo al buen funcionamiento de la empresa', NULL),
(3, 'Tecnico en Administracion', 'Un técnico en administración es un profesional capacitado para desempeñar diversas funciones dentro del ámbito administrativo de una organización. Su principal objetivo es contribuir al eficiente funcionamiento de la empresa mediante la gestión de recursos y procesos administrativos', '1701986547.png'),
(4, 'Tecnico En Mecanica', 'Un técnico en mecánica es un profesional especializado en el campo de la mecánica, cuyo trabajo implica el mantenimiento, reparación y diagnóstico de sistemas mecánicos. Estos profesionales son esenciales en una variedad de industrias, incluyendo la automotriz, la manufacturera, la aeroespacial y otras áreas donde se utilizan maquinarias y equipos mecánicos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `description` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
(1, 'Estudiante'),
(2, 'Administrador'),
(3, 'Docente'),
(4, 'Aspirante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `description` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `semester`
--

INSERT INTO `semester` (`id`, `description`) VALUES
(1, 'semestre 1'),
(2, 'semestre 2'),
(3, 'semestre 3'),
(4, 'semestre 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `state`
--

INSERT INTO `state` (`id`, `description`) VALUES
(1, 'Aceptado'),
(2, 'Pendiente'),
(3, 'Rechazado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `state_offer`
--

CREATE TABLE `state_offer` (
  `id` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `state_offer`
--

INSERT INTO `state_offer` (`id`, `description`) VALUES
(1, 'abierta'),
(2, 'cerrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `admission_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `student`
--

INSERT INTO `student` (`id`, `code`, `admission_id`, `semester_id`, `person_id`, `offer_id`) VALUES
(1, '20244391', 1, 1, 2, 3),
(2, '20244647', 2, 1, 3, 3),
(3, '20242405', 3, 1, 4, 3),
(4, '20248287', 4, 1, 5, 3),
(5, '20244715', 5, 1, 6, 3),
(6, '20242924', 6, 1, 7, 3),
(7, '20248085', 7, 1, 8, 3),
(8, '20247754', 8, 1, 9, 3),
(9, '20247621', 9, 1, 10, 3),
(10, '20247158', 10, 1, 11, 3),
(11, '20241534', 11, 1, 12, 3),
(12, '20241452', 12, 1, 13, 3),
(13, '20243434', 13, 1, 14, 3),
(14, '20247113', 14, 1, 15, 3),
(15, '20248051', 15, 1, 16, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `program_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subject`
--

INSERT INTO `subject` (`id`, `description`, `program_id`, `semester_id`) VALUES
(1, 'Introducción a la Seguridad Alimentaria', 1, 1),
(2, 'Microbiología de los Alimentos', 1, 1),
(3, 'Higiene Personal', 1, 1),
(4, 'Manipulación Segura de Alimentos', 1, 1),
(5, 'Control de Plagas', 1, 1),
(6, 'Almacenamiento de Alimentos', 1, 1),
(7, 'Principios de Cocina Segura', 1, 2),
(8, 'Prevención de Contaminación Cruzada', 1, 2),
(9, 'Etiquetado y Rotulación de Alimentos', 1, 2),
(10, 'Control de Calidad', 1, 2),
(11, 'Legislación Alimentaria', 1, 2),
(12, 'Gestión de Residuos', 1, 2),
(13, 'Educación y Comunicación en Seguridad Alimentaria', 1, 3),
(14, 'Auditorías y Inspecciones', 1, 3),
(15, 'Prácticas Profesionales', 1, 3),
(16, 'Seguridad Alimentaria', 1, 3),
(17, 'Higiene y Saneamiento en la Industria Alimentaria', 1, 3),
(18, 'Microbiologia de los Alimentos', 1, 4),
(19, 'Control de Calidad en la Manipulacion de Alimentos', 1, 4),
(20, 'Tecnicas de Almacenamiento y Despacho de Alimentos', 1, 4),
(21, 'Buenas Practicas de Manufactura (BPM)', 1, 4),
(22, 'Nutrición Básica', 1, 4),
(23, 'Técnicas de secretariado', 2, 1),
(24, 'Redacción y ortografía 1', 2, 1),
(25, 'Manejo de sistemas de oficina 1', 2, 1),
(26, 'Gestión de archivos y documentos 1', 2, 1),
(27, 'Comunicación empresarial', 2, 1),
(28, 'Inglés 1', 2, 1),
(29, 'Redacción y ortografía 2', 2, 2),
(30, 'Manejo de sistemas de oficina 2', 2, 2),
(31, 'Gestión de archivos y documentos 2', 2, 2),
(32, 'Contabilidad básica', 2, 2),
(33, 'Gestión de agenda', 2, 2),
(34, 'Inglés 2', 2, 2),
(35, 'Organización de reuniones y eventos', 2, 3),
(36, 'Habilidades de comunicación oral', 2, 3),
(37, 'Ética profesional 1', 2, 3),
(38, 'Ética profesional 2', 2, 3),
(39, 'Inglés 3', 2, 3),
(40, 'Atención al cliente', 2, 4),
(41, 'Procesamiento de textos y software de oficina', 2, 4),
(42, 'Gestión de correo electrónico y correspondencia', 2, 4),
(43, 'Protocolo y etiqueta', 2, 4),
(44, 'Trabajo en equipo', 2, 4),
(45, 'Introducción a la Administración', 3, 1),
(46, 'Contabilidad Básica', 3, 1),
(47, 'Matemáticas Financieras', 3, 1),
(48, 'Informática Aplicada a la Administración', 3, 1),
(49, 'ingles 1', 3, 1),
(50, 'Gestión de Recursos Humanos', 3, 1),
(51, 'Marketing y Ventas', 3, 2),
(52, 'ingles 2', 3, 2),
(53, 'Legislación Empresarial', 3, 2),
(54, 'Economía Empresarial 1', 3, 2),
(55, 'Emprendimiento', 3, 2),
(56, 'Comunicación Empresarial', 3, 2),
(57, 'Gestión de Proyectos 1', 3, 3),
(58, 'Logística y Cadena de Suministro', 3, 3),
(59, 'Negociación Empresarial', 3, 3),
(60, 'Tecnologías de la Información en la Empresa', 3, 3),
(61, 'Finanzas Empresariales 1', 3, 3),
(62, 'Logística y Cadena de Suministro 2', 3, 4),
(63, 'Finanzas Empresariales 2', 3, 4),
(64, 'Negociación Empresarial 2', 3, 4),
(65, 'Ética Empresarial', 3, 4),
(66, 'Gestión de Proyectos 2', 3, 4),
(67, 'Matemáticas Aplicadas 1', 4, 1),
(68, 'Física 1', 4, 1),
(69, 'Diseño Mecánico', 4, 1),
(70, 'ingles 1', 4, 1),
(71, 'Termodinámica y Transferencia de Calor', 4, 1),
(72, 'Instrumentación y Medición', 4, 1),
(73, 'Física 2', 4, 2),
(74, 'Química Aplicada 1', 4, 2),
(75, 'Dinámica de Máquinas 1', 4, 2),
(76, 'Máquinas Térmicas y Motores 1', 4, 2),
(77, 'ingles 2', 4, 2),
(78, 'Matemáticas Aplicadas 1', 4, 2),
(79, 'Química Aplicada 2', 4, 3),
(80, 'Máquinas Térmicas y Motores 2', 4, 3),
(81, 'Gestión de Proyectos en Ingeniería', 4, 3),
(82, 'Ética y Responsabilidad Profesional', 4, 3),
(83, 'Dibujo Técnico', 4, 3),
(84, 'Control Automático', 4, 4),
(85, 'Dinámica de Máquinas 2', 4, 4),
(86, 'Mecánica de Sólidos', 4, 4),
(87, 'Mecánica de Fluidos', 4, 4),
(88, 'Proyecto de Ingeniería Mecánica', 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `program_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `teacher`
--

INSERT INTO `teacher` (`id`, `code`, `program_id`, `person_id`) VALUES
(1, '32459806', 1, 62),
(2, '32458047', 1, 63),
(3, '32459615', 1, 64),
(4, '32452678', 1, 65),
(5, '32456502', 1, 66),
(6, '32452228', 2, 67),
(7, '32458373', 2, 68),
(8, '32453302', 2, 69),
(9, '32452644', 2, 70),
(10, '32458918', 2, 71),
(11, '32458489', 3, 72),
(12, '32452705', 3, 73),
(13, '32455070', 3, 74),
(14, '32457916', 3, 75),
(15, '32455175', 3, 76),
(16, '32458435', 4, 77),
(17, '32454599', 4, 78),
(18, '32457688', 4, 79),
(19, '32451007', 4, 80),
(20, '32452374', 4, 81);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `person_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `person_id`, `username`, `username_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', NULL, '$2y$10$oEg/h2pcCswI3pLSqJvnO.aITZtsSVnLxAjVgzU6cufu8pDEbYzkS', NULL, '2023-12-28 12:46:11', '2023-12-28 12:46:11'),
(2, 62, '32459806', NULL, '$2y$10$VrEBI/wG.LGALjYvmOinpOf6uk9DzckEn/wENWDdbU8wqceWqb0nC', NULL, '2024-01-04 13:07:34', '2024-01-04 13:07:34'),
(3, 63, '32458047', NULL, '$2y$10$UvT2LHA37MmKtcAup1eU7OTqM/wKhXXifvbq20AXasT8oMmtOCx0O', NULL, '2024-01-04 13:07:34', '2024-01-04 13:07:34'),
(4, 64, '32459615', NULL, '$2y$10$3NXE5sdPAoqObg38uG//vOC2j7vgymHNqKJ1bGT/2PcqB.6rrjPxq', NULL, '2024-01-04 13:07:34', '2024-01-04 13:07:34'),
(5, 65, '32452678', NULL, '$2y$10$hJi7VN/O.iQD7lSUCK09zuMvfILCW9vQYtRSwa0C1K/vAiZVwKYK2', NULL, '2024-01-04 13:07:35', '2024-01-04 13:07:35'),
(6, 66, '32456502', NULL, '$2y$10$aMv2zqAM0JT.j6Ptf9nlyu7XRfvAxCPdoPHyhWiPEBelax.HW6qqS', NULL, '2024-01-04 13:07:35', '2024-01-04 13:07:35'),
(7, 67, '32452228', NULL, '$2y$10$UY3LLKa2J6vevhSppDR1Le6WGgMrQWE/5qSiYFT4bqJesj6sFDaWm', NULL, '2024-01-04 13:07:35', '2024-01-04 13:07:35'),
(8, 68, '32458373', NULL, '$2y$10$pEDoRk2Nqb9w53N4zBT7DearNGLYkmQXgrZeCAg.DoYTsI2mWz7R6', NULL, '2024-01-04 13:07:35', '2024-01-04 13:07:35'),
(9, 69, '32453302', NULL, '$2y$10$bm4mVrmwQECc2.zJVLoblOcy7h6nDAIk/EdqM53P1bmXYFDR3mW9K', NULL, '2024-01-04 13:07:35', '2024-01-04 13:07:35'),
(10, 70, '32452644', NULL, '$2y$10$EseWxXGUlv3re58QtgUZkeHdw4XykwumoVtOWbB3fN8HTQdZaKKTS', NULL, '2024-01-04 13:07:35', '2024-01-04 13:07:35'),
(11, 71, '32458918', NULL, '$2y$10$d4vBZT3pW46N/hk0TjMkA.qA3ifLbSHUJ950Vg9LXsHA67oLQVXym', NULL, '2024-01-04 13:07:36', '2024-01-04 13:07:36'),
(12, 72, '32458489', NULL, '$2y$10$oP.sJ7sq7aWn9PjQLHrkb.MEZ6GqujGQ6lLWaER8baAPEHCFL8jsi', NULL, '2024-01-04 13:07:36', '2024-01-04 13:07:36'),
(13, 73, '32452705', NULL, '$2y$10$oNpSNtGucoRiXYZmpvaie.0oQENOJ332mmCIkNdKOgFDQEzYJW6/e', NULL, '2024-01-04 13:07:36', '2024-01-04 13:07:36'),
(14, 74, '32455070', NULL, '$2y$10$yq6IqMzOYKQ2vDIwV5sn7uVukS.LRTWcOqMK7H0mG4dk5QoylC9D.', NULL, '2024-01-04 13:07:36', '2024-01-04 13:07:36'),
(15, 75, '32457916', NULL, '$2y$10$DvrRKiWKWKzUJNLi25VIO.zNgLCx72uw4ZvOgjJiOov0idNuQXeWW', NULL, '2024-01-04 13:07:37', '2024-01-04 13:07:37'),
(16, 76, '32455175', NULL, '$2y$10$pQZ/CeoGQW2QsitWKy4psuLCN.7ZcbA2C5UqGZkpYo8dE1UIotynK', NULL, '2024-01-04 13:07:37', '2024-01-04 13:07:37'),
(17, 77, '32458435', NULL, '$2y$10$JtWVC8Sy/xF1m8pqH1vqtuUK6q0BnR9z2.9Bra4eCqlUpWZg8LT.y', NULL, '2024-01-04 13:07:37', '2024-01-04 13:07:37'),
(18, 78, '32454599', NULL, '$2y$10$nYXD5oPsMCknzBRQJKRw4OJDYB1SyZPUKRVq4eSzHBKNPba3kcQ/2', NULL, '2024-01-04 13:07:37', '2024-01-04 13:07:37'),
(19, 79, '32457688', NULL, '$2y$10$3XrqoBeapxpkkUkMAE5CO.zyCeoA8ppKPEiTVJ7ECYHU3FACPYvSC', NULL, '2024-01-04 13:07:37', '2024-01-04 13:07:37'),
(20, 80, '32451007', NULL, '$2y$10$gs9iJYqikdbG3HNIRezdj.UZf0DWGVaMje28YotBfc/hy4yWOfT1q', NULL, '2024-01-04 13:07:38', '2024-01-04 13:07:38'),
(21, 81, '32452374', NULL, '$2y$10$4N4dw4OijntxU.qnQsu5oeNZ3taGTGLuOlm4K9qefrA7xJXl7oWBq', NULL, '2024-01-04 13:07:38', '2024-01-04 13:07:38'),
(22, 2, '20244391', NULL, '$2y$10$XnR0GN4lMtTsNUlvNGpb7.RXQ1xf9.gcqi689cKMok4Twd6k0wbU6', NULL, '2024-01-04 13:24:04', '2024-01-04 13:24:04'),
(23, 3, '20244647', NULL, '$2y$10$qffGBEvTPThMq3uOgRs7leaneuWJoKphiFJHCTP2.XxoHkRmFcBiS', NULL, '2024-01-04 13:24:04', '2024-01-04 13:24:04'),
(24, 4, '20242405', NULL, '$2y$10$8UR23DnRAuyXmHmRxC07y.oiHAlrsBJBgGwHi1nae8URbT6NaW9cG', NULL, '2024-01-04 13:24:04', '2024-01-04 13:24:04'),
(25, 5, '20248287', NULL, '$2y$10$XJ3dnV3ruVLhTDxbpyzqxOvM6ZO3V0L4qiXJFfuXo0HLPr3ZZxpbK', NULL, '2024-01-04 13:24:04', '2024-01-04 13:24:04'),
(26, 6, '20244715', NULL, '$2y$10$1eoRP98yLwJoEVTPEVjMl.fI8QjaCyJQMH4mYvs4Ws1LqcDOSPbAm', NULL, '2024-01-04 13:24:05', '2024-01-04 13:24:05'),
(27, 7, '20242924', NULL, '$2y$10$t7lrqQOLId60jiByyyyGSeanuaECr/gn43mCSurHfIe4RDPhhNLaS', NULL, '2024-01-04 13:24:05', '2024-01-04 13:24:05'),
(28, 8, '20248085', NULL, '$2y$10$ePGSyRrWlySxXmvipzawQeY1PmjdVrlgMa7BIAiYDF6PRd0ou1DIS', NULL, '2024-01-04 13:24:06', '2024-01-04 13:24:06'),
(29, 9, '20247754', NULL, '$2y$10$fyGMELFDaEDC7d4wDMeq6ese918Zi/7awvp33Vd0tr/6UsyMbiPE2', NULL, '2024-01-04 13:24:06', '2024-01-04 13:24:06'),
(30, 10, '20247621', NULL, '$2y$10$xsQDn5577yVDmc3qzr2xW.QXrJz0OiCcL8bju4RyHUqpM2ViDWi7y', NULL, '2024-01-04 13:24:06', '2024-01-04 13:24:06'),
(31, 11, '20247158', NULL, '$2y$10$lTPqVUgo3deqFhFlwgN8/e/ry0g4pLNBX4ptLHmFUBc0uUnWmQweu', NULL, '2024-01-04 13:24:07', '2024-01-04 13:24:07'),
(32, 12, '20241534', NULL, '$2y$10$Oe0aoGIF1zJTFN9zt7A/DulciRn0t3DLORLkCCMhCaVQct3f0FZg6', NULL, '2024-01-04 13:24:07', '2024-01-04 13:24:07'),
(33, 13, '20241452', NULL, '$2y$10$OfSOLFkYZpgAQ5laAwp/dOj1CfujX5eVkjoS8Ziw7rjA/fCbEh6eK', NULL, '2024-01-04 13:24:07', '2024-01-04 13:24:07'),
(34, 14, '20243434', NULL, '$2y$10$DFnrEXD9PqooFPi6dBQFE.FAVJLC6xial6wwc4RxzQP/XoP.YmnE2', NULL, '2024-01-04 13:24:08', '2024-01-04 13:24:08'),
(35, 15, '20247113', NULL, '$2y$10$Edos7cCNTxfNzFwtNK3vzeGeMvyk9SzwwSWQMhu72jUqnY7L7lrWi', NULL, '2024-01-04 13:24:08', '2024-01-04 13:24:08'),
(36, 16, '20248051', NULL, '$2y$10$2CfEU6AUpuMXuZcDM8Z67Oxsaq.KFykVZjDE2nbD6lz9HP7CqSdVy', NULL, '2024-01-04 13:24:08', '2024-01-04 13:24:08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_ibfk_1` (`offer_subject_id`);

--
-- Indices de la tabla `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indices de la tabla `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `inscription_subject`
--
ALTER TABLE `inscription_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`offer_subject_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modality`
--
ALTER TABLE `modality`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calendar_id` (`calendar_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `offer_ibfk_1` (`modality_id`),
  ADD KEY `offer_ibfk_2` (`state_offer_id`);

--
-- Indices de la tabla `offer_subject`
--
ALTER TABLE `offer_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `calendar_id` (`calendar_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `state_offer`
--
ALTER TABLE `state_offer`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`admission_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `person_id_2` (`person_id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indices de la tabla `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `subject_ibfk_1` (`semester_id`);

--
-- Indices de la tabla `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`),
  ADD KEY `person_id` (`person_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `admission`
--
ALTER TABLE `admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inscription_subject`
--
ALTER TABLE `inscription_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `modality`
--
ALTER TABLE `modality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `offer_subject`
--
ALTER TABLE `offer_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `state_offer`
--
ALTER TABLE `state_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`offer_subject_id`) REFERENCES `offer_subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `admission`
--
ALTER TABLE `admission`
  ADD CONSTRAINT `admission_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_admission_4` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_admission_5` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscription_subject`
--
ALTER TABLE `inscription_subject`
  ADD CONSTRAINT `inscription_subject_ibfk_2` FOREIGN KEY (`offer_subject_id`) REFERENCES `offer_subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscription_subject_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `fk_offer_16` FOREIGN KEY (`calendar_id`) REFERENCES `calendar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_offer_17` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`modality_id`) REFERENCES `modality` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offer_ibfk_2` FOREIGN KEY (`state_offer_id`) REFERENCES `state_offer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `offer_subject`
--
ALTER TABLE `offer_subject`
  ADD CONSTRAINT `offer_subject_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offer_subject_ibfk_2` FOREIGN KEY (`calendar_id`) REFERENCES `calendar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offer_subject_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `fk_person_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_person_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_student_7` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`admission_id`) REFERENCES `admission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `fk_subject_10` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `fk_teacher_15` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
