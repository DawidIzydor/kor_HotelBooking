-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Maj 2016, 22:17
-- Wersja serwera: 10.1.10-MariaDB
-- Wersja PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `hotel_booking`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `booking_start_date` int(11) NOT NULL,
  `booking_end_date` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int(8) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `hotel_location` varchar(255) NOT NULL,
  `hotel_min_price` int(8) NOT NULL DEFAULT '0',
  `hotel_max_price` int(8) NOT NULL DEFAULT '0',
  `hotel_rooms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `hotel_name`, `hotel_location`, `hotel_min_price`, `hotel_max_price`, `hotel_rooms`) VALUES
(1, 'Dubai pro one hotel', 'Dubai', 50, 225, 6),
(2, 'Krakow Second First', 'Krakow', 25, 77, 4),
(4, 'Marseille Lux Perpetua', 'Marseille', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(8) NOT NULL,
  `hotel_id` int(8) NOT NULL,
  `room_capacity` int(8) NOT NULL,
  `room_price` int(8) NOT NULL,
  `room_user_status_req` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `rooms`
--

INSERT INTO `rooms` (`room_id`, `hotel_id`, `room_capacity`, `room_price`, `room_user_status_req`) VALUES
(1, 1, 24, 50, 1),
(5, 1, 12, 67, 1),
(6, 1, 12, 67, 1),
(7, 1, 12, 67, 1),
(8, 2, 55, 29, 1),
(9, 2, 55, 25, 1),
(10, 2, 55, 25, 1),
(12, 1, 1, 58, 2),
(13, 2, 6, 77, 1),
(15, 1, 225, 225, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(8) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_level` smallint(4) NOT NULL DEFAULT '1',
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_birthdate` int(8) NOT NULL,
  `user_adress` varchar(255) NOT NULL,
  `user_tel` int(8) NOT NULL,
  `user_status` smallint(4) NOT NULL DEFAULT '1',
  `user_deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_level`, `user_firstname`, `user_lastname`, `user_birthdate`, `user_adress`, `user_tel`, `user_status`, `user_deleted`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 99, '', '', 0, '', 0, 1, 0),
(2, 'mayor', 'dd51a825d06aae5299fc74d5ff1dc90aaa44128faa72167cdf1618db84b7c543', 10, '', '', 0, '', 0, 1, 0);

--
-- Indeksy dla zrzutów tabel
--
	
--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
