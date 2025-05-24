CREATE DATABASE IF NOT EXISTS ctf;
USE ctf;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL
);
INSERT INTO users (username, password) VALUES
  ('admin', 's3cur3p4ssw0rd635$#294'),
  ('guest', '4llTh3Th1ngsEver$6ejoSS');

CREATE TABLE IF NOT EXISTS flags (
  id INT AUTO_INCREMENT PRIMARY KEY,
  flag VARCHAR(255) NOT NULL
);
INSERT INTO flags (flag) VALUES
  ('TCC{f4ke_fl4g}');

CREATE DATABASE IF NOT EXISTS ctf_debug;
USE ctf_debug;

CREATE TABLE IF NOT EXISTS users (
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL
);
INSERT INTO users (username, password) VALUES
  ('admin', 'fakepassword'),
  ('guest', 'fakepassword');

CREATE USER 'debug'@'%' IDENTIFIED BY 'debugpass';
GRANT USAGE ON *.* TO 'debug'@'%';
GRANT SELECT ON ctf_debug.* TO 'debug'@'%';
FLUSH PRIVILEGES;
