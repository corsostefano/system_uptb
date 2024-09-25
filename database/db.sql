CREATE TABLE users (
    id_user INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    full_names VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    user_password TEXT NOT NULL,
    fyh_creation DATETIME NULL,
    fyh_update DATETIME NULL,
    user_state VARCHAR(11)
) ENGINE=InnoDB;


INSERT INTO users (full_names, position, email, user_password, fyh_creation, user_state)
VALUES ('Stefano Corso', 'ADMINISTRATOR', 'stefanocorso6@gmail.com', '$2y$10$jFjNXWctX1BznTSDtkW1Du5KgQAbA5G7fyUfMoYGT5xikNIcxiY86', '2024-09-23 07:08:10', '1');

CREATE TABLE roles (
    id_rol INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name_rol VARCHAR(255) NOT NULL UNIQUE,
    fyh_creation DATETIME NULL,
    fyh_update DATETIME NULL,
    rol_state VARCHAR(11)
) ENGINE=InnoDB;
INSERT INTO roles (name_rol, fyh_creation, rol_state) VALUES ('ADMINISTRADOR', '2024-09-24 11:57:00', '1');
INSERT INTO roles (name_rol, fyh_creation, rol_state) VALUES ('DIRECTOR ACADEMICO', '2024-09-24 11:57:00', '1');
INSERT INTO roles (name_rol, fyh_creation, rol_state) VALUES ('DIRECTOR ADMINISTRATIVO', '2024-09-24 11:57:00', '1');
INSERT INTO roles (name_rol, fyh_creation, rol_state) VALUES ('CONTADOR', '2024-09-24 11:57:00', '1');
INSERT INTO roles (name_rol, fyh_creation, rol_state) VALUES ('SECRETARIA', '2024-09-24 11:57:00', '1');