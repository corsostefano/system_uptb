CREATE TABLE roles (
    id_rol INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name_rol VARCHAR(255) NOT NULL UNIQUE,
    fyh_creation DATETIME NULL,
    fyh_update DATETIME NULL,
    category ENUM('admin', 'teacher', 'student') NOT NULL,
    rol_state TINYINT(1)  -- Cambié a TINYINT si solo tienes estados como 0 y 1
) ENGINE=InnoDB;

INSERT INTO roles (name_rol, fyh_creation, rol_state) VALUES ('ADMINISTRADOR', '2024-09-24 11:57:00', 1);
INSERT INTO roles (name_rol, fyh_creation, rol_state) VALUES ('DIRECTOR ACADÉMICO', '2024-09-24 11:57:00', 1);
INSERT INTO roles (name_rol, fyh_creation, rol_state) VALUES ('DIRECTOR ADMINISTRATIVO', '2024-09-24 11:57:00', 1);
INSERT INTO roles (name_rol, fyh_creation, rol_state) VALUES ('CONTADOR', '2024-09-24 11:57:00', 1);
INSERT INTO roles (name_rol, fyh_creation, rol_state) VALUES ('SECRETARIA', '2024-09-24 11:57:00', 1);

CREATE TABLE users (
    id_user INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    identification_type CHAR(1) NOT NULL,
    cedula VARCHAR(20) NOT NULL,
    sex CHAR(1) NOT NULL,
    marital_status ENUM('Soltero', 'Casado', 'Divorciado', 'Viudo'),
    university_campus VARCHAR(100),
    education ENUM('Primaria', 'Bachiller', 'Técnico', 'Universitario', 'Postgrado', 'Doctorado', 'Otros'),
    profession VARCHAR(100),
    birth_date DATE NOT NULL,
    address_user VARCHAR(255),
    state_of_residence VARCHAR(100),
    municipality VARCHAR(100),
    rol_id INT(11) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    user_password TEXT NOT NULL,
    profile_picture VARCHAR(255),
    fyh_creation DATETIME NULL,
    fyh_update DATETIME NULL,
    user_state TINYINT(1),  -- Cambié a TINYINT si solo tienes estados como 0 y 1
    reset_token VARCHAR(100),  -- Token de recuperación de contraseña
    reset_token_expiry DATETIME,  -- Expiración del token de recuperación

    FOREIGN KEY (rol_id) REFERENCES roles (id_rol) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO users (first_name, last_name, identification_type, cedula, sex, marital_status, university_campus, education, profession, birth_date, address_user, state_of_residence, municipality, rol_id, email, user_password, profile_picture, fyh_creation, user_state)
VALUES ('Stefano Valentin', 'Corso Torres', 'V', '19612983', 'M', 'Soltero', 'Barinitas', 'Universitario', 'Desarrollador', '2024-09-18', 'San Rafael', 'Barinas', 'Bolivar', '1', 'stefanocorso6@gmail.com', '$2y$10$jFjNXWctX1BznTSDtkW1Du5KgQAbA5G7fyUfMoYGT5xikNIcxiY86', 'uploads/profile_pictures/stefano_corso_perfil.png', '2024-09-23 07:08:10', '1');

CREATE TABLE administrative (
    id_administrative       INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id                 INT (11) NOT NULL,
    fyh_creation            DATETIME NULL,
    fyh_update              DATETIME NULL,
    administrative_state    TINYINT(1)
    FOREIGN KEY (user_id) REFERENCES users (id_user) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB;
INSERT INTO administrative (
   user_id, fyh_creation, administrative_state
) VALUES (
    '1', '2024-09-23 07:08:10', '1'
);

CREATE TABLE teachers (
    id_teacher INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    specialty VARCHAR(100),           -- Especialidad del profesor
    seniority INT(3),                 -- Antigüedad en años
    fyh_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    fyh_update DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    teacher_state TINYINT(1),         -- Estado del profesor (0 = Inactivo, 1 = Activo)
    FOREIGN KEY (user_id) REFERENCES users (id_user) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE students (
    id_student INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    academic_program_id INT(11) NOT NULL,
    level_id INT(11) NOT NULL,
    campus_id INT(11) NOT NULL,
    fyh_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    fyh_update DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    student_state TINYINT(1),
    FOREIGN KEY (user_id) REFERENCES users (id_user) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (academic_program_id) REFERENCES academic_programs (id_academic_programs) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (level_id) REFERENCES levels (id_levels) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (campus_id) REFERENCES university_campuses (id_campus) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB;




CREATE TABLE institutions_configuration (
    id_config_institution  INT(11) AUTO_INCREMENT PRIMARY KEY,
    name_institution       VARCHAR(255) NOT NULL,
    profile_picture        VARCHAR(255) NULL,
    address_institution    VARCHAR(255) NOT NULL,
    phone_institution      VARCHAR(100) NULL,
    cellular_institution   VARCHAR(100) NULL,
    email_institution      VARCHAR(255) NOT NULL UNIQUE,
    fyh_creation           DATETIME NULL,
    fyh_update             DATETIME NULL,
    institution_state      TINYINT(1) DEFAULT 1
) ENGINE=InnoDB;

INSERT INTO institutions_configuration (
    name_institution, logo, address_institution, phone_institution, cellular_institution, email_institution, fyh_creation, institution_state
) VALUES (
    'Universidad Politécnica Territorial del Estado Barinas José Félix Ribas', 'upt_logo.png', 'Barinas Estado Barinas', '0000000000', '0000000000', 'sistemauptb@gmail.com', '2024-09-23 07:08:10', '1'
);

CREATE TABLE managements(
    id_management             INT(11) AUTO_INCREMENT PRIMARY KEY,
    management                VARCHAR(255) NOT NULL,
    fyh_creation           DATETIME NULL,
    fyh_update             DATETIME NULL,
    management_state          VARCHAR(11)
) ENGINE=InnoDB;

INSERT INTO managements (
    management, fyh_creation, efforts_state
) VALUES (
    'Gestión 2024', '2024-09-23 07:08:10', '1'
);

CREATE TABLE academic_programs (
    id_academic_programs   INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    management_id          INT(11) NOT NULL,
    programs_name          VARCHAR (255) NOT NULL,
    shift                  VARCHAR (255) NOT NULL, -- turno
    fyh_creation           DATETIME NULL,
    fyh_update             DATETIME NULL,
    programs_state         TINYINT(1) NOT NULL DEFAULT 1,
    FOREIGN KEY (management_id) REFERENCES managements (id_management) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO academic_programs (
    management_id, programs_name, shift, fyh_creation, programs_state
) VALUES (
    '1', 'PNF en Mecánica', 'MAÑANA', '2024-09-23 07:08:10', '1'
);

CREATE TABLE levels (
    id_levels   INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    academic_programs_id          INT(11) NOT NULL,
    years_level          VARCHAR (255) NOT NULL,
    section                  VARCHAR (255) NOT NULL, -- turno
    fyh_creation           DATETIME NULL,
    fyh_update             DATETIME NULL,
    levels_state           TINYINT(1) NOT NULL DEFAULT 1,
    FOREIGN KEY (academic_programs_id) REFERENCES academic_programs (id_academic_programs) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO levels (
    academic_programs_id, years_level, section, fyh_creation, levels_state
) VALUES (
    '2', 'PRIMER AÑO', 'A', '2024-09-23 07:08:10', '1'
);

CREATE TABLE courses (
    id_courses   INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name_course          VARCHAR (255) NOT NULL,
    fyh_creation           DATETIME NULL,
    fyh_update             DATETIME NULL,
    course_state           TINYINT(1) NOT NULL DEFAULT 1,
) ENGINE=InnoDB;
INSERT INTO courses (
    name_course, fyh_creation, course_state
) VALUES (
    'CALCULO', '2024-09-23 07:08:10', '1'
);

CREATE TABLE university_campuses (
    id_campus        INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name_campus      VARCHAR(255) NOT NULL,
    address          VARCHAR(255) NULL,
    fyh_creation     DATETIME NULL,
    fyh_update       DATETIME NULL,
    campus_state     TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;
INSERT INTO university_campuses (name_campus, address, fyh_creation, fyh_update, campus_state)
VALUES ('NÚCLEO BARINAS', NULL, NOW(), NULL, 1),
('NÚCLEO BARINITAS', NULL, NOW(), NULL, 1),
('NÚCLEO SOCOPO', NULL, NOW(), NULL, 1),
('NÚCLEO PEDRAZA', NULL, NOW(), NULL, 1);

CREATE TABLE program_campus (
    id_program_campus      INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    academic_program_id    INT(11) NOT NULL,
    campus_id              INT(11) NOT NULL,
    fyh_creation           DATETIME NULL,
    FOREIGN KEY (academic_program_id) REFERENCES academic_programs (id_academic_programs) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (campus_id) REFERENCES university_campuses (id_campus) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;



CREATE TABLE assignment (
    id_assignment                 INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    teacher_id                    INT(11) NOT NULL,
    level_courses_id              INT(11) NOT NULL, -- Relación con level_courses
    academic_programs_id          INT(11) NOT NULL,
    fyh_creation                  DATETIME NULL,
    fyh_update                    DATETIME NULL,
    assignment_state              TINYINT(1) NOT NULL DEFAULT 1,

    FOREIGN KEY (teacher_id) REFERENCES teachers (id_teacher) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (level_courses_id) REFERENCES level_courses (id_level_courses) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (academic_programs_id) REFERENCES academic_programs (id_academic_programs) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB;


CREATE TABLE level_courses (
    id_level_courses INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    course_id INT(11) NOT NULL, -- ID de la materia
    level_id INT(11) NOT NULL,  -- ID del nivel (años y secciones)
    fyh_creation DATETIME NULL,
    fyh_update DATETIME NULL,
    level_courses_state TINYINT(1) DEFAULT 1,
    FOREIGN KEY (course_id) REFERENCES courses(id_courses) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (level_id) REFERENCES levels(id_levels) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE grades (
    id_grade                    INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    assignment_id               INT(11) NOT NULL,
    student_id                  INT(11) NOT NULL,
    level_courses_id            INT(11) NOT NULL,
    final_grade_percentage      DECIMAL(5, 2) NOT NULL,
    attendance_percentage       DECIMAL(5, 2) NOT NULL,
    fyh_creation                DATETIME DEFAULT CURRENT_TIMESTAMP,
    fyh_update                  DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    grade_state                 TINYINT(1) DEFAULT 1,
    FOREIGN KEY (assignment_id) REFERENCES assignment (id_assignment) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (student_id) REFERENCES students (id_student) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (level_courses_id) REFERENCES level_courses (id_level_courses) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE academic_history(
    id_academic_history         INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    level_courses_id            INT(11) NOT NULL,
    student_id                  INT(11) NOT NULL,
    assignment_id               INT(11) NOT NULL,
    observations                VARCHAR (255) NOT NULL,
    note                        TEXT NOT NULL,
    fyh_creation                DATETIME DEFAULT CURRENT_TIMESTAMP,
    fyh_update                  DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    academic_history_state      TINYINT(1) DEFAULT 1,
    FOREIGN KEY (assignment_id) REFERENCES assignment (id_assignment) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (student_id) REFERENCES students (id_student) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (level_courses_id) REFERENCES level_courses (id_level_courses) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB;


CREATE TABLE permissions (
    id_permission     INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name_url          VARCHAR (100) NOT NULL,
    url               TEXT NOT NULL,
    fyh_creation      DATETIME DEFAULT CURRENT_TIMESTAMP,
    fyh_update        DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    permission_state  TINYINT(1) DEFAULT 1
)

CREATE TABLE roles_permissions (
    id_rol_permission      INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,

    rol_id                 INT(11) NOT NULL,
    permission_id          INT(11) NOT NULL,
 
    fyh_creation      DATETIME DEFAULT CURRENT_TIMESTAMP,
    fyh_update        DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    roles_permissions_state  TINYINT(1) DEFAULT 1,

    FOREIGN KEY (rol_id) REFERENCES roles (id_rol) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions (id_permission) ON DELETE NO ACTION ON UPDATE CASCADE
)