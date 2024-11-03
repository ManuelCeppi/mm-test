-- migrate:up
INSERT INTO stations (name, city, street, postal_code, country_code, maximum_capacity) VALUES
('Station A', 'MusixMatch town', 'Php Guild 1', '20100', 'IT', 50),
('Station B', 'MusixMatch town', 'Gate Inn 2', '00100', 'MM', 40),
('Station C', 'MusixMatch town', 'Gostoso Market 10', '80100', 'MM', 30),
('Station D', 'MusixMatch town', 'Office Park 10', '10100', 'MM', 25),
('Station E', 'MusixMatch town', 'Python Guild 23', '50122', 'MM', 35),
('Station F', 'MusixMatch town', 'NodeJS Guild 16', '30100', 'MM', 20),
('Station G', 'MusixMatch town', 'ST. Vitale 24', '40100', 'MM', 45),
('Station H', 'MusixMatch town', 'Gate INN 53', '00100', 'MM', 30),
('Station I', 'MusixMatch town', 'West Gate 42', '37122', 'MM', 25),
('Station J', 'MusixMatch town', 'NOSQL Guild 556', '90100', 'MM', 40),
('Station K', 'MusixMatch town', 'Backend Brewery 12', '95100', 'MM', 35),
('Station L', 'MusixMatch town', 'Port 7', '43121', 'MM', 25),
('Station M', 'MusixMatch town', 'SQL Guild 3306', '06121', 'MM', 20),
('Station N', 'MusixMatch town', 'NOSQL Guild 27017', '70121', 'MM', 40),
('Station O', 'MusixMatch town', 'Backend Brewery 67', '60121', 'MM', 20),
('Station P', 'MusixMatch town', 'Temple of developers 74', '35100', 'MM', 50),
('Station Q', 'MusixMatch town', 'East Gate 56', '34121', 'MM', 30),
('Station R', 'MusixMatch town', 'Team Farm 43', '53100', 'MM', 15),
('Station S', 'MusixMatch town', 'Office Park 78', '47921', 'MM', 30),
('Station T', 'MusixMatch town', 'Backend Brewery 88', '38122', 'MM', 25);

INSERT INTO scooters (uid, name, primary_station_id, last_station_id, current_station_id, status, battery_status) VALUES
('04A1B2C3D4E5F6', 'Scooter X1', 1, 1, 1, 'available', 100.00),
('04B2C3D4E5F6A7', 'Scooter X2', 2, 2, 2, 'available', 100.00),
('04C3D4E5F6A7B8', 'Scooter X3', 3, 3, 3, 'faulted', 45.20),
('04D1E2F3A4B5C6', 'Scooter X4', 4, 1, 4, 'available', 100.00),
('04E2F3A4B5C6D7', 'Scooter X5', 5, 5, 5, 'available', 100.00),
('04F3A4B5C6D7E8', 'Scooter X6', 6, 6, NULL, 'unavailable', 52.75),
('04A4B5C6D7E8F9', 'Scooter X7', 7, 7, 7, 'available', 100.00),
('04B5C6D7E8F9A0', 'Scooter X8', 8, 8, 8, 'faulted', 20.50),
('04C6D7E8F9A0B1', 'Scooter X9', 9, 9, 1, 'rented', 60.30),
('04D7E8F9A0B1C2', 'Scooter X10', 10, 10, NULL, 'rented', 30.00),
('04E8F9A0B1C2D3', 'Scooter X11', 11, 11, 11, 'available', 100.00),
('04F9A0B1C2D3E4', 'Scooter X12', 12, 12, NULL, 'rented', 33.60),
('04A0B1C2D3E4F5', 'Scooter X13', 13, 13, 6, 'available', 100.00),
('04B1C2D3E4F5A6', 'Scooter X14', 14, 14, NULL, 'unavailable', 90.10),
('04C2D3E4F5A6B7', 'Scooter X15', 15, 15, 8, 'rented', 58.90),
('04D3E4F5A6B7C8', 'Scooter X16', 16, 16, 9, 'available', 100.00),
('04E4F5A6B7C8D9', 'Scooter X17', 17, 17, 17, 'recharging', 25.30),
('04F5A6B7C8D9E0', 'Scooter X18', 18, 18, 3, 'available', 100.00),
('04A6B7C8D9E0F1', 'Scooter X19', 19, 19, 4, 'unavailable', 40.40),
('04B7C8D9E0F1A2', 'Scooter X20', 20, 10, NULL, 'rented', 85.00);

INSERT INTO users (name, surname, country_code, email, password, phone_number, stripe_customer_id, email_verified_at, document_verified_at) VALUES
('Manuel', 'Ceppi', 'IT', 'manuel.ceppi@test.com', '$2a$12$ScAKOOgbiNEM7NbD3iogN.28PPjoFBmoI4ghq2f25wpQ8eU9u5leK', '1234567890', NULL, '2023-01-15 10:00:00', '2023-01-20 10:00:00'),
('Luigi', 'Bianchi', 'IT', 'luigi.bianchi@test.com', '$2a$12$ScAKOOgbiNEM7NbD3iogN.28PPjoFBmoI4ghq2f25wpQ8eU9u5leK', '0987654321', 'cus_456DEF', '2023-02-10 10:00:00', NULL),
('Giulia', 'Verdi', 'IT', 'giulia.verdi@test.com', '$2a$12$ScAKOOgbiNEM7NbD3iogN.28PPjoFBmoI4ghq2f25wpQ8eU9u5leK', '1122334455', 'cus_789GHI', '2023-03-05 12:00:00', '2023-03-10 12:00:00'),
('Marco', 'Neri', 'IT', 'marco.neri@test.com', '$2a$12$ScAKOOgbiNEM7NbD3iogN.28PPjoFBmoI4ghq2f25wpQ8eU9u5leK', '5566778899', 'cus_012JKL', '2023-04-20 14:00:00', '2023-04-25 14:00:00');

INSERT INTO mm_internal_users (user_id) VALUES
(1);

-- migrate:down
TRUNCATE TABLE stations;
TRUNCATE TABLE scooters;
TRUNCATE TABLE rentals;
TRUNCATE TABLE users;
TRUNCATE TABLE payments;
TRUNCATE TABLE mm_internal_users;
TRUNCATE TABLE users_payment_methods;
