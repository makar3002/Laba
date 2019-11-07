-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3333
-- Время создания: Ноя 07 2019 г., 20:13
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
-- База данных: `database`
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
-- Структура таблицы `journal_notes`
--

CREATE TABLE `journal_notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `number` varchar(12) NOT NULL,
  `mark_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `journal_notes`
--

INSERT INTO `journal_notes` (`id`, `user_id`, `number`, `mark_id`, `date`, `status`) VALUES
(210, 1, '123123', 7, '2019-11-15', b'0'),
(211, 1, '123456', 6, '2019-11-08', b'0'),
(212, 1, '234567', 5, '2019-11-30', b'0'),
(213, 1, '123123', 6, '2019-11-17', b'0'),
(214, 1, '123456', 7, '2019-11-08', b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `mark_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `marks`
--

INSERT INTO `marks` (`id`, `mark_name`) VALUES
(8, 'ghb'),
(6, 'ÐÐ¸ÐºÐ¸Ñ‚Ð°'),
(9, 'Ð²Ð°Ð¿'),
(11, 'Ð»Ð¾Ñ…'),
(10, 'Ð¼Ð°Ðº'),
(7, 'Ð›ÑŽÑ…Ñ‚ÐµÐ½ÐºÐ¾Ð»Ð¾Ñ…'),
(5, 'Ð›Ð°Ð´Ð°');

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
-- Индексы таблицы `journal_notes`
--
ALTER TABLE `journal_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `journal_notes_ibfk_2` (`mark_id`);

--
-- Индексы таблицы `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mark_name` (`mark_name`);

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
-- AUTO_INCREMENT для таблицы `journal_notes`
--
ALTER TABLE `journal_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT для таблицы `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `journal_notes`
--
ALTER TABLE `journal_notes`
  ADD CONSTRAINT `journal_notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `journal_notes_ibfk_2` FOREIGN KEY (`mark_id`) REFERENCES `marks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
