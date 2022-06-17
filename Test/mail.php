<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT']; //ovo mora da postoji 
        use PHPMailer\PHPMailer\src\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        $mail = new PHPMailer(); 
        
        // ---------- adjust these lines --------------------------------------- $mail->Username = "moj_username@gmail.com"; // Vas GMail username $mail->Password = "ip2015"; //Vasa GMail lozinka 
        
        $mail->SetFrom('moj_username@gmail.com', 'Drazen Draskovic'); //$mail->AddReplyTo('draskovic@etf.rs', 'Drazen Draskovic'); //$mail->MsgHTML(file_get_contents('contents.html')); 
        
        //$mail->AddAttachment('nekaslika.jpg'); // Ako zelimo attachment //---------PODESAVANJA------------------------------------------- $mail->Host = "ssl://smtp.gmail.com"; // GMail SMTP server 
        
        $mail->Port = 465; //GMail port 
        
        $mail->IsSMTP(); // Koristimo SMTP 
        
        $mail->SMTPAuth = true; // Ukljucena SMTP autentifikacija 
        
        $mail->From = $mail->Username; 
        
        // ------------------------------ 
        
        $ime = $_POST['ime']; 
        
        $eposta = $_POST['email1']; 
        
        $mail->AddAddress($eposta, $ime); // primalac e-mail poruke 
        
        $mail->AddBCC("drazen.draskovic@gmail.com", "Drasko"); //nevidljivi primalac $mail->Subject = "Potvrda otvorenog naloga za forum"; //naslov poruke $mail->isHTML(true); 
        
        $porukamejl = "Zdravo $ime , <br/><br/>Hvala sto ste registrovali  nalog!<br/><br/> Srdacan pozdrav,<br/>Administrator foruma"; 
        
        $mail->Body = $porukamejl; //telo e-mail poruke 
        
        if (!$mail->Send()) 
        
         echo "GRESKA: " . $mail->ErrorInfo; 
        
        else 
        
         header("Location:hvala.html"); 
    ?>
    <h1>Pogledaj mejl</h1>
</body>
</html>