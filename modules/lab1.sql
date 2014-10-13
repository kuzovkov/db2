-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 07 2014 г., 23:33
-- Версия сервера: 5.6.15
-- Версия PHP: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `lab1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `flight`
--

DROP TABLE IF EXISTS `flight`;
CREATE TABLE IF NOT EXISTS `flight` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `time_dep` time NOT NULL,
  `time_arr` time NOT NULL,
  `point_dep` varchar(255) NOT NULL,
  `point_arr` varchar(255) NOT NULL,
  `place` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `flight`
--

INSERT INTO `flight` (`time_dep`, `time_arr`, `point_dep`, `point_arr`, `place`) VALUES
('01:10:00', '05:15:00', 'Москва', 'Красноярск', 120),
('02:25:00', '05:15:00', 'Москва', 'Новосибирск', 110),
('12:20:00', '16:55:00', 'Москва', 'Уфа', 80),
('10:45:00', '12:05:00', 'Йошкар-Ола', 'Москва', 32),
('10:15:00', '15:15:00', 'Москва', 'Казань', 95),
('06:12:00', '10:14:00', 'Краснодар', 'Москва', 220),
('17:35:00', '21:40:00', 'Москва', 'Краснодар', 220),
('21:05:00', '06:15:00', 'Москва', 'Петропавловск-Камчатский', 140),
('18:15:00', '03:15:00', 'Петропавловск-Камчатский', 'Москва', 140),
('10:15:00', '15:36:00', 'Москва', 'Астрахань', 120);
-- --------------------------------------------------------

--
-- Структура таблицы `passenger`
--

DROP TABLE IF EXISTS `passenger`;
CREATE TABLE IF NOT EXISTS `passenger` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `sex` ENUM ('муж','жен') NOT NULL DEFAULT 'муж',
  `age` int(3) NOT NULL,
  `passport` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `passenger`
--

INSERT INTO `passenger` (`name`, `lastname`, `sex`, `age`, `passport`) VALUES
('Петр', 'Иванов', 'муж', 24, '1201 234586'),
('Сергей', 'Козлов', 'муж', 18, '1302 232936'),
('Елена', 'Сидорова', 'жен', 35, '1205 298586'),
('Иван', 'Сидоров', 'муж', 46, '2326 238298'),
('Иван', 'Савельев', 'муж', 23, '2502 349848'),
('Иван', 'Иванов', 'жен', 8, '1402 485489'),
('Игорь', 'Сидоров', 'муж', 17, '3001 047239'),
('Лидия', 'Воробьева', 'жен', 67, '3002 930485'),
('Степан', 'Сарычев', 'муж', 14, '3489 193944'),
('Иван', 'Сарычев', 'муж', 56, '2934 937848');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `flight_id` int(10) NOT NULL,
  `passenger` int(10) NOT NULL,
  `date_dep`  date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `ticket`
--

INSERT INTO `ticket` (`flight_id`, `passenger`, `date_dep`) VALUES
( 1, 1, '2014-09-05'),
( 2, 2, '2014-09-05'),
( 3, 3, '2014-09-05'),
( 4, 4, '2014-09-05'),
( 5, 5, '2014-09-05'),
( 6, 5, '2014-09-05'),
( 7, 1, '2014-09-05'),
( 4, 1, '2014-09-05'),
( 5, 8, '2014-09-05'),
( 1, 9, '2014-09-05'),
( 9, 1, '2014-09-05'),
( 8, 1, '2014-09-05'),
( 3, 1, '2014-09-05'),
( 5, 6, '2014-09-05'),
( 3, 6, '2014-09-05'),
(10,10, '2014-09-05');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
