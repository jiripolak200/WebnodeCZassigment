-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Pon 17. úno 2025, 18:11
-- Verze serveru: 10.4.28-MariaDB
-- Verze PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `order_list`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `status` enum('pending','completed','cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `name`, `total_amount`, `currency`, `status`) VALUES
(11, '2025-02-14 20:17:27', 'Objednávka 1', 100.00, 'EUR', 'completed'),
(12, '2025-02-14 20:17:40', 'Objednávka 2', 3000.00, 'CZK', 'pending'),
(13, '2025-02-14 20:17:57', 'Objednávka 3', 2560.00, 'CZK', 'cancelled'),
(14, '2025-02-14 20:18:16', 'Objednávka 4', 250.00, 'EUR', 'pending'),
(15, '2025-02-14 20:18:36', 'Objednávka 5', 450.00, 'CZK', 'completed'),
(17, '2025-02-14 20:37:35', 'Objednávka 6', 4600.00, 'CZK', 'pending');

-- --------------------------------------------------------

--
-- Struktura tabulky `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `name`, `amount`) VALUES
(1, 11, 'Kancelřské potřeby', 25.00),
(2, 12, 'Balící potřeby', 366.00),
(3, 13, 'Kancelářské židle', 3.00),
(4, 14, 'Kancelářský nábytek', 23.00),
(5, 15, 'Vybavení kuchyně (kávovar)', 2.00);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pro tabulku `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
