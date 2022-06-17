CREATE TABLE contacts (
  contact_id serial NOT NULL,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  gender varchar(100) NOT NULL,
  phone varchar(50) NOT NULL,
  district varchar(255) NOT NULL,
  region varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  labtest_status varchar(100) DEFAULT 'pending',
  date_created timestamp NOT NULL DEFAULT current_timestamp(),
  date_updated timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table contacts
--

INSERT INTO contacts (contact_id, first_name, last_name, gender, phone, district, region, password, labtest_status, date_created, date_updated) VALUES
(1, 'elizabeth', 'shija', 'female', '0767788909', 'ubungo', 'mwanza', '1234', 'negative', '2022-06-11 06:24:47', '2022-06-11 06:24:47'),
(2, 'jordan', 'michael', 'male', '0767788908', 'temeke', 'arusha', '123', 'positive', '2022-06-11 06:40:41', '2022-06-11 06:40:41'),
(3, 'robert', 'nickson', 'male', '0734568908', 'kimara', 'dar es salaam', '1234', 'positive', '2022-06-11 06:49:58', '2022-06-11 06:49:58'),
(4, 'julie', 'brown', 'female', '0746568908', 'kisasa', 'dodoma', '1234', 'positive', '2022-06-11 06:51:27', '2022-06-11 06:51:27'),
(5, 'haley', 'burell', 'female', '0646568908', 'mbezi', 'mbeya', '1234', 'positive', '2022-06-11 07:14:54', '2022-06-11 07:14:54'),
(6, 'shija', 'shija', 'male', '0646568923', 'ubng', 'aru', '1234', 'pending', '2022-06-14 15:14:34', '2022-06-14 15:14:34'),
(7, 'eliza', 'shija', 'female', '', 'ubungo', 'dar', '123', 'pending', '2022-06-14 17:54:26', '2022-06-14 17:54:26'),
(8, 'eliza', 'shija', 'female', '045989548', 'ubungo', 'dar', '123', 'pending', '2022-06-14 17:55:22', '2022-06-14 17:55:22'),
(9, 'shija', 'shija', 'female', '09876543', 'district', 'region', '1234', 'pending', '2022-06-15 15:43:10', '2022-06-15 15:43:10');

-- --------------------------------------------------------

--
-- Table structure for table patients
--

CREATE TABLE patients (
  patient_id serial NOT NULL,
  user_id INT NOT NULL,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  gender varchar(100) NOT NULL,
  date_of_birth varchar(255) DEFAULT NULL,
  id_number int(10) NOT NULL,
  registry_number varchar(100) NOT NULL,
  clinic_name varchar(255) NOT NULL,
  interview_date varchar(255) NOT NULL,
  phone int(15) NOT NULL,
  district varchar(255) NOT NULL,
  region varchar(255) NOT NULL,
  occupation varchar(255) DEFAULT NULL,
  date_created timestamp NOT NULL DEFAULT current_timestamp(),
  date_updated timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table risk_factor
--

CREATE TABLE risk_factor (
  risk_id serial NOT NULL,
  contact_id INT NOT NULL,
  sick_tb_person int(1) NOT NULL,
  living_conditions int(1) NOT NULL,
  weak_immune int(1) NOT NULL,
  unprescribed_drugs int(1) NOT NULL,
  medical_conditions int(1) NOT NULL,
  date_created date NOT NULL DEFAULT current_timestamp(),
  date_updated date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table risk_factor
--

INSERT INTO risk_factor (risk_id, contact_id, sick_tb_person, living_conditions, weak_immune, unprescribed_drugs, medical_conditions, date_created, date_updated) VALUES
(1, 5, 1, 1, 2, 1, 2, '2022-06-11', '2022-06-11');

-- --------------------------------------------------------

--
-- Table structure for table symptoms
--

CREATE TABLE symptoms (
  symptom_id serial NOT NULL,
  contact_id INT NOT NULL,
  coughing_weeks int(1) NOT NULL,
  coughing_blood int(1) NOT NULL,
  weight_loss int(1) NOT NULL,
  fever int(1) NOT NULL,
  sweating int(1) NOT NULL,
  date_created timestamp NOT NULL DEFAULT current_timestamp(),
  date_updated timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table symptoms
--

INSERT INTO symptoms (symptom_id, contact_id, coughing_weeks, coughing_blood, weight_loss, fever, sweating, date_created, date_updated) VALUES
(1, 1, 1, 2, 1, 1, 2, '2022-06-11 06:25:27', '2022-06-11 06:25:27'),
(2, 2, 1, 2, 1, 2, 1, '2022-06-11 06:48:24', '2022-06-11 06:48:24'),
(3, 3, 1, 1, 2, 1, 2, '2022-06-11 07:02:42', '2022-06-11 07:02:42'),
(4, 4, 1, 1, 2, 1, 2, '2022-06-11 07:03:39', '2022-06-11 07:03:39'),
(5, 5, 1, 2, 1, 2, 2, '2022-06-14 15:09:30', '2022-06-14 15:09:30'),
(6, 5, 1, 2, 1, 2, 2, '2022-06-14 15:10:48', '2022-06-14 15:10:48'),
(7, 6, 1, 2, 1, 1, 2, '2022-06-14 15:15:44', '2022-06-14 15:15:44');

-- --------------------------------------------------------

--
-- Table structure for table users
--

CREATE TABLE users (
  user_id serial NOT NULL,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  gender varchar(100) NOT NULL,
  clinic_name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  user_role varchar(100) NOT NULL DEFAULT 'clinician',
  date_created date NOT NULL DEFAULT current_timestamp(),
  date_updated date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table users
--

INSERT INTO users (user_id, first_name, last_name, gender, clinic_name, email, password, user_role, date_created, date_updated) VALUES
(1, 'elizabeth', 'shija', 'Female', 'muhimbili', 'vennalizzy@outlook.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2', '2022-06-10', '2022-06-10'),
(2, 'abdallah', 'koshuma', 'Male', 'bochi', 'koshuma@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1', '2022-06-10', '2022-06-10'),
(3, 'jay', 'pritchett', 'Male', 'st joseph', 'jay@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1', '2022-06-10', '2022-06-10');


--
ALTER TABLE patients
  ADD CONSTRAINT patients_ibfk_1 FOREIGN KEY (user_id) REFERENCES users (user_id);

--
-- Constraints for table risk_factor
--
ALTER TABLE risk_factor
  ADD CONSTRAINT risk_factor_ibfk_1 FOREIGN KEY (contact_id) REFERENCES contacts (contact_id);

--
-- Constraints for table symptoms
--
ALTER TABLE symptoms
  ADD CONSTRAINT symptoms_ibfk_1 FOREIGN KEY (contact_id) REFERENCES contacts (contact_id);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
