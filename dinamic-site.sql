-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 11 2022 г., 12:55
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dinamic-site`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `page` int NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `page`, `comment`, `status`, `create_date`) VALUES
(1, 61, 19, '222222222222222', 1, '2022-11-10 16:28:11'),
(2, 61, 19, 'Гигант мысли, отец валакавкаской демократии.', 1, '2022-11-10 20:32:34'),
(3, 61, 22, 'Где мои бананы?', 1, '2022-11-10 20:39:53');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint NOT NULL,
  `create_data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `topic_id`, `title`, `img`, `content`, `status`, `create_data`) VALUES
(18, 61, 18, 'Бля а чё писать22222?3333', '1667989047_Обезьяна 4.jpg', '<p>Да дап иа</p>', 0, '2022-11-07 13:04:50'),
(19, 61, 18, 'Бля а чё писать?', '1667903460_Обезьяна 6.jpg', '<p>Да дап иа</p>', 1, '2022-11-07 13:05:11'),
(20, 61, 18, 'И значит . . .', '1667903468_Обезьяна 7.jpg', '<p>Первым уроком был татарский</p>', 1, '2022-11-07 13:05:39'),
(21, 61, 18, 'бля', '1667815776_Обезьяна 4.jpg', '<p>ляб</p>', 1, '2022-11-07 13:09:36'),
(22, 61, 18, 'Такой момент', '1667904429_Обезьяна 1.jpg', '<p>Чуточку потише, самую малость.</p>', 1, '2022-11-08 13:47:09'),
(23, 61, 18, 'Я помню минимум', '1667904459_Обезьяна 7.jpg', '<p>А кто такой Ел Джэй?</p>', 1, '2022-11-08 13:47:39'),
(24, 61, 18, 'Что будет если я добавлю. . .', '1667904519_Обезьяна 7.jpg', '<p>больше записей в категорию ТОП ПОСТ?</p>', 1, '2022-11-08 13:48:39'),
(25, 61, 18, 'Кончаются', '1667904551_Обезьяна 5.jpg', '<p>Кончаются валакасы для картинок</p>', 1, '2022-11-08 13:49:11'),
(28, 61, 18, '2222222222222222222', '1667999853_Обезьяна 3.jpg', '<p>33333333333333333333333333</p>', 1, '2022-11-09 16:17:33'),
(29, 61, 18, '4444444444444444444', '1667999866_Обезьяна 5.jpg', '<p>4444444444444444444444444</p>', 1, '2022-11-09 16:17:46'),
(30, 61, 18, '5555555555555555555555', '1667999881_Обезьяна 3.jpg', '<p>6666666666666666666666666666</p>', 1, '2022-11-09 16:18:01');

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `topic_id` int NOT NULL,
  `topic_name` varchar(121) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_name`, `description`) VALUES
(14, 's.c.u.m.', 'Бро ты знаешь эти 4 буквы, мен'),
(15, 'DEEEM', '222'),
(16, 'DAP DAP YA', '22222'),
(17, '2222', '222'),
(18, 'ТОП Публикаций', 'Публикации, которые будут выводиться в Слайд бар (каруселька на главной)');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `admin` tinyint NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `admin`, `username`, `email`, `password`, `created`) VALUES
(45, 1, '2@2', '2@2', '$2y$10$jnIjq8fBPiKaD1vgic9Ynet9v1NP7AqRl.wT0QgLVijkP1DJVQ3xe', '2022-10-19 18:28:26'),
(46, 0, '3@3', '3@3', '$2y$10$5ro1LXs0AlRZfxALbQSZf.KBPoLfH/7QV4vUcU.ViUczbD4yejqcG', '2022-10-19 18:29:42'),
(47, 1, '4@4', '4@4', '$2y$10$tSgjF7nVHUpmannA4/4LheC3X.xiKIoW2woS3Y47B5eMTn/4lEcOe', '2022-10-19 18:30:59'),
(48, 1, '51', '5@5', '$2y$10$VycHv1cQCwPrm6tEJsz33u7tFHF3aU8d0QRu75xt6u8h6lopl48iS', '2022-10-19 18:32:18'),
(49, 0, '66', '6@6', '$2y$10$XkUElKuAdD410V/nvh07oul24yP5oHXURlmC3JknsIVh6fK8lST2W', '2022-10-19 18:32:35'),
(50, 0, '54323333', '7@7', '$2y$10$O78vtmYIaDlB0lYcREz4/ubyRKHnp.d6b00x8kT2MW.nTGGxa6jAO', '2022-10-20 10:45:52'),
(51, 0, '5432111111', '7@71', '$2y$10$4NKUoIc2cTybn1S2LvWafONJrj0gZTd7zwOT0yzuaM1rdQp6kXVQm', '2022-10-20 10:47:59'),
(52, 0, '9@9', '9@9', '$2y$10$TH3DtBPNjDBCPp5ajjiY.e6T/R9u4YYX5.QZHJtaoRpbH30Zbp7lq', '2022-10-20 10:48:17'),
(53, 0, 'MAMOEB', 'MARATNAHUIIDI@SUETA.COM', '$2y$10$EbTBlNIZEusviPBHo6ogsu1O3TobL1TgXgvl4YFEosgP14C0uGVJG', '2022-10-25 12:33:03'),
(54, 0, 'DEMBOY', '2@23', '$2y$10$2.c3uEPJP/67Jhw83uf0FOYKkU2eynl0tXMm7/uoDLDkLASR08xl.', '2022-10-25 18:26:48'),
(55, 0, 'demboy', 'dem@boy', '$2y$10$A6eLA6ba2C7/4ECAXqbBCe7T.H9lPQGua8UxmFwlPb5JHt1VzEbWm', '2022-10-26 18:32:05'),
(56, 0, 'SweetBoy', 'Sweet@boy', '$2y$10$1kdJQt9Y0ljXOc5qqPIm1OYXUyz6XTEXS2ksb0NzTi9uM/GuKOkOu', '2022-10-26 18:33:34'),
(57, 0, '1111', '11@11', '$2y$10$Nny.11I8B6v8xaVXfWrTRuKeZk/LFzJP9KYYkej0z9zAy1xjxqrdS', '2022-10-31 09:44:16'),
(58, 1, '22', '22@22', '$2y$10$83tDMfL8D53JF1U2ur/0X.XAUlj6v83zgmaswnLjmS1P46PeZ70AG', '2022-10-31 09:44:55'),
(59, 0, '4444', '222@222', '$2y$10$puNijnJSr1jIAo31EwFJQeKOxrDKlHmWr4KY4i9ZHib.Fs1mJ4uEu', '2022-10-31 10:06:19'),
(60, 1, '1222', '1@222', '$2y$10$PVtmcI8DYMtsTkvrYId7Le04cPde0..l2sB46.qgUpTGFGONTDdo6', '2022-11-01 03:26:49'),
(61, 1, '111', '1@1', '$2y$10$uKGj3V6cGUF2Gar/s77OH.vc09hgN/OL0.hNP../QJFkptFzrOcom', '2022-11-03 10:14:34'),
(62, 0, 'Tolya', 'DaDaSyper@DaYA', '$2y$10$im4dib616juy7455Xd.e...98b/ciUXD/n0fEFk7Z4hRGOI9R7oPW', '2022-11-08 18:30:58'),
(63, 0, 'PojilayaBlyamba', 'valera1965@gadza.com', '$2y$10$yj/to1JyBNvikArSgzELD.YYiQgTv.7nPuk1EqxN6l.iVjzMBVQie', '2022-11-09 11:30:03');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD UNIQUE KEY `name` (`topic_name`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
