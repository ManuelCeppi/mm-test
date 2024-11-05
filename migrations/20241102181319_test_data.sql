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

INSERT INTO scooters (uid, name, primary_station_id, last_station_id, current_station_id, status, battery_level) VALUES
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


INSERT INTO users (name, surname, country_code, email, birth_date, default_payment_method_id, password, phone_number, payment_gateway_customer_id, email_verified_at, document_verified_at, document_verification_id) VALUES
('Manuel', 'Ceppi', 'IT', 'manuel.ceppi@test.com', "1990-01-15", NULL, '$2y$12$w5OR8VfTYgVFYsLbbTp/6ur1vLdWiTRcpV/xarG7z6YziSnzc7dfm', '1234567890', 'cus_456DsadasEF', '2023-01-15 10:00:00', '2023-01-20 10:00:00', "test_ver_id"),
('Luigi', 'Bianchi', 'IT', 'luigi.bianchi@test.com', "1990-01-15", NULL, '$2y$12$w5OR8VfTYgVFYsLbbTp/6ur1vLdWiTRcpV/xarG7z6YziSnzc7dfm', '0987654321', NULL, '2023-02-10 10:00:00', NULL, NULL),
('Giulia', 'Verdi', 'IT', 'giulia.verdi@test.com', "1990-01-15", NULL, '$2y$12$w5OR8VfTYgVFYsLbbTp/6ur1vLdWiTRcpV/xarG7z6YziSnzc7dfm', '1122334455', 'cus_789GHI', '2023-03-05 12:00:00', '2023-03-10 12:00:00', "test_ver_2_id"),
('Marco', 'Neri', 'IT', 'marco.neri@test.com', "1990-01-15", NULL, '$2y$12$w5OR8VfTYgVFYsLbbTp/6ur1vLdWiTRcpV/xarG7z6YziSnzc7dfm', '5566778899', 'cus_012JKL', '2023-04-20 14:00:00', '2023-04-25 14:00:00', "test_ver_3_id");

INSERT INTO users_payment_methods (user_id, payment_gateway_payment_method_id) VALUES
(1, "test_stripe_payment_id");

UPDATE users SET default_payment_method_id = 1 where id = 1;

INSERT INTO mm_internal_users (user_id) VALUES
(1);

INSERT INTO rates(name, description, base_amount, valid_from, valid_to, amount_per_hour, amount_per_minute, amount_per_second) VALUES
('Basic Rate', NULL, 2.9, '2023-01-01 00:00:00', NULL, 2.9, 0.6, 0.01),
('Premium Rate', NULL, 4.9, '2023-01-01 00:00:00', "2023-10-01 00:00:00", 4.9, 1.2, 0.02);


-- migrate:down
TRUNCATE TABLE stations;
TRUNCATE TABLE scooters;
TRUNCATE TABLE rentals;
TRUNCATE TABLE users;
TRUNCATE TABLE payments;
TRUNCATE TABLE mm_internal_users;
TRUNCATE TABLE users_payment_methods;
TRUNCATE TABLE personal_access_tokens;
TRUNCATE TABLE rates;
