-- migrate:up

-- stations table
CREATE TABLE stations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    street VARCHAR(255) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    country_code CHAR(2) NOT NULL,
    maximum_capacity INT NOT NULL,
    INDEX(country_code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- scooters table
CREATE TABLE scooters (
    id INT PRIMARY KEY AUTO_INCREMENT,
    uid CHAR(20) NOT NULL,
    name VARCHAR(255) NOT NULL,
    primary_station_id INT NOT NULL, -- the primary station of the scooter, the one where it first has been configurated
    last_station_id INT NOT NULL, -- the station where the last trip started
    current_station_id INT NULL, -- the station where it's currently located and in charging status
    status ENUM('available', 'unavailable', 'faulted', 'recharging', 'rented') DEFAULT 'available', 
    battery_status DECIMAL(5,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (primary_station_id) REFERENCES stations(id),
    FOREIGN KEY (last_station_id) REFERENCES stations(id),
    FOREIGN KEY (current_station_id) REFERENCES stations(id),
    INDEX (primary_station_id),
    INDEX (last_station_id),
    INDEX (current_station_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    country_code CHAR(2) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15),
    default_payment_method_id INT NULL,
    payment_gateway_customer_id CHAR(20) NULL,
    email_verified_at TIMESTAMP NULL,
    document_verified_at TIMESTAMP NULL,
    auth_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (email),
    INDEX (payment_gateway_customer_id),
    UNIQUE KEY payment_gateway_customer_id_unique_constraint (payment_gateway_customer_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `personal_access_tokens` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` VARCHAR(255) NOT NULL,
  `tokenable_id` BIGINT UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `token` VARCHAR(64) NOT NULL,
  `abilities` TEXT,
  `last_used_at` TIMESTAMP NULL DEFAULT NULL,
  `expires_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE users_payment_methods (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    payment_gateway_payment_method_id CHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    UNIQUE KEY payment_gateway_payment_method_id_unique_constraint (payment_gateway_payment_method_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- add foreign to users 
ALTER TABLE users ADD FOREIGN KEY (default_payment_method_id) REFERENCES users_payment_methods(id);

CREATE TABLE mm_internal_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- payment_intents table
CREATE TABLE payment_intents (
    id INT PRIMARY KEY AUTO_INCREMENT,
    payment_gateway_intent_id VARCHAR(255) NOT NULL UNIQUE,
    charge_id VARCHAR(255) NULL,
    charge_description VARCHAR(255) NOT NULL,
    charge_status ENUM('pending', 'failed', 'succeded', 'aborted') DEFAULT 'pending',
    charged_at TIMESTAMP NULL,
    user_id INT NOT NULL,
    payment_method_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY charge_id_unique_constraint (charge_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (payment_method_id) REFERENCES users_payment_methods(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- rentals
CREATE TABLE rentals (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    payment_intent_id INT NOT NULL,
    payment_gateway_intent_id VARCHAR(255) NOT NULL UNIQUE,
    starting_station_id INT NOT NULL,
    ending_station_id INT NULL,
    start_date TIMESTAMP NOT NULL,
    end_date TIMESTAMP NULL, 
    duration_seconds INT NULL,
    scooter_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    status ENUM('starting', 'ongoing', 'finished', 'failed') DEFAULT 'starting',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (payment_intent_id) REFERENCES payment_intents(id),
    FOREIGN KEY (payment_gateway_intent_id) REFERENCES payment_intents(payment_gateway_intent_id),
    FOREIGN KEY (starting_station_id) REFERENCES stations(id),
    FOREIGN KEY (ending_station_id) REFERENCES stations(id),
    FOREIGN KEY (scooter_id) REFERENCES scooters(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- migrate:down
DROP TABLE stations;
DROP TABLE scooters;
DROP TABLE rentals;
DROP TABLE users;
DROP TABLE payment_intents;
DROP TABLE mm_internal_users;
