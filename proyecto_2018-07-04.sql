# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.20)
# Base de datos: proyecto
# Tiempo de Generación: 2018-07-04 6:04:12 a. m. +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla administradors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `administradors`;

CREATE TABLE `administradors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla areas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `areas`;

CREATE TABLE `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `areas_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;

INSERT INTO `areas` (`id`, `nombre`, `created_at`, `updated_at`)
VALUES
	(1,'Salud',NULL,NULL),
	(2,'Agro',NULL,NULL),
	(3,'Industrial',NULL,NULL),
	(4,'Mecanica',NULL,NULL),
	(5,'Mineria',NULL,NULL),
	(6,'Ciencia',NULL,NULL),
	(7,'Construccion',NULL,NULL),
	(8,'otros',NULL,NULL);

/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla calendarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `calendarios`;

CREATE TABLE `calendarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla comentarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comentarios`;

CREATE TABLE `comentarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `texto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entregable_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comentarios_id_index` (`id`),
  KEY `comentarios_entregable_id_index` (`entregable_id`),
  KEY `comentarios_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla cursos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cursos`;

CREATE TABLE `cursos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;

INSERT INTO `cursos` (`id`, `nombre`, `created_at`, `updated_at`)
VALUES
	(1,'Formulación de Proyecto de Titulación',NULL,NULL),
	(2,'Proyecto de Tìtulación',NULL,NULL);

/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla documentos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `documentos`;

CREATE TABLE `documentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Entregable_id` bigint(20) NOT NULL,
  `ruta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documentos_id_index` (`id`),
  KEY `documentos_entregable_id_index` (`Entregable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla entregables
# ------------------------------------------------------------

DROP TABLE IF EXISTS `entregables`;

CREATE TABLE `entregables` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `tarea_id` bigint(20) NOT NULL,
  `estadoEntregable_id` bigint(20) NOT NULL,
  `ruta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_padre` bigint(20) NOT NULL,
  `subidoPor` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entregables_id_index` (`id`),
  KEY `entregables_tarea_id_index` (`tarea_id`),
  KEY `entregables_estadoentregable_id_index` (`estadoEntregable_id`),
  KEY `entregables_id_padre_index` (`id_padre`),
  KEY `entregables_subidopor_index` (`subidoPor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla estadisticas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estadisticas`;

CREATE TABLE `estadisticas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla estado_cursos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estado_cursos`;

CREATE TABLE `estado_cursos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla estado_entregables
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estado_entregables`;

CREATE TABLE `estado_entregables` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_entregables_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `estado_entregables` WRITE;
/*!40000 ALTER TABLE `estado_entregables` DISABLE KEYS */;

INSERT INTO `estado_entregables` (`id`, `nombre`, `created_at`, `updated_at`)
VALUES
	(1,'Cumplido',NULL,NULL),
	(2,'No Cumplido',NULL,NULL),
	(3,'Revisado',NULL,NULL),
	(4,'En Revisión',NULL,NULL),
	(5,'Enviado',NULL,NULL);

/*!40000 ALTER TABLE `estado_entregables` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla estado_proyectos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estado_proyectos`;

CREATE TABLE `estado_proyectos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_proyectos_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `estado_proyectos` WRITE;
/*!40000 ALTER TABLE `estado_proyectos` DISABLE KEYS */;

INSERT INTO `estado_proyectos` (`id`, `estado`, `created_at`, `updated_at`)
VALUES
	(1,'Formulación',NULL,NULL),
	(2,'Proyecto titulación',NULL,NULL),
	(3,'Egresado',NULL,NULL),
	(4,'Congelado',NULL,NULL);

/*!40000 ALTER TABLE `estado_proyectos` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla estudiantes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estudiantes`;

CREATE TABLE `estudiantes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persona_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ocupado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estudiantes_id_index` (`id`),
  KEY `estudiantes_persona_id_index` (`persona_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `estudiantes` WRITE;
/*!40000 ALTER TABLE `estudiantes` DISABLE KEYS */;

INSERT INTO `estudiantes` (`id`, `nombre`, `persona_id`, `created_at`, `updated_at`, `ocupado`)
VALUES
	(7,'2010407075',2,'2018-06-25 03:25:48','2018-07-03 05:56:12',1),
	(8,'2010407072',5,'2018-06-26 02:18:42','2018-07-03 05:36:29',1),
	(9,'1212121212',6,'2018-06-26 02:22:25','2018-06-26 16:44:30',0);

/*!40000 ALTER TABLE `estudiantes` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla funcionarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `funcionarios`;

CREATE TABLE `funcionarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla herramientas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `herramientas`;

CREATE TABLE `herramientas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `herramienta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `herramientas_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla historials
# ------------------------------------------------------------

DROP TABLE IF EXISTS `historials`;

CREATE TABLE `historials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `texto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estudiante_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `historials_estudiante_id_index` (`estudiante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `historials` WRITE;
/*!40000 ALTER TABLE `historials` DISABLE KEYS */;

INSERT INTO `historials` (`id`, `texto`, `estudiante_id`, `created_at`, `updated_at`)
VALUES
	(3,'Creo el hito Documento de requisitos',2,'2018-06-25 06:15:46','2018-06-25 06:15:46'),
	(4,'Creo el hito Documento de Diseño',2,'2018-06-30 05:27:14','2018-06-30 05:27:14'),
	(5,'Creo la tarea Diagrama de Diseño en el hito Documento de Diseño',2,'2018-07-02 03:31:17','2018-07-02 03:31:17'),
	(6,'Modifico el hito Documento de Diseño',2,'2018-07-02 05:12:49','2018-07-02 05:12:49'),
	(7,'Modifico la tarea Diagrama de Diseño en el hito Documento de Diseño',2,'2018-07-02 05:19:11','2018-07-02 05:19:11'),
	(8,'Modifico la tarea Diagrama de Diseño en el hito Documento de Diseño',2,'2018-07-02 07:19:48','2018-07-02 07:19:48'),
	(9,'Creo la tarea Doc Diseño version 1 en el hito Documento de Diseño',2,'2018-07-02 07:40:01','2018-07-02 07:40:01'),
	(10,'Creo el hito Hito 1',2,'2018-07-02 08:43:54','2018-07-02 08:43:54'),
	(11,'Creo el hito hito 2',2,'2018-07-02 08:44:30','2018-07-02 08:44:30'),
	(12,'Creo la tarea Documento de requisitos en el hito Hito 1',2,'2018-07-02 08:45:24','2018-07-02 08:45:24'),
	(13,'Creo la tarea Doc en el hito Hito 1',2,'2018-07-02 08:45:43','2018-07-02 08:45:43'),
	(14,'Creo la tarea Entrevista con cliente en el hito hito 2',2,'2018-07-02 08:49:05','2018-07-02 08:49:05'),
	(15,'Creo la tarea Entrevista con cliente en el hito hito 2',2,'2018-07-02 08:49:24','2018-07-02 08:49:24'),
	(16,'Creo el hito hito3',2,'2018-07-02 08:51:44','2018-07-02 08:51:44'),
	(17,'Creo el hito hito4',2,'2018-07-02 08:52:24','2018-07-02 08:52:24'),
	(18,'Creo el hito hito 5',2,'2018-07-02 08:53:00','2018-07-02 08:53:00');

/*!40000 ALTER TABLE `historials` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla hitos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hitos`;

CREATE TABLE `hitos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` timestamp NULL DEFAULT NULL,
  `fecha_termino` timestamp NULL DEFAULT NULL,
  `proyecto_id` bigint(20) NOT NULL,
  `progreso` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hitos_id_index` (`id`),
  KEY `hitos_proyecto_id_index` (`proyecto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla invitados
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invitados`;

CREATE TABLE `invitados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` bigint(20) NOT NULL,
  `persona_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invitados_id_index` (`id`),
  KEY `invitados_persona_id_index` (`persona_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(3,'2017_11_13_024201_create_proyectos_table',2),
	(6,'2017_11_13_024435_create_rols_table',2),
	(26,'2017_11_13_025010_create_estudiantes_table',2),
	(162,'2014_10_12_100000_create_password_resets_table',6),
	(163,'2017_11_13_024331_create_tipo_proyectos_table',6),
	(164,'2017_11_13_024355_create_estado_proyectos_table',6),
	(166,'2017_11_13_024506_create_hitos_table',6),
	(167,'2017_11_13_024523_create_estado_cursos_table',6),
	(168,'2017_11_13_024541_create_documentos_table',6),
	(169,'2017_11_13_024557_create_tipo_documentos_table',6),
	(170,'2017_11_13_024624_create_estadisticas_table',6),
	(171,'2017_11_13_024659_create_repositorios_table',6),
	(173,'2017_11_13_024742_create_calendarios_table',6),
	(174,'2017_11_13_024753_create_tareas_table',6),
	(177,'2017_11_13_024833_create_entregables_table',6),
	(178,'2017_11_13_024852_create_estado_entregables_table',6),
	(180,'2017_11_13_024922_create_personas_table',6),
	(181,'2017_11_13_024938_create_administradors_table',6),
	(182,'2017_11_13_024946_create_funcionarios_table',6),
	(183,'2017_11_13_025003_create_profesor_guias_table',6),
	(186,'2017_11_13_025043_create_tipo_invitados_table',6),
	(187,'2017_11_13_025940_create_herramientas_table',6),
	(188,'2017_11_13_042104_create_estudiantes_table',6),
	(189,'2017_11_13_043439_create_areas_table',6),
	(191,'2017_11_20_000206_create_rols_table',6),
	(194,'2017_12_06_162705_create_tareas_table',8),
	(195,'2017_12_11_052901_create_estado_entregables_table',9),
	(197,'2018_04_24_033721_create_documentos_table',10),
	(199,'2017_11_13_024820_create_tipo_notificacions_table',12),
	(201,'2017_11_13_024804_create_notificacions_table',13),
	(202,'2018_05_11_004428_create_user_rols_table',14),
	(203,'2017_11_13_024449_create_cursos_table',15),
	(205,'2017_11_13_025024_create_profesor_cursos_table',16),
	(206,'2017_11_13_024732_create_historials_table',17),
	(209,'2017_11_13_024904_create_comentarios_table',19),
	(210,'2017_12_11_052951_create_entregables_table',20),
	(211,'2017_11_13_025036_create_invitados_table',21),
	(212,'2017_11_20_001859_create_users_table',22),
	(213,'2018_06_26_162021_create_years_table',23),
	(215,'2017_12_06_053444_create_hitos_table',25),
	(218,'2018_07_03_013630_create_reunions_table',26),
	(219,'2017_11_13_045201_create_proyectos_table',27);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla notificacions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notificacions`;

CREATE TABLE `notificacions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `texto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_notificacion_id` bigint(20) NOT NULL,
  `leido` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notificacions_id_index` (`id`),
  KEY `notificacions_tipo_notificacion_id_index` (`tipo_notificacion_id`),
  KEY `notificacions_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `notificacions` WRITE;
/*!40000 ALTER TABLE `notificacions` DISABLE KEYS */;

INSERT INTO `notificacions` (`id`, `texto`, `tipo_notificacion_id`, `leido`, `email`, `created_at`, `updated_at`)
VALUES
	(29,'El estudiante Hector Herrera subio un entregable en la tarea Doc Diseño version 1',0,1,'lsilvestreutalca@gmail.com','2018-07-02 08:03:55','2018-07-03 01:57:31'),
	(30,'El estudiante Hector Herrera subio un entregable en la tarea Documento de requisitos',0,1,'lsilvestreutalca@gmail.com','2018-07-02 08:45:58','2018-07-03 03:56:29'),
	(31,'El estudiante Hector Herrera subio un entregable en la tarea Entrevista con cliente',0,1,'lsilvestreutalca@gmail.com','2018-07-02 08:50:27','2018-07-03 03:56:34');

/*!40000 ALTER TABLE `notificacions` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla personas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personas_email_unique` (`email`),
  KEY `personas_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;

INSERT INTO `personas` (`id`, `nombres`, `apellidos`, `email`, `created_at`, `updated_at`)
VALUES
	(1,'Admin','Admin','admini@utalca.cl','2018-06-25 03:22:53','2018-06-25 03:22:53'),
	(2,'Hector','Herrera','hherrera10@alumnos.utalca.cl','2018-06-25 03:25:48','2018-06-25 03:25:48'),
	(3,'Profesor','Curso','hpherrera10@gmail.com','2018-06-25 05:59:59','2018-06-25 05:59:59'),
	(4,'Luis','Silvestre','lsilvestreutalca@gmail.com','2018-06-25 06:00:55','2018-06-25 06:00:55'),
	(5,'Hernan','Galvez','assafa@gmail.com','2018-06-26 02:18:42','2018-06-26 02:18:42'),
	(6,'cecwc','cwcwdc','cwc@wc.cl','2018-06-26 02:22:25','2018-06-26 02:22:25'),
	(7,'Funcionario','Utalca','funutalca@gmail.com','2018-07-03 05:21:04','2018-07-03 05:21:04');

/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla profesor_cursos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profesor_cursos`;

CREATE TABLE `profesor_cursos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `curso_id` bigint(20) NOT NULL,
  `profesor_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profesor_cursos_curso_id_index` (`curso_id`),
  KEY `profesor_cursos_profesor_id_index` (`profesor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `profesor_cursos` WRITE;
/*!40000 ALTER TABLE `profesor_cursos` DISABLE KEYS */;

INSERT INTO `profesor_cursos` (`id`, `curso_id`, `profesor_id`, `created_at`, `updated_at`)
VALUES
	(3,1,3,'2018-06-25 05:59:59','2018-06-25 05:59:59'),
	(4,1,4,'2018-07-04 01:45:36','2018-07-04 01:45:36');

/*!40000 ALTER TABLE `profesor_cursos` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla profesor_guias
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profesor_guias`;

CREATE TABLE `profesor_guias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla proyectos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `proyectos`;

CREATE TABLE `proyectos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estudiante_id` bigint(20) NOT NULL,
  `tipo_id` bigint(20) NOT NULL,
  `estado_id` bigint(20) NOT NULL,
  `progreso` int(11) NOT NULL,
  `area_id` bigint(20) NOT NULL,
  `curso_id` bigint(20) NOT NULL,
  `profesorGuia_id` bigint(20) NOT NULL,
  `year` bigint(20) NOT NULL,
  `semestre` bigint(20) NOT NULL,
  `nombre_estudiante` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proyectos_id_index` (`id`),
  KEY `proyectos_estudiante_id_index` (`estudiante_id`),
  KEY `proyectos_tipo_id_index` (`tipo_id`),
  KEY `proyectos_estado_id_index` (`estado_id`),
  KEY `proyectos_area_id_index` (`area_id`),
  KEY `proyectos_profesorguia_id_index` (`profesorGuia_id`),
  KEY `proyectos_year_index` (`year`),
  KEY `proyectos_semestre_index` (`semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `proyectos` WRITE;
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;

INSERT INTO `proyectos` (`id`, `titulo`, `estudiante_id`, `tipo_id`, `estado_id`, `progreso`, `area_id`, `curso_id`, `profesorGuia_id`, `year`, `semestre`, `nombre_estudiante`, `created_at`, `updated_at`)
VALUES
	(2,'Ventas Dominio .Cl',5,1,1,0,1,1,4,2018,1,'Hernan Galvez','2018-07-03 05:36:29','2018-07-03 05:36:29'),
	(4,'Desratización App Movile',0,2,3,0,2,2,7,2017,2,'Camilo Galvez','2018-07-03 05:46:12','2018-07-03 05:46:12'),
	(5,'Aplicación Móvil para monitorear los ritmos cardiacos',2,2,1,0,1,1,4,2017,1,'Hector Herrera','2018-07-03 05:56:12','2018-07-03 05:56:12');

/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla repositorios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `repositorios`;

CREATE TABLE `repositorios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla reunions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reunions`;

CREATE TABLE `reunions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NULL DEFAULT NULL,
  `profesor_guia_id` bigint(20) NOT NULL,
  `estudiante_id` bigint(20) NOT NULL,
  `hora` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reunions_profesor_guia_id_index` (`profesor_guia_id`),
  KEY `reunions_estudiante_id_index` (`estudiante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `reunions` WRITE;
/*!40000 ALTER TABLE `reunions` DISABLE KEYS */;

INSERT INTO `reunions` (`id`, `fecha`, `profesor_guia_id`, `estudiante_id`, `hora`, `created_at`, `updated_at`)
VALUES
	(4,'2018-07-19 00:00:00',4,2,'2018-07-19 16:00:00','2018-07-04 05:55:45','2018-07-04 05:55:45');

/*!40000 ALTER TABLE `reunions` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla rols
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rols`;

CREATE TABLE `rols` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rols_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `rols` WRITE;
/*!40000 ALTER TABLE `rols` DISABLE KEYS */;

INSERT INTO `rols` (`id`, `nombre`, `created_at`, `updated_at`)
VALUES
	(1,'Administrador',NULL,NULL),
	(2,'Funcionario',NULL,NULL),
	(3,'Profesor Guía',NULL,NULL),
	(4,'Profesor Curso',NULL,NULL),
	(5,'Estudiante',NULL,NULL),
	(6,'Invitado',NULL,NULL);

/*!40000 ALTER TABLE `rols` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla tareas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tareas`;

CREATE TABLE `tareas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_limite` timestamp NULL DEFAULT NULL,
  `comentario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hito_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tareas_id_index` (`id`),
  KEY `tareas_hito_id_index` (`hito_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla tipo_documentos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tipo_documentos`;

CREATE TABLE `tipo_documentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla tipo_invitados
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tipo_invitados`;

CREATE TABLE `tipo_invitados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `tipo_invitados` WRITE;
/*!40000 ALTER TABLE `tipo_invitados` DISABLE KEYS */;

INSERT INTO `tipo_invitados` (`id`, `nombre`, `created_at`, `updated_at`)
VALUES
	(1,'Otra Carrera',NULL,NULL),
	(2,'Empresa',NULL,NULL),
	(3,'Otros',NULL,NULL);

/*!40000 ALTER TABLE `tipo_invitados` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla tipo_notificacions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tipo_notificacions`;

CREATE TABLE `tipo_notificacions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_notificacions_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `tipo_notificacions` WRITE;
/*!40000 ALTER TABLE `tipo_notificacions` DISABLE KEYS */;

INSERT INTO `tipo_notificacions` (`id`, `tipo`, `created_at`, `updated_at`)
VALUES
	(1,'Entrega',NULL,NULL),
	(2,'Retraso',NULL,NULL),
	(3,'Alerta',NULL,NULL),
	(4,'Comentario',NULL,NULL);

/*!40000 ALTER TABLE `tipo_notificacions` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla tipo_proyectos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tipo_proyectos`;

CREATE TABLE `tipo_proyectos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_proyectos_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `tipo_proyectos` WRITE;
/*!40000 ALTER TABLE `tipo_proyectos` DISABLE KEYS */;

INSERT INTO `tipo_proyectos` (`id`, `tipo`, `created_at`, `updated_at`)
VALUES
	(1,'Investigación',NULL,NULL),
	(2,'Desarrollo',NULL,NULL);

/*!40000 ALTER TABLE `tipo_proyectos` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla user_rols
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_rols`;

CREATE TABLE `user_rols` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `rol_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_rols` WRITE;
/*!40000 ALTER TABLE `user_rols` DISABLE KEYS */;

INSERT INTO `user_rols` (`id`, `user_id`, `rol_id`, `created_at`, `updated_at`)
VALUES
	(29,39,4,NULL,NULL),
	(30,2,5,NULL,NULL),
	(31,3,4,NULL,NULL),
	(32,4,3,NULL,NULL),
	(33,5,5,NULL,NULL),
	(34,6,5,NULL,NULL),
	(36,8,5,NULL,NULL),
	(37,9,5,NULL,NULL),
	(38,10,5,NULL,NULL),
	(39,7,2,NULL,NULL),
	(99,4,4,NULL,NULL);

/*!40000 ALTER TABLE `user_rols` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol_id` bigint(20) NOT NULL,
  `login` bigint(20) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_index` (`id`),
  KEY `users_rol_id_index` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `rol_id`, `login`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'admin@utalca.cl','$2y$10$/jgGUF0R6vitvtJGrHjAOO327MMMPl9Y2TdCjEsuHLz/w0mWKYZj.',1,1,'hGl090K3yNuV6qmLVEyn4xRUu6caMycvUdBW2vnuaOGdVjW03FaqiVUb0ctq','2018-06-25 03:22:54','2018-06-25 03:22:54'),
	(2,'hherrera10@alumnos.utalca.cl','$2y$10$nzgYHlWTJRRKFq95xoYfd.6oBQjVcKpQbmAKlaT4hrygcWPhWyXRi',5,1,'E6OsoF76ck1lsNcqDfwmgdK1wNLRWe2o9DUPqoPvLa9LKuosWR1hdqhTt4eD','2018-06-25 03:25:48','2018-07-02 04:37:19'),
	(3,'hpherrera10@gmail.com','$2y$10$TTNPvH4NyrkLJi9.xezsT.UdhTi681D7zHSKTNVmbocFn.bTAsv3y',4,1,'lc4wXmHQEwnvz3u7sX4cqQEpReCHGpX9Pco3o3jsnN5P3bVp0zdCZK3DIKFW','2018-06-25 05:59:59','2018-07-02 04:21:36'),
	(4,'lsilvestreutalca@gmail.com','$2y$10$JraHG5kmK2Gz445owa74.OP27rXAU.sC9BlXEkdQ9BdgWktabKeFy',3,1,'0Cq1tY6JUPNzaBEF9l9UPtm4p1wTdIXFWT78ErkEuN91vkGCQUJ1X4gqURvv','2018-06-25 06:00:55','2018-07-04 06:02:06'),
	(5,'assafa@gmail.com','$2y$10$5mGJvc8JIb2vSNOtfFWwt.yi8Bd3UaW4rnBlI1r6Z7s48VpGHoK3O',5,0,NULL,'2018-06-26 02:18:42','2018-06-26 02:18:42'),
	(6,'cwc@wc.cl','$2y$10$LJY4sW95U7sJM8s4ewWR2eUxt4zBd88JV9zo8Q10rPa4L58IlSJW6',5,0,NULL,'2018-06-26 02:22:25','2018-06-26 02:22:25'),
	(7,'funutalca@gmail.com','$2y$10$6u.8KvqPmjahjMGPft2wbuxn8Hjpq8X6/ryV3LKPJHlJz2HzkEDdC',2,1,'pd4j9WXKSMvWr6z3xw5d9d9xNOi5UHLZnWbsxT0T1XIYrNKbh4exTFdzkZcn','2018-07-03 05:21:04','2018-07-03 05:22:16');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla years
# ------------------------------------------------------------

DROP TABLE IF EXISTS `years`;

CREATE TABLE `years` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `anio` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `years` WRITE;
/*!40000 ALTER TABLE `years` DISABLE KEYS */;

INSERT INTO `years` (`id`, `anio`, `created_at`, `updated_at`)
VALUES
	(17,2018,NULL,NULL),
	(18,2017,NULL,NULL),
	(19,2016,NULL,NULL),
	(20,2015,NULL,NULL),
	(21,2014,NULL,NULL),
	(22,2013,NULL,NULL),
	(23,2012,NULL,NULL),
	(24,2011,NULL,NULL);

/*!40000 ALTER TABLE `years` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
