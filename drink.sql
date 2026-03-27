-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 17 mars 2026 kl 13:48
-- Serverversion: 10.4.32-MariaDB
-- PHP-version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `drink`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `tbl_drinks`
--

CREATE TABLE `tbl_drinks` (
  `id` int(11) NOT NULL,
  `drinkname` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ingredients` text NOT NULL,
  `recipe` text NOT NULL,
  `alcoholic` tinyint(4) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 3 COMMENT 'posibilities'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tbl_drinks`
--

INSERT INTO `tbl_drinks` (`id`, `drinkname`, `description`, `ingredients`, `recipe`, `alcoholic`, `rating`) VALUES
(2, 'pilk', 'pepsi milk', 'pepsi\r\nmilk', '1 part pepsi 1 part milk', 0, 5),
(3, 'vatten', 'vatten', 'vatten', 'vatten', 0, 3),
(6, '1', '1', '1', '1', 1, 3);

-- --------------------------------------------------------

--
-- Tabellstruktur `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `drinkid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`id`, `userid`, `score`, `drinkid`) VALUES
(38, 1, 5, 2),
(39, 3, 5, 2),
(40, 1, 3, 3),
(43, 8, 5, 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userlevel` int(11) NOT NULL DEFAULT 10,
  `lastlogin` timestamp NOT NULL DEFAULT current_timestamp(),
  `realname` varchar(80) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `userlevel`, `lastlogin`, `realname`, `mail`, `created`) VALUES
(1, 'Eric', 'e99a18c428cb38d5f260853678922e03', 1000, '2026-02-06 10:02:15', 'Eric Andersson', 'Mailet@mail', '2026-02-06 10:02:15'),
(3, 'Eric2', 'e99a18c428cb38d5f260853678922e03', 100, '2026-02-06 10:02:15', 'Eric Andersson2', 'mail@Mailet2', '2026-02-06 10:02:15'),
(4, 'eric3', '20b40d9cacd8e094feebf93b235db3fe', 10, '2026-03-06 09:00:08', 'Eric Andersson3', 'mail@mail3.mail', '2026-03-06 09:00:08'),
(7, 'Ant', '202cb962ac59075b964b07152d234b70', 10, '2026-03-09 10:59:51', 'Anton', '13232231@gmail.com', '2026-03-09 10:59:51');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `tbl_drinks`
--
ALTER TABLE `tbl_drinks`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `tbl_drinks`
--
ALTER TABLE `tbl_drinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT för tabell `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT för tabell `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
