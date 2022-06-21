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
        $text = "Welcome to TBT(TB Tracing). Select from the menu below.\n1. Register\n2. Symptom screening & risk assesment\n3. Labtest Result";
        session_ends($text);
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
            $sqlX = $connect->query("SELECT * FROM patient_info WHERE code = '$code'");
            if($sqlX->num_rows==1){
               $text ='Press 1 to proceed';
               session_proceeds($text);
            }
            else{
                $text ='Data not found';
                session_ends($text);
            }
        }
    }

    // function to check if the user already exists.
    // it should come here.
    // still trying to figure it out.

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
            
            $sqlX = $connect->query("SELECT info_id FROM patient_info WHERE code = '$data[2]'");
            $infoId = mysqli_fetch_array($sqlX)['info_id'];

            $connect->query("INSERT INTO user(role_id, first_name, middle_name, last_name, gender) VALUES (4, '$firstName', '$middleName', '$lastName', '$gender')");
            $userId = mysqli_insert_id($connect);
            $run = $connect->query("INSERT INTO contact(user_id, info_id, age) VALUES ('$userId', '$infoId', '$age')");
            if($run == false){
                die('error'.$connect);
            }
            else{
                $text = "You are registered successfully!";
                session_ends($text);
            }
        }
    }

    function screening($data)
    {
        global $connect;
        if(count($data) == 2){
            $text =  "Have you been coughing for two weeks and more?";
            session_proceeds($text);
        }
        if(count($data) == 3){
            $text = "Have you been coughing up blood or heavy mucus?";
            session_proceeds($text);
        }
        if(count($data) == 4){
            $text = "Have you been experincing chest pain or pain with breathing or coughing, fever, fatigue, weight loss, or sweating?";
            session_proceeds($text);
        }
        if(count($data) == 5){
            $text = "Have you been in contact with the person who has TB?";
            session_proceeds($text);
        }
        if(count($data) == 6){
            $text = "Do you have weak immune due to HIV/AIDS, diabetes, kidney diseases, or malnutrition?";
            session_proceeds($text);
        }
        if(count($data) == 7){
            $text = "Have you been using unprescribed drugs, or have been in clouded areas frequently?";
            session_proceeds($text);
        }
        if(count($data) == 8){
            $coughingWeeks = $data[2];
            $coughingBlood = $data[3];
            $chestPain = $data[4];
            $tbPerson = $data[5];
            $weekImmune = $data[6];
            $conditionStatus = $data[7];

            $sqlX = $connect->query("SELECT contact_id FROM contact");
            $result = $sqlX->fetch_array()['contact_id'];
            $connect->query("INSERT INTO symptom(contact_id, coughing_weeks, coughing_blood, chest_pain) 
                             VALUES('$result', '$coughingWeeks', '$coughingBlood', '$chestPain')");
            $connect->query("INSERT INTO risk_factor(contact_id, sick_person, weak_immune, condition_state)
                             VALUES('$result', '$tbPerson', '$weekImmune', '$conditionStatus')");
            $text = "You have conducted selft screening successfully!";
            session_ends($text);
        }
    }

    function labresult($data)
    {
        global $connect;
        if(count($data) == 4){
            $sqlX = $connect->query("SELECT status FROM contact");
            $row = $sqlX->fetch_array['status'];
            $text = "Labtest Status:".' '.$row['status'];
            session_ends($text);
        }
    }
?>