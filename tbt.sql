-- CREATE DATABASE tbt;
-- USE tbt;
CREATE TABLE role(
    role_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(100) NOT NULL
);
INSERT INTO role(role_name)
VALUES  ('Admin'),
        ('Clinician'),
        ('Patient'),
        ('Contact');
CREATE TABLE user(
    user_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    role_id INT(10) NOT NULL,
    first_name VARCHAR(200) NOT NULL,
    middle_name VARCHAR(200) NOT NULL,
    last_name VARCHAR(200) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    phone VARCHAR(20) NULL,
    email VARCHAR(255) UNIQUE NULL,
    registered_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    password varchar(255) NULL,
    FOREIGN KEY (role_id) REFERENCES role (role_id)
);
INSERT INTO user(
        role_id,
        first_name,
        middle_name,
        last_name,
        gender,
        phone,
        email,
        registered_date,
        updated_date,
        password
    )
VALUES (
        1,
        'Elizabeth',
        'Richard',
        'Shija',
        'Female',
        0724580676,
        'vennamarry07@gmail.com',
        '2022-06-11',
        '2022-06-11',
        sha1('admin123')
    );
CREATE TABLE clinician(
    clinician_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(10) NOT NULL,
    clinic_name VARCHAR(200) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user (user_id)
);
CREATE TABLE patient(
    patient_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(10) NOT NULL,
    registry_number INT(10) NOT NULL,
    prev_hospt VARCHAR(200) NOT NULL,
    interview_date VARCHAR(100) NOT NULL,
    occupation VARCHAR(100) NULL,
    FOREIGN KEY (user_id) REFERENCES user (user_id)
);
CREATE TABLE patient_info(
    info_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    patient_id INT(10) NOT NULL,
    code INT(10) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patient (patient_id)
);
CREATE TABLE contact(
    contact_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(10) NOT NULL,
    info_id INT(10) NOT NULL,
    age VARCHAR(100) NULL,
    status VARCHAR(100) NOT NULL DEFAULT ('Pending'),
    FOREIGN KEY (user_id) REFERENCES user (user_id),
    FOREIGN KEY (info_id) REFERENCES patient_info (info_id)
);
CREATE TABLE symptom(
    symptom_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    contact_id INT(10) NOT NULL,
    coughing_weeks INT(1) NULL,
    coughing_blood INT(1) NULL,
    chest_pain INT(1) NULL,
    FOREIGN KEY (contact_id) REFERENCES contact (contact_id)
);
CREATE TABLE risk_factor(
    risk_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    contact_id INT(10) NOT NULL,
    sick_person INT(1) NULL,
    weak_immune INT(1) NULL,
    condition_state INT(1) NULL,
    FOREIGN KEY (contact_id) REFERENCES contact (contact_id)
);
CREATE TABLE labtest(
    labtest_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    contact_id INT(10) NOT NULL,
    clinician_id INT(10) NOT NULL,
    FOREIGN KEY (contact_id) REFERENCES contact (contact_id),
    FOREIGN KEY (clinician_id) REFERENCES clinician (clinician_id)
);
-- note the condition column in the risk_factor table stands for:
-- 1. Living condition and
-- 2. Medical condtion.
-- also the chest_pain column stands for:
-- 1. Fever,
-- 2. Fatigue,
-- 3. Weight loss,
-- 4. Sweating,
-- 5. Loss of appetite and
-- 6. Sweating.