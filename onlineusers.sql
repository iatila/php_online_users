-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 21 Ağu 2024, 22:42:08
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `onlineusers`
--

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_OnlineUsers` (IN `userid` INT, IN `page` VARCHAR(255), IN `minutes` TINYINT)   BEGIN
    -- Önce kayıt olup olmadığını kontrol et
    IF EXISTS (SELECT 1 FROM online_user WHERE online_user_id = userid) THEN
        -- Kayıt varsa, güncelle
        UPDATE online_user
        SET 
            online_last_time = DATE_ADD(NOW(), INTERVAL minutes MINUTE), 
            online_where = page
        WHERE online_user_id = userid;
    ELSE
        -- Kayıt yoksa, ekle
        INSERT INTO online_user (online_user_id, online_last_time, online_where)
        VALUES (userid, DATE_ADD(NOW(), INTERVAL minutes MINUTE), page);
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `online_user`
--

CREATE TABLE `online_user` (
  `online_id` smallint(5) NOT NULL,
  `online_user_id` smallint(5) NOT NULL,
  `online_where` varchar(20) NOT NULL,
  `online_last_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `online_user`
--

INSERT INTO `online_user` (`online_id`, `online_user_id`, `online_where`, `online_last_time`) VALUES
(1, 1, 'settings', '2024-08-21 23:38:10'),
(2, 2, 'home', '2024-08-21 23:33:02'),
(3, 3, 'settings', '2024-08-21 23:27:19');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_pass` varchar(80) NOT NULL,
  `user_group` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_group`) VALUES
(1, 'admin', '$2y$10$8S/I5sV9UrTOtkz3jRemO.Ib.6R.reem70r3AhQVJ7q3xNokUGnN.', 1),
(2, 'mod', '$2y$10$TXMuO7ak2Wc8yRELm/UqS.sUo.8o0Xdi5b7FCrGvotGDeuUQl4IwW', 2),
(3, 'user', '$2y$10$JiNtWG2dSviPfaSTddiRmOTkW1VVZmTvX3xaAk3E4yrUNO7L2FGy2', 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `online_user`
--
ALTER TABLE `online_user`
  ADD PRIMARY KEY (`online_id`),
  ADD KEY `online_user_id` (`online_user_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `online_user`
--
ALTER TABLE `online_user`
  MODIFY `online_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
