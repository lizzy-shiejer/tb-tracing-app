CREATE TABLE role (
  role_id serial PRIMARY KEY,
  role_name VARCHAR(100) NOT NULL
);

INSERT INTO role (role_id, role_name) 
VALUES (1, 'Admin'),
       (2, 'Clinician'),
       (3, 'Patient'),
       (4, 'Contact');

CREATE TABLE users (
  user_id serial PRIMARY KEY,
  role_id INT NOT NULL,
  first_name VARCHAR(200) NOT NULL,
  middle_name VARCHAR(200) NOT NULL,
  last_name VARCHAR(200) NOT NULL,
  gender VARCHAR(20) NOT NULL,
  phone VARCHAR(20),
  email VARCHAR(255),
  registered_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  password VARCHAR(255),
  FOREIGN KEY (role_id) REFERENCES role (role_id)
);

INSERT INTO users (user_id, role_id, first_name, middle_name, last_name, gender, phone, email, registered_date, updated_date, password) 
VALUES (1, 1, 'Elizabeth', 'Richard', 'Shija', 'Female', '724580676', 'vennamarry07@gmail.com', '2022-06-10 21:00:00', '2022-06-10 21:00:00', 'f865b53623b121fd34ee5426c792e5c33af8c227');

CREATE TABLE clinician (
  clinician_id serial PRIMARY KEY,
  user_id INT NOT NULL,
  clinic_name VARCHAR(200) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users (user_id)
);

CREATE TABLE patient (
  patient_id serial PRIMARY KEY,
  user_id INT NOT NULL,
  registry_number INT NOT NULL,
  prev_hospt VARCHAR(200) NOT NULL,
  interview_date VARCHAR(100) NOT NULL,
  occupation VARCHAR(100),
  FOREIGN KEY (user_id) REFERENCES users (user_id)
);

CREATE TABLE patient_info (
  info_id serial PRIMARY KEY,
  patient_id INT NOT NULL,
  code INT NOT NULL,
  phone VARCHAR(20) NOT NULL,
  FOREIGN KEY (patient_id) REFERENCES patient (patient_id)
);

CREATE TABLE contact (
  contact_id serial PRIMARY KEY,
  user_id INT NOT NULL,
  info_id INT NOT NULL,
  age VARCHAR(100),
  status VARCHAR(100) NOT NULL DEFAULT 'Pending',
  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (info_id) REFERENCES patient_info (info_id)
);

CREATE TABLE symptom (
  symptom_id serial PRIMARY KEY,
  contact_id INT NOT NULL,
  coughing_weeks INT,
  coughing_blood INT,
  chest_pain INT,
  FOREIGN KEY (contact_id) REFERENCES contact (contact_id)
);

CREATE TABLE risk_factor (
  risk_id serial PRIMARY KEY,
  contact_id INT NOT NULL,
  sick_person INT,
  weak_immune INT,
  condition_state INT,
  FOREIGN KEY (contact_id) REFERENCES contact (contact_id)
);


CREATE TABLE labtest (
  labtest_id serial PRIMARY KEY,
  contact_id INT NOT NULL,
  clinician_id INT NOT NULL,
  FOREIGN KEY (contact_id) REFERENCES contact (contact_id),
  FOREIGN KEY (clinician_id) REFERENCES clinician (clinician_id)
);
