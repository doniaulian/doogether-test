-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Des 2020 pada 05.03
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hiring-backend`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'doogether', 1, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `session`
--

CREATE TABLE `session` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `session`
--

INSERT INTO `session` (`ID`, `userID`, `name`, `description`, `start`, `duration`, `created`, `updated`) VALUES
(1, 1, 'Zumba with Achmad Sulaca', 'best zumba ever!', '2020-12-10 13:15:00', 60, '2020-11-17 13:52:10', '2020-12-09 11:02:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ID`, `name`, `email`, `password`, `created`, `updated`) VALUES
(1, 'Achmad Saiful', 'ahmad.saiful@gmail.com', 'coba', '2020-11-17 13:51:37', '2020-11-17 13:51:37'),
(3, 'Sandra', 'sandra@gmail.com', 'sandra123', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Sulthan', 'sulthan@gmail.com', 'sulthan123', '2020-12-05 10:59:37', '2020-12-05 10:59:37'),
(5, 'Dika', 'dika@gmail.com', 'dika123', '2020-12-05 11:01:17', '2020-12-05 11:01:17'),
(6, 'Danu Raharjo', 'danu@gmail.com', 'danu123', '2020-12-05 05:02:04', '2020-12-05 05:04:12'),
(7, 'Sony', 'sony@gmail.com', 'ab37ef761177c0aeb730e1d10cbced5c', '2020-12-07 08:00:21', '2020-12-07 08:00:21'),
(8, 'Sonya', 'sonya@gmail.com', 'ab37ef761177c0aeb730e1d10cbced5c', '2020-12-07 12:22:10', '2020-12-07 12:22:10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_session_user_idx` (`userID`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `session`
--
ALTER TABLE `session`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `fk_session_user` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
