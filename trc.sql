CREATE TABLE contacts (
    contact_id SERIAL PRIMARY KEY ,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    gender VARCHAR(100) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    district VARCHAR(255) NOT NULL,
    region VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    labtest_status VARCHAR(100) NOT NULL,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
  user_id SERIAL PRIMARY KEY ,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  gender VARCHAR(100) NOT NULL,
  clinic_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  user_role VARCHAR(100) NOT NULL DEFAULT 1,
  date_created date NOT NULL DEFAULT CURRENT_TIMESTAMP,
  date_updated date NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE patients (
  patient_id SERIAL PRIMARY KEY ,
  user_id INT NOT NULL,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  gender VARCHAR(100) NOT NULL,
  date_of_birth VARCHAR(255) DEFAULT NULL,
  id_number INT NOT NULL,
  registry_number VARCHAR(100) NOT NULL,
  clinic_name VARCHAR(255) NOT NULL,
  INTerview_date VARCHAR(255) NOT NULL,
  phone INT NOT NULL,
  district VARCHAR(255) NOT NULL,
  region VARCHAR(255) NOT NULL,
  occupation VARCHAR(255) DEFAULT NULL,
  date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users (user_id)
);

CREATE TABLE risk_factor (
  risk_id SERIAL PRIMARY KEY ,
  contact_id INT NOT NULL,
  sick_tb_person INT NOT NULL,
  living_conditions INT NOT NULL,
  weak_immune INT NOT NULL,
  unprescribed_drugs INT NOT NULL,
  medical_conditions INT NOT NULL,
  date_created date NOT NULL DEFAULT CURRENT_TIMESTAMP,
  date_updated date NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (contact_id) REFERENCES contacts (contact_id)
);

CREATE TABLE symptoms (
  symptom_id SERIAL PRIMARY KEY ,
  contact_id INT NOT NULL,
  coughing_weeks INT NOT NULL,
  coughing_blood INT NOT NULL,
  weight_loss INT NOT NULL,
  fever INT NOT NULL,
  sweating INT NOT NULL,
  date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (contact_id) REFERENCES contacts (contact_id)
);
