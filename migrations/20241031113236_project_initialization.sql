-- migrate:up

-- stations table
CREATE TABLE stations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    street VARCHAR(255) NOT NULL,
    number INT NOT NULL,
    country_code CHAR(2) NOT NULL,
    maximum_capacity INT NOT NULL,
    INDEX(country_code)
) ENGINE=InnoDB;

-- scooters table
CREATE TABLE scooters (
    id INT PRIMARY KEY AUTO_INCREMENT,
    uid CHAR(20) NOT NULL,
    name VARCHAR(255) NOT NULL,
    primary_station_id INT NOT NULL, -- the primary station of the scooter, the one where it first has been configurated
    last_station_id INT NOT NULL, -- the station where the last trip started
    current_station_id INT NULL, -- the station where it's currently located and in charging status
    status ENUM('available', 'unavailable', 'faulted') DEFAULT 'available', 
    battery_status DECIMAL(5,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (primary_station_id) REFERENCES station(id),
    FOREIGN KEY (last_station_id) REFERENCES station(id),
    FOREIGN KEY (current_station_id) REFERENCES station(id),
    INDEX (primary_station_id),
    INDEX (last_station_id),
    INDEX (current_station_id)
) ENGINE=InnoDB;

-- users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    country_code CHAR(2) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15),
    stripe_customer_id CHAR(20) NULL,
    email_verified_at TIMESTAMP NULL,
    document_verified_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (email),
    INDEX (stripe_customer_id),
    UNIQUE KEY stripe_id_unique_constraint (stripe_customer_id)
) ENGINE=InnoDB;

-- TODO maybe roles and permissions?
CREATE TABLE mm_internal_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id)
) ENGINE=InnoDB;

CREATE TABLE mm_internal_users_permissions (
    user_id INT NOT NULL,
    permission_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(user_id, permission_id)
) ENGINE=InnoDB;

CREATE TABLE permissions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- stripe payments table
CREATE TABLE payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    intent_id VARCHAR(255) NOT NULL UNIQUE,
    charge_id VARCHAR(255) NULL,
    charge_description VARCHAR(255) NOT NULL,
    charge_status ENUM('pending', 'failed', 'succeded', 'aborted') DEFAULT 'pending',
    charged_at TIMESTAMP NULL,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY charge_id_unique_constraint (charge_id)
) ENGINE=InnoDB;

-- migrate:down
DROP TABLE stations;
DROP TABLE scooters;
DROP TABLE users;
DROP TABLE payments;
DROP TABLE mm_internal_users;
DROP TABLE mm_internal_users_permissions;
DROP TABLE permissions;
