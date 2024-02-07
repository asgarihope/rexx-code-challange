

CREATE TABLE `products` (
  `id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `sales` (
  `id` int NOT NULL,
  `sale_id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_id` (`product_id`);

ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_id` (`product_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_sale_date` (`date`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;


ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;


