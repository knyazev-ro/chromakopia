CREATE DATABASE chromakopia CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

CREATE USER chromakopia_user IDENTIFIED BY '123';

GRANT ALL PRIVILEGES ON chromakopia.* TO chromakopia_user;

FLUSH PRIVILEGES;