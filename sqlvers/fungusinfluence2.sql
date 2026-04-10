-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 10 apr 2026 kl 12:00
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
-- Databas: `fungusinfluence2`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `parentid` int(11) NOT NULL,
  `parenttype` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `text` text NOT NULL,
  `topic` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tbl_posts`
--

INSERT INTO `tbl_posts` (`id`, `created`, `parentid`, `parenttype`, `rating`, `text`, `topic`, `userid`) VALUES
(2, '2026-04-10 09:59:28', 0, 'none', 5, 'aaaaaaaaaaaaaaa', 'aaaaaaaa', 1),
(3, '2026-04-10 09:59:45', 2, 'none', 2, 'test', '', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `id` int(11) NOT NULL,
  `rated` datetime NOT NULL DEFAULT current_timestamp(),
  `revid` int(11) NOT NULL,
  `revtype` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`id`, `rated`, `revid`, `revtype`, `score`, `userid`) VALUES
(2, '2026-04-10 11:59:30', 2, '0', 5, 1),
(3, '2026-04-10 11:59:47', 3, '0', 2, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastlogin` timestamp NOT NULL DEFAULT current_timestamp(),
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `userlevel` int(11) NOT NULL DEFAULT 10,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `created`, `lastlogin`, `mail`, `password`, `realname`, `userlevel`, `username`) VALUES
(1, '2026-04-10 09:58:33', '2026-04-10 09:58:42', '1@1', '1bbd886460827015e5d605ed44252251', '1', 10, '1');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `tbl_posts`
--
ALTER TABLE `tbl_posts`
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
-- AUTO_INCREMENT för tabell `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT för tabell `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT för tabell `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
