-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 08 Kwi 2021, 14:55
-- Wersja serwera: 5.7.24
-- Wersja PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `januszex`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `address`
--

CREATE TABLE `address` (
  `ID` bigint(20) NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_number` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flat_number` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postoffice_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postoffice_code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `address`
--

INSERT INTO `address` (`ID`, `city`, `street`, `home_number`, `flat_number`, `postoffice_name`, `postoffice_code`) VALUES
(1, 'Michal', 'Michal', '100', '', 'Poczta2', '21-013'),
(2, 'Michal', 'Michal', '100', '100', 'Poczta', '21-013');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `administrators`
--

CREATE TABLE `administrators` (
  `ID` bigint(20) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `carts`
--

CREATE TABLE `carts` (
  `ID` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `error_reports`
--

CREATE TABLE `error_reports` (
  `ID` bigint(20) NOT NULL,
  `error_message` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `fitting_sets`
--

CREATE TABLE `fitting_sets` (
  `ID` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `fitting_product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `historical_orders`
--

CREATE TABLE `historical_orders` (
  `ID` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `order_date` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `ID` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `address_id` bigint(20) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` enum('Nieoplacone','W trakcie','Dostarczone') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`ID`, `user_id`, `address_id`, `order_date`, `status`) VALUES
(1, 1, 1, '2021-04-04 14:59:10', 'Nieoplacone'),
(2, 1, 1, '2021-04-04 14:59:25', 'Nieoplacone');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders_parts`
--

CREATE TABLE `orders_parts` (
  `ID` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `orders_parts`
--

INSERT INTO `orders_parts` (`ID`, `product_id`, `order_id`, `quantity`) VALUES
(1, 1, 2, 2),
(2, 2, 1, 3),
(3, 2, 1, 4),
(4, 1, 2, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `ID` bigint(20) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `photo_path` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `average_raiting` smallint(6) NOT NULL,
  `specification` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`ID`, `name`, `description`, `price`, `photo_path`, `average_raiting`, `specification`) VALUES
(1, 'product', 'Description', 100, 'Description', 2, 'Description'),
(2, 'product2', 'desc', 100, 'desc', 4, '1faffafa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recommended_sets`
--

CREATE TABLE `recommended_sets` (
  `ID` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `set_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `set_description`
--

CREATE TABLE `set_description` (
  `ID` bigint(20) NOT NULL,
  `description` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `address_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `name`, `surname`, `email`, `password`, `verified`, `address_id`) VALUES
(1, 'Michal', 'Michal', 'user@example.com', '$2y$10$RRQ14LF5AWQwtsRGGvmwCehn6WipzzCLJLVd/g7WJySKrWwIK8QNe', 0, 1),
(2, 'Michal', 'Michal', 'user2@example.com', '$2y$10$uDskWZzfQMdXrhBmnHRgc.XW8E.6DIZ/gMh0VpU8P1E76zRCvXfje', 0, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `verify_tokens`
--

CREATE TABLE `verify_tokens` (
  `ID` bigint(20) NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `verify_tokens`
--

INSERT INTO `verify_tokens` (`ID`, `token`, `user_id`, `expire`) VALUES
(1, '6a13504100a842303f01023c18b371a1e8d19cf48d34738a78768ff6bb2c70093140150fb5daa6abc9c66798992ff0930476', 1, '2021-04-04 15:58:42'),
(2, '02c157c5c11076ddd53c79a3bf9c4f2e4a06230f777a6654c116b86c4b3b8b1eef96cf6174d926b47c70d2d6b29de7759a8e', 2, '2021-04-04 18:22:43');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_UserCart` (`user_id`),
  ADD KEY `FK_ProductCart` (`product_id`);

--
-- Indeksy dla tabeli `error_reports`
--
ALTER TABLE `error_reports`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_UsersReports` (`user_id`);

--
-- Indeksy dla tabeli `fitting_sets`
--
ALTER TABLE `fitting_sets`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ProductIdFitting` (`product_id`),
  ADD KEY `FK_ProductFitting` (`fitting_product_id`);

--
-- Indeksy dla tabeli `historical_orders`
--
ALTER TABLE `historical_orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_HistricalUserOrder` (`user_id`),
  ADD KEY `FK_HistoricalProductOrder` (`product_id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_UserOrder` (`user_id`),
  ADD KEY `FK_OrderAddress` (`address_id`);

--
-- Indeksy dla tabeli `orders_parts`
--
ALTER TABLE `orders_parts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ProductOrder` (`product_id`),
  ADD KEY `FK_OrderPartsOrder` (`order_id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `recommended_sets`
--
ALTER TABLE `recommended_sets`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ProductRecommended` (`product_id`),
  ADD KEY `FK_SetsId` (`set_id`);

--
-- Indeksy dla tabeli `set_description`
--
ALTER TABLE `set_description`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_UserAddress` (`address_id`);

--
-- Indeksy dla tabeli `verify_tokens`
--
ALTER TABLE `verify_tokens`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `address`
--
ALTER TABLE `address`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `administrators`
--
ALTER TABLE `administrators`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `carts`
--
ALTER TABLE `carts`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `error_reports`
--
ALTER TABLE `error_reports`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `fitting_sets`
--
ALTER TABLE `fitting_sets`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `historical_orders`
--
ALTER TABLE `historical_orders`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `orders_parts`
--
ALTER TABLE `orders_parts`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `recommended_sets`
--
ALTER TABLE `recommended_sets`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `set_description`
--
ALTER TABLE `set_description`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `verify_tokens`
--
ALTER TABLE `verify_tokens`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `FK_ProductCart` FOREIGN KEY (`product_id`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `FK_UserCart` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Ograniczenia dla tabeli `error_reports`
--
ALTER TABLE `error_reports`
  ADD CONSTRAINT `FK_UsersReports` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Ograniczenia dla tabeli `fitting_sets`
--
ALTER TABLE `fitting_sets`
  ADD CONSTRAINT `FK_ProductFitting` FOREIGN KEY (`fitting_product_id`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `FK_ProductIdFitting` FOREIGN KEY (`product_id`) REFERENCES `products` (`ID`);

--
-- Ograniczenia dla tabeli `historical_orders`
--
ALTER TABLE `historical_orders`
  ADD CONSTRAINT `FK_HistoricalProductOrder` FOREIGN KEY (`product_id`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `FK_HistricalUserOrder` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_OrderAddress` FOREIGN KEY (`address_id`) REFERENCES `address` (`ID`),
  ADD CONSTRAINT `FK_UserOrder` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Ograniczenia dla tabeli `orders_parts`
--
ALTER TABLE `orders_parts`
  ADD CONSTRAINT `FK_OrderPartsOrder` FOREIGN KEY (`order_id`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `FK_ProductOrder` FOREIGN KEY (`product_id`) REFERENCES `products` (`ID`);

--
-- Ograniczenia dla tabeli `recommended_sets`
--
ALTER TABLE `recommended_sets`
  ADD CONSTRAINT `FK_ProductRecommended` FOREIGN KEY (`product_id`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `FK_SetsId` FOREIGN KEY (`set_id`) REFERENCES `set_description` (`ID`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_UserAddress` FOREIGN KEY (`address_id`) REFERENCES `address` (`ID`);

--
-- Ograniczenia dla tabeli `verify_tokens`
--
ALTER TABLE `verify_tokens`
  ADD CONSTRAINT `verify_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
