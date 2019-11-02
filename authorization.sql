-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3333
-- Время создания: Ноя 02 2019 г., 16:33
-- Версия сервера: 10.4.6-MariaDB
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `authorization`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bad_words`
--

CREATE TABLE `bad_words` (
  `id` int(11) NOT NULL,
  `word` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `bad_words`
--

INSERT INTO `bad_words` (`id`, `word`) VALUES
(6, 'блядей'),
(4, 'бляди'),
(3, 'блядь'),
(5, 'блядью'),
(7, 'блядям'),
(2, 'блядях'),
(1, 'блять'),
(22, 'заебал'),
(23, 'заебала'),
(28, 'заебали'),
(24, 'заебало'),
(21, 'заебать'),
(26, 'заебет'),
(27, 'заебут'),
(29, 'заебывает'),
(31, 'заебывают'),
(25, 'заебёт'),
(30, 'заёбывает'),
(32, 'заёбывают'),
(52, 'нахуй'),
(53, 'нахуя'),
(48, 'пезд'),
(49, 'пездам'),
(50, 'пездами'),
(51, 'пездах'),
(47, 'пезды'),
(33, 'пизда'),
(35, 'пизде'),
(37, 'пиздой'),
(36, 'пизду'),
(34, 'пизды'),
(43, 'пёзд'),
(44, 'пёздам'),
(45, 'пёздами'),
(46, 'пёздах'),
(42, 'пёзды'),
(14, 'хуе'),
(17, 'хуев'),
(13, 'хуем'),
(15, 'хуи'),
(9, 'хуй'),
(11, 'хую'),
(10, 'хуя'),
(18, 'хуям'),
(19, 'хуями'),
(20, 'хуях'),
(16, 'хуёв'),
(12, 'хуём');

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `number` varchar(10) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`id`, `user_id`, `number`, `brand`, `date`, `status`) VALUES
(113, 1, 'Ñ056Ð½Ñƒ', 'LADA Kalina', '2019-10-05', b'0'),
(115, 2, 'Ð»000Ð¾Ð»', 'Ð‘Ð£Ð“ÐÐ¢Ð˜', '2019-10-16', b'0'),
(122, 1, 'Ð»000Ð¾Ð»', 'Ð‘Ð£Ð“ÐÐ¢Ð˜', '2019-10-09', b'0'),
(123, 1, 'o000oo', 'BMW', '2019-10-12', b'0'),
(124, 2, 'a123bc', 'Ð–Ð¸Ð³ÑƒÐ»ÑŒ', '2019-10-19', b'0'),
(147, 1, '123456', 'Ð¢Ð¾Ð¹Ð¾Ñ‚Ð°', '2019-11-17', b'0'),
(162, 1, '123456', 'Ñ‹Ð²Ð°', '2019-11-24', b'0'),
(163, 1, '123456', 'bfh', '2019-11-24', b'0'),
(164, 1, '123456', 'bfh', '2019-11-24', b'0'),
(165, 1, '123456', 'bfh', '2019-11-24', b'0'),
(166, 1, '123456', 'Ñ‹Ð²Ð°', '2019-11-23', b'0'),
(167, 1, '123456', 'Ñ‹Ð²Ð°', '2019-11-22', b'0'),
(168, 1, '123123', 'Ñ‹Ð²Ð°', '2019-11-08', b'0'),
(169, 1, '765432', 'Ñ‹Ð²Ð°', '2019-11-17', b'0'),
(170, 1, '123456', 'Ñ„Ð±Ð²Ð³Ð´', '2019-11-10', b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'nikita@mail.ru', '$2y$10$P7zDKyhnEVAnyXroUtESWexdi8HLMwY/akj.SYO6YeVeAcg0SDzOm'),
(2, 'makarenko@live.com', '$2y$10$baDrQp3Zffk1dqHGBCGEk.uMMuhaDuF1mEfu6FGV.5jHNt/RTGZTC');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bad_words`
--
ALTER TABLE `bad_words`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `word` (`word`);

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bad_words`
--
ALTER TABLE `bad_words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
