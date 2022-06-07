-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Cze 2022, 00:27
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `auth`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `nazwa_produktu` varchar(255) NOT NULL,
  `ilość_produktu` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cena` int(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `nazwa_produktu`, `ilość_produktu`, `email`, `cena`) VALUES
(1, 'Grabie', '1', NULL, NULL),
(2, 'Wąż', '1', NULL, NULL),
(3, 'Sekator', '1', NULL, NULL),
(4, 'Grabie', '1', NULL, NULL),
(5, 'Wąż', '1', NULL, NULL),
(6, 'Sekator', '1', NULL, NULL),
(7, 'Grabie', '1', NULL, NULL),
(8, 'Wąż', '3', NULL, NULL),
(12, 'Grabie', '2', '1@1', 30),
(13, 'Wąż', '3', '1@1', 60),
(14, 'Sekator', '4', '1@1', 80);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `image`, `price`) VALUES
(1, 'Grabie', './images/1.jpg', 30),
(2, 'Wąż', './images/2.jpg', 60),
(3, 'Sekator', './images/3.jpg', 80);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `secondname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `email`, `passwordHash`, `name`, `secondname`) VALUES
(1, 'jkowalski@firma.pl', '$argon2i$v=19$m=16,t=2,p=1$ejk0cXFwdmRVQjNOUExyVg$HIYIPn/4cCFD1zHizS3fTA', '', ''),
(2, 'jkowalski@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$TFVKQUJVcnJFUGtsNGhRSg$+UsdsnsqWfymb+dbU4qakoul3fz2hjUyfyofEbOXts8', '', ''),
(3, 'anyshhere@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$RUNNWkE5dWQzY3dNUHU3Zw$MyVixsy2X9D97Jg3A0JEP0xTgJC739632c+CyZPa8K4', '', ''),
(4, 'anyshhere1@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$bG1KTll6NmZBV0JLZG0zNg$i8yEr4EymISn9QOZvnSjI2XHuJzDFsz6jMS7wvURWIU', '', ''),
(5, 'anyshhere2@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$UVI1VXVjZHZ2NE1URmNlWQ$VjOBZxk+1M2dOZw4p6/7ZnTWM6vQHPW5neOXN9KAEOo', 'kacper', 'aneszko'),
(6, 'anysh2@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$YnpBMEFHOVBWVjdjSnU2Yw$t0ix6k7Ks7jIHaK+eKIgMsVfPxISL/ANF9rXMHI3UPQ', 'kacper', 'aneszko'),
(8, 'anyshhere3@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$RFV6N3dreklvRWtkQkhKMw$hJQ3WgA04xnS6dmB7Vc8lg1Ycmu9vt8wMpdk8m3sbiE', 'Janusz', 'Mikke'),
(9, 'bocian@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$MG5ZTHRsTEFiMFZDSlBFUg$KTwHgcRZAYGXUYfQX9AsKDAZYIdN4BPym38qMcH6ldA', 'janusz', 'korwin'),
(10, 'kawcper.aneszko@onet.pl', '$argon2i$v=19$m=65536,t=4,p=1$QWIvS3N6MXJjTS56OTFhdw$lVZsytS6t22RyGnYfliq9QK9u3E8ZsI4o+49eZ1NOD4', 'Mariusz', 'Pudzianowski'),
(12, 'anysh3@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$NHpWNXZKU3Q4WkRaQlh5eQ$PYb0Alv4yz4wGSZA0ph1PWQVUHOmPB3t6P03zmTZmlM', 'Marcin', 'Kasztan'),
(13, '1@1', '$argon2i$v=19$m=65536,t=4,p=1$ZVdUQVNKQlRyNklyV0Qxaw$latTDly568A5O9e5HBgUYmYqII3dvrY14w9pVycntgg', 'test', 'test');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
