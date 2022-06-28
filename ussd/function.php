<?php
    function session_proceeds($text)
    {
        echo "CON".' '.$text;
    }

    function session_ends($text)
    {
        echo "END".' '.$text;
    }

    function main_menu()
    {
        $text = "Welcome to TBT(TB Tracing). Select from the menu below.\n1. Register\n2. Symptom screening\n3. Risk assesment\n4. Labtest Result";
        session_proceeds($text);
    }
    
    function code($data)
    {
        global  $connect;
        if(count($data) == 2){
            $text = "Please entercode";
            session_proceeds($text);
        }
        if(count($data) == 3){
            $code = $data[2];
            $sqlX = pg_query($connect, "SELECT * FROM patient_info WHERE code = '$code'");
            if(pg_num_rows($sqlX) == 1){
               $text ='Press 1 to proceed';
               session_proceeds($text);
            }
            else{
                $text ='Data not found';
                session_ends($text);
            }
        }
    }

    function register($data)
    {
        global $connect;
        if(count($data) == 4){
            $text = "Enter your First Name";
            session_proceeds($text);
        }
        if(count($data) == 5){
            $text = "Enter your Middle Name";
            session_proceeds($text);
        }
        if(count($data) == 6){
            $text = "Enter your Last Name";
            session_proceeds($text);
        }
        if(count($data) == 7){
            $text = "Enter your Gender";
            session_proceeds($text);
        }
        if(count($data) == 8){
            $text = "Enter your Age";
            session_proceeds($text);
        }
        if(count($data) == 9){
            $firstName = $data[4];
            $middleName = $data[5];
            $lastName = $data[6];
            $gender = $data[7];
            $age = $data[8];
            
            $sqlX = pg_query($connect, "SELECT info_id FROM patient_info WHERE code = '$data[2]'");
            $infoId = pg_fetch_array($sqlX)['info_id'];

            $sql = pg_query($connect, "INSERT INTO users(role_id, first_name, middle_name, last_name, gender) 
                                       VALUES (4, '$firstName', '$middleName', '$lastName', '$gender') RETURNING user_id");
            $userId = pg_fetch_assoc($sql)['user_id'];
            $run = pg_query($connect, "INSERT INTO contact(user_id, info_id, age) 
                                       VALUES ('$userId', '$infoId', '$age')");
            if($run == false){
                die('error'.$connect);
            }
            else{
                $text = "You are registered successfully!";
                session_ends($text);
            }
        }
    }

    // function check()
    // {
    //     global $connect;
    //     $sqlX = pg_query($connect, "SELECT * FROM contact");
    //     if(pg_num_rows($sqlX) == true){
    //         $text = "This enrty code has already been screening or risk assesment";
    //         session_ends($text);
    //     }
    // }

    function screening($data)
    {
        global $connect;
        if(count($data) == 4){
            // check();
            $text =  "Have you been coughing for two weeks and more?\n1. YES\n2. NO";
            session_proceeds($text);                     
        }
        if(count($data) == 5){
            $text = "Have you been coughing up blood or heavy mucus?\n1. YES\n2. NO";
            session_proceeds($text);
        }
        if(count($data) == 6){
            $text = "Have you been experincing chest pain or pain with breathing or coughing, fever, fatigue, weight loss, or sweating?\n1. YES\n2. NO";
            session_proceeds($text);
        }
        if(count($data) == 7){
            $coughingWeeks = $data[4];
            $coughingBlood = $data[5];
            $chestPain = $data[6];

            $sqlX = pg_query($connect, "SELECT contact_id FROM contact");
            $result = pg_fetch_array($sqlX)['contact_id'];
            pg_query($connect, "INSERT INTO symptom(contact_id, coughing_weeks, coughing_blood, chest_pain) 
                                VALUES('$result', '$coughingWeeks', '$coughingBlood', '$chestPain')");
            $text = "You have conducted selft screening successfully!";
            session_ends($text);
        }
    }

    function risk($data)
    {
        global $connect;
        if(count($data) == 4){
            $text = "Have you been in contact with the person who has TB?\n1. YES\n2. NO";
            session_proceeds($text);
        }
        if(count($data) == 5){
            $text = "Do you have weak immune due to HIV/AIDS, diabetes, kidney diseases, or malnutrition?\n1. YES\n2. NO";
            session_proceeds($text);
        }
        if(count($data) == 6){
            $text = "Have you been using unprescribed drugs, or have been in clouded areas frequently?\n1. YES\n2. NO";
            session_proceeds($text);
        }
        if(count($data) == 7){
            $tbPerson = $data[4];
            $weekImmune = $data[5];
            $conditionStatus = $data[6];

            $sqlX = pg_query($connect, "SELECT contact_id FROM contact");
            $result = pg_fetch_array($sqlX)['contact_id'];
            pg_query($connect, "INSERT INTO risk_factor(contact_id, sick_person, weak_immune, condition_state)
                                VALUES('$result', '$tbPerson', '$weekImmune', '$conditionStatus')");
            $text = "You have conducted risk assesment successfully!";
            session_ends($text);
        }
    }

    function labresult($data)
    {
        global $connect;
        if(count($data) == 4){
            $code = $data[2];
            $sqlX = pg_query($connect, "SELECT contact.status 
                                        FROM patient_info
                                        INNER JOIN contact
                                        ON contact.info_id = patient_info.info_id
                                        WHERE code = '$code'");
            $row = pg_fetch_assoc($sqlX)['status'];
            $text = "Labtest Status:".' '.$row;
            session_ends($text);
        }
    }
?>