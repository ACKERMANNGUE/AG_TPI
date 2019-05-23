CREATE USER 'adminSecondHand'@'localhost' IDENTIFIED BY 'secondemainTPI';
GRANT SELECT, INSERT, UPDATE, DELETE ON hr_db.* TO 'adminSecondHand'@'localhost';

CREATE USER 'adminSecondHand'@'127.0.0.1' IDENTIFIED BY 'secondemainTPI';
GRANT SELECT, INSERT, UPDATE, DELETE ON hr_db.* TO 'adminSecondHand'@'127.0.0.1';

FLUSH PRIVILEGES;