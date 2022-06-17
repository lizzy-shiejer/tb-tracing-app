<?php
    // function to display main menu
    function main_menu()
    {
        $text = "Welcome! for tuberculosis self-screening\n1.Register\n2.Symptoms Screening\n3.TB Risk Assessment\n4.Labtest Result";
        ussd_proceed($text);
    }

    // function that indicate the session continues
    function ussd_proceed($text)
    {
        echo "CON". " ". $text;
    }

    // function to check if the cotanct is already registered
    function check_contact($phone)
    {
        global $connect;
        $check_query = "SELECT * FROM contacts WHERE phone='$phone'";
        $result = pg_query($connect, $check_query);
        $check = pg_num_rows($result);
        if($check > 0)
        {
            $text = "$phone has already been registered";
            ussd_stop($text);
        }
    }

    // function to register users
    function register_contact($data)
    {
        global $connect;

        if(count($data) == 2)
        {
            $text = "Enter your first name";
            ussd_proceed($text);
        }
        if(count($data) == 3)
        {
            $text = "Enter your last name";
            ussd_proceed($text);
        }
        if(count($data) == 4)
        {
            $text = "Enter your gender (Male or Female)";
            ussd_proceed($text);
        }
        if(count($data) == 5)
        {
            $text = "Enter your district";
            ussd_proceed($text);
        }
        if(count($data) == 6)
        {
            $text = "Enter your region";
            ussd_proceed($text);
        }
        if(count($data) == 7)
        {
            $text = "Enter your password";
            ussd_proceed($text);
        }
        if(count($data) == 8)
        {
            $phone = $_POST['phoneNumber'];
            $firstname = $data[2];
            $lastname = $data[3];
            $gender = $data[4];
            $district = $data[5];
            $region = $data[6];
            $password = $data[7];
            // $password_encrypt = $password;
            $sql_query = "INSERT INTO contacts(first_name, last_name, gender, phone, district, region, password, labtest_status)
                         VALUES('$firstname', '$lastname', '$gender', '$phone', '$district', '$region', '$password', 'pending')";

            $result = pg_query($connect, $sql_query);

            if($result == true)
            {
                $text = "You have been registered successfully\n";
                ussd_stop($text);
            }
        }
    }

    // check password before login
    function check_password($data, $phone)
    {
        global $connect;
        if(count($data) == 2)
        {
            $text = "Please enter your password";
            ussd_proceed($text);
        }
        if(count($data) == 3)
        {
            $phone = $_POST['phoneNumber'];
            $password = $data[2];

            $check_password = "SELECT * FROM contacts WHERE phone='$phone' AND password='$password'";
            $result = pg_query($connect, $check_password);
            $row = pg_num_rows($result);

            if($row>0)
            {
                return true;
            }
            else
            {
                $text = "Invalid Password";
                ussd_stop($text);
            }
        }

    }

    // function for fetching data for the foreign key
    function fetchPatientId($data, $phone){
        global $connect;
        $sql = pg_query($connect, "SELECT contact_id as id FROM contacts 
                                    WHERE password = '".$data[2]."' 
                                    AND phone = '".$phone."'");
        $patientId = pg_fetch_assoc($sql)['id'];
        return $patientId;
    }

    // function for symptoms_screening
    function symptom_screening($data, $phone)
    {
        global $connect;

        if(count($data) == 3)
        {
            $text =  "Have you been coughing for more than 2-3 weeks? \n 1. YES \n 2. NO";
            ussd_proceed($text);
        }
        if(count($data) == 4)
        {
            $text = "Have you been coughing up blood? \n 1. YES \n 2. NO";
            ussd_proceed($text);
        }
        if(count($data) == 5)
        {
            $text = "Have you had weight loss of more than 10 KGS for no reason? \n 1. YES \n 2. NO";
            ussd_proceed($text);
        }
        if(count($data) == 6)
        {
            $text = "Have you been having high fevers lately?  \n 1. YES \n 2. NO";
            ussd_proceed($text);
        }
        if(count($data) == 7)
        {
            $text = "Have you been sweating frequently for no reason?  \n 1. YES \n 2. NO";
            ussd_proceed($text);
        }
        if(count($data) == 8)
        {
            $coughing_weeks = $data[3];
            $coughing_blood = $data[4];  
            $weight_loss = $data[5];
            $fever = $data[6];
            $sweating = $data[7]; 
            $sql_query = "INSERT INTO symptoms (contact_id,coughing_weeks, coughing_blood, weight_loss, fever, sweating)
                          VALUES ('".fetchPatientId($data, $phone)."','$coughing_weeks', '$coughing_blood', '$weight_loss', '$fever', '$sweating')";

            $result = pg_query($connect, $sql_query);

            if($result == true )
            {
                $text = "Self-screening has completed successfully!";
                ussd_stop($text);
            }

        }
    }

    // the function for risk_factors(i may elminate this part because am not feeling it)
    function risk_factor($data, $phone)
    {
        global $connect;

        if(count($data) == 3){
            $text = "Have you ever been in contact with a TB person?\n1.YES\n2.NO";
            ussd_proceed($text);
        }
        if(count($data) == 4){
            $text = "Do you live or work in an area where is clouded and TB is common such as nursing areas?\n1.YES\n2.NO";
            ussd_proceed($text);
        }
        if(count($data) == 5){
            $text = "Have you been having weak body immune due to malnutrition or low body weight?\n1.YES\n2.NO";
            ussd_proceed($text);
        }
        if(count($data) == 6){
            $text = "Taking any medications that your doctor said could weaken your immune system or increase your risk for infections?\n1.YES\n2.NO";
            ussd_proceed($text);
        }
        if(count($data) == 7){
            $text = "Do you have (or have had) any of these medical conditions? (Diabetes, Kidney disease, HIV infection, Cancer, Stomach or Intestine surgery)\n1.YES\n2.NO";
            ussd_proceed($text);
        }
        if(count($data) == 8){
            $sick_tb_person = $data[3];
            $living_condition = $data[4];
            $weak_immune = $data[5];
            $unprescribed_drugs = $data[6];
            $medical_condition = $data[7];

            $sql_query = "INSERT INTO risk_factor(contact_id, sick_tb_person, living_conditions, weak_immune, unprescribed_drugs, medical_conditions)
                          VALUES('".fetchPatientId($data, $phone)."','$sick_tb_person', '$living_condition', '$weak_immune', '$unprescribed_drugs', '$medical_condition')";
            $result = pg_query($connect, $sql_query);
            if($result == true){
                $text = "Risk assesment has completed successfully!";
                ussd_stop($text);
            }
        }
    }

    // the function for notification status
    // function status($data, $phone)
    // {
    //     global $connect; 
    //  // the message that will pop here will have to depend on symptoms and risk factors

    // }

    // the function for labtest
    function labtest($data, $phone){
        global $connect;
        if(count($data) == 3){
            $phone =$_POST['phoneNumber'];
            $labtest = "SELECT labtest_status FROM contacts WHERE phone='$phone'";
            $run = pg_query($connect, $labtest);
            while($row = pg_fetch_array($run)){
                $text = $row['labtest_status'];
            }
            ussd_stop($text);

        }
    }

    // function to end session 
    function ussd_stop($text)
    {
        echo "END". " ". $text;
        exit(0);
    }
?>