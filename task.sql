-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Дек 05 2024 г., 10:07
-- Версия сервера: 8.0.35
-- Версия PHP: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `task`
--

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `title`, `description`, `image`) VALUES
(10, 'Торт 2', 'Биточки из куриного фарша получаются мягкими, сочными и нежными. Не добавляйте чеснок, репчатый лук и хлеб, иначе куриные биточки по вкусу станут похожи на котлеты.', 'uploads/cakebond.png'),
(11, '12222', 'Акутагьчапа - это довольно острая абхазская закуска. Несмотря на свое необычное название, блюдо представляет собой фаршированные яйца, начинка для которых готовится из орехов, зелени и аджики.', 'uploads/cakebond.png'),
(12, 'торт1', 'Масляный крем со сливочным сыром – это очень вкусный и несложный в приготовлении крем, который идеально подходит для наполнения и украшения тортов и пирожных.', 'uploads/cakebond.png'),
(15, 'котолетка', 'вкусная', 'uploads/images.jpeg'),
(18, '9999', '9999', 'uploads/images.jpeg'),
(19, 'кккк', 'ккккк', 'uploads/images.jpeg'),
(20, '444', '4444', 'uploads/cakebond.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
