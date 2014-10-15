-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 15 2014 г., 15:05
-- Версия сервера: 5.6.15
-- Версия PHP: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `lab2`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `flight`
--

INSERT INTO `flight` (`id`, `time_dep`, `time_arr`, `point_dep`, `point_arr`, `place`) VALUES
(1, '01:10:00', '05:15:00', 'Москва', 'Красноярск', 120),
(2, '02:25:00', '05:15:00', 'Москва', 'Новосибирск', 110),
(3, '12:20:00', '16:55:00', 'Москва', 'Уфа', 80),
(4, '10:45:00', '12:05:00', 'Йошкар-Ола', 'Москва', 32),
(5, '10:15:00', '15:15:00', 'Москва', 'Казань', 95),
(6, '06:12:00', '10:14:00', 'Краснодар', 'Москва', 220),
(7, '17:35:00', '21:40:00', 'Москва', 'Краснодар', 220),
(8, '21:05:00', '06:15:00', 'Москва', 'Петропавловск-Камчатский', 140),
(9, '18:15:00', '03:15:00', 'Петропавловск-Камчатский', 'Москва', 140),
(10, '10:15:00', '15:36:00', 'Москва', 'Астрахань', 120);

-- --------------------------------------------------------

--
-- Структура таблицы `passenger`
--

DROP TABLE IF EXISTS `passenger`;
CREATE TABLE IF NOT EXISTS `passenger` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `sex` enum('муж','жен') NOT NULL DEFAULT 'муж',
  `age` int(3) NOT NULL,
  `passport` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `passenger`
--

INSERT INTO `passenger` (`id`, `name`, `lastname`, `sex`, `age`, `passport`, `foto`) VALUES
(1, 'Петр', 'Иванов', 'муж', 24, '1201 234586', 'e7bea82cc0af355a7c0bd0b7fd4030f0.jpg'),
(2, 'Сергей', 'Козлов', 'муж', 18, '1302 232936', '46682f5e735ec99b55f4c113071b925c.jpg'),
(3, 'Елена', 'Сидорова', 'жен', 35, '1205 298586', 'ba6eb2055bfddd21a0cb9402f637db07.jpg'),
(4, 'Иван', 'Сидоров', 'муж', 46, '2326 238298', 'ee39c0fbdd13b5fb56eb043aa43d45ef.jpg'),
(5, 'Иван', 'Савельев', 'муж', 23, '2502 349848', '3ac92abbc85a4926d0a980a594dd0317.jpg'),
(7, 'Игорь', 'Сидоров', 'муж', 17, '3001 047239', '6edfe219eeac0c28b302c9ec6e7b21ad.jpg'),
(8, 'Лидия', 'Воробьева', 'жен', 67, '3002 930485', '3f13014cda7e1096e467473ada61ce2c.jpg'),
(9, 'Степан', 'Сарычев', 'муж', 14, '3489 193944', 'dc6a213c8d9abedc0a2ac59bf0aa832c.jpg'),
(10, 'Иван', 'Сарычев', 'муж', 56, '2934 937848', '');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `flight_id` int(10) NOT NULL,
  `passenger` int(10) NOT NULL,
  `date_dep` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `ticket`
--

INSERT INTO `ticket` (`id`, `flight_id`, `passenger`, `date_dep`) VALUES
(1, 1, 1, '2014-09-05'),
(2, 2, 2, '2014-09-05'),
(3, 3, 3, '2014-09-05'),
(4, 4, 4, '2014-09-05'),
(5, 5, 5, '2014-09-05'),
(6, 6, 5, '2014-09-05'),
(7, 7, 1, '2014-09-05'),
(8, 4, 1, '2014-09-05'),
(9, 5, 8, '2014-09-05'),
(10, 1, 9, '2014-09-05'),
(11, 9, 1, '2014-09-05'),
(12, 8, 1, '2014-09-05'),
(13, 3, 1, '2014-09-05'),
(16, 10, 10, '2014-09-05');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
