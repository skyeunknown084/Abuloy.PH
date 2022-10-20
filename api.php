<?php
// session_start();

ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
		include 'compose.php';	
		include 'database.php';	
		$this->db = $mysqli;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	// Create An Account
	function create_account(){
		extract($_POST);

		if(empty($firstname)){
			// die("First name is required");
			$_SESSION['error_reg'] = "First name is required";        
		}
		
		if(empty($lastname)){
			// die("Last name is required");
			$_SESSION['error_reg'] = "Last name is required";        
		}
		
		if(empty($mobile)){
			// die("Mobile number is required");
			$_SESSION['error_reg'] = "Mobile number is required";        
		}
		
		if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
			// die("Valid email is required");
			$_SESSION['error_reg'] = "Valid email is required";        
		}
		
		if (strlen($password) < 8) {
			// die("Password must be at least 8 characters");
			$_SESSION['error_reg'] = "Password must be at least 8 characters";        
		}
		
		if(!preg_match("/[a-z]/i", $password)){
			// die("Password must contain at least one letter");
			$_SESSION['error_reg'] = "Password must contain at least one letter";        
		}
		
		if($password !== $password_confirmation){
			// die("Passwords must match");
			$_SESSION['error_reg'] = "Passwords must match";
		}

		$user_type = 2;
		// String of all alphanumeric character
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';    
		// Shuffle the $str_result and returns substring
		// of specified length
		$code_activation = substr(str_shuffle($str_result), 0, 7);

		$otp = rand(111111, 999999);
		$log_time = time();
		$token = $csrf;
			
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$mobile_extph = 639;
		$phone_number = $mobile_extph . $mobile;

		$check_email = $this->db->query("SELECT * FROM abuloy_users WHERE email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check_email > 0){
			return 2;
			exit;
		}
		
		if(empty($id)){
			$save = $this->db->query("INSERT INTO abuloy_users (user_type, firstname, lastname, mobile, email, password_hash, code_activation, otp, log_time, token, date_created) VALUES ('$user_type', '$firstname', '$lastname', '$phone_number', '$email', '$password_hash', '$code_activation', '$otp', '$log_time', '$token', NOW())");
		}	

		if($save){
			return 1;
		}
	}

	function send_email_otp_verification($email, $otp, $firstname){
		extract($_POST);
		$check_email_status = $this->db->query("SELECT * FROM abuloy_users WHERE email ='$email' AND email_status = 0 ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check_email_status > 0){
			// status pending=0,paid=2,refund=2,expired=3,cancelled=4
			// $update = $this->db->query("UPDATE abuloy_payments SET payment_status=1 WHERE id = $code_id");
			// $user_firstname = $user_row['firstname'];
            // $clientIPAddress=$_SERVER['REMOTE_ADDR'];
            $mail = new PHPMailer(true);
        
            try{
            $mail->isSMTP();
            $mail->Debugoutput = 'html';
            $mail->Host = $_ENV['PHPMAIL_HOST'];
            $mail->Username = $_ENV['PHPMAIL_FROM'];
            $mail->Password = $_ENV['PHPMAIL_PWRD'];
            $mail->SMTPAuth=true;
            $mail->Port = $_ENV['PHPMAIL_PORT'];
            $mail->SMTPSecure = 'tls';
            $mail->setFrom($_ENV['PHPMAIL_FROM'], $_ENV['PHPMAIL_NAME']);
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject='Email Verification';
            $mail->Body = "<link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
            <style type='text/css'>
            body {
                font-family: 'Poppins', Sans-Serif;
            }
            </style>    
            <table style='width:50vw'>
                <tr>
                    <td><a href='abuloy.ph' style='background-color:#A265E6;color:white;font-size:24px;padding:0.2rem 0.5rem;margin:0;border-top-left-radius:30px;border-top-right-radius:6px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;'><span style='font-family:Poppins,sans-serif;font-weight:700;text-decoration:underline;color:#94F7CF;margin-left:0.5rem'>Abuloy</span></a></td>
                </tr>
                <tr>
                    <td><div style='position:relative;top:10px;margin:5px 0;border-bottom: 2px solid #94F7CF'></div></td>
                </tr>
                <tr>
                    <td style='width:100vh;margin:2% 0;'><div style='margin-top:25px;text-align:left;width:100vh;'>Hi $firstname,<br/><br/>We are delighted that you signed up for Abuloy PH.<br/>To start building a fund for your love ones, please use the OTP code to complete the verification. <br/>This code will be valid for only 5 minutes.</div></td>
                </tr>
                <tr><td><div style='margin-top:25px;'>Your Code:<div></td></tr>
                <tr><td><div style='height:35px;width:100px;padding:2px;font-size:20px;margin:0 50px 50px 0;heigh:60px;text-align:center;background-color:#94F7CF;color:#A265E6;border-radius:3px;'><span style='vertical-align:middle;'>$otp</span></div></td></tr>
                <tr><td style='padding: 15px 0 20px;'></td></tr>
            </table>";
            $mail->send();
            }catch(Exception $e){
                {echo $e;}
            }

			$update = $this->db->query("UPDATE abuloy_users SET otp='$otp', email_status = 1 WHERE email = '$email'");
			return $update;
		}
	}

	function login_verification(){
		extract($_POST);
		$check_email_status = $this->db->query("SELECT * FROM abuloy_users WHERE email ='$email' AND email_status = 0 ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
	}

	// Start New Fund
	function start_new_fund_user(){
		extract($_POST);
		// $data = "";
		// String of all alphanumeric character
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';    
		// Shuffle the $str_result and returns substring
		// of specified length
		$short_code = substr(str_shuffle($str_result), 0, 7);
		$url_link = 'https://abuloy.ph/donate/'.$short_code;
		$check = $this->db->query("SELECT * FROM abuloy_accounts WHERE d_firstname ='$d_firstname' AND d_lastname = '$d_lastname' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
				
		if(empty($id)){
			// if(isset($_FILES['img']) && !empty($_FILES['img']['tmp_name'])){
			// 	$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			// 	$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			// 	$avatar = $fname;
			// }
			
			$save = $this->db->query("INSERT INTO abuloy_accounts (uid, utype, d_firstname, d_middlename, d_lastname, d_birthdate, d_date_of_death, d_summary, d_goal_amount, url_link, short_code, token, expiration, date_created) VALUES ('$uid', '$utype', '$d_firstname', '$d_middlename', '$d_lastname', '$d_birthdate', '$d_date_of_death', '$d_summary', '$d_goal_amount', '$url_link', '$short_code', '$csrf', '$expiration', now())");
			// INSERT INTO accounts (user_id, type, d_firstname, d_middlename, d_lastname, d_birthdate, d_date_of_death, d_summary, d_goal_amount, avatar) VALUES ('$user_id','$type', '$d_firstname', '$d_middlename', '$d_lastname', '$d_birthdate', '$d_date_of_death', '$d_summary', '$d_goal_amount', '$avatar')
		}
		// else{
		// 	out("Error updating account");
			// if(isset($_FILES['e_img']) && !empty($_FILES['e_img']['tmp_name'])){
			// 	$efname = $_FILES['e_img']['name'];
			// 	$move = move_uploaded_file($_FILES['e_img']['tmp_name'],'assets/uploads/'. $efname);
			// 	$e_avatar = $efname;
			// }
			// $save = $this->db->query("UPDATE accounts SET 
			// 	uid='$uid', 
			// 	user_type='$user_type', 
			// 	d_firstname='$d_firstname', 
			// 	d_middlename='$d_middlename', 
			// 	d_lastname='$d_lastname', 
			// 	d_birthdate='$d_birthdate', 
			// 	d_date_of_death='$d_date_of_death', 
			// 	d_summary='$d_summary', 
			// 	d_goal_amount='$d_goal_amount', 
			// 	avatar='$e_avatar', 
			// 	date_created=now() 
			// 	WHERE id = $id");
			// echo "Insert query failed to create new data for this id !";
		// }

		if($save){
			// $qry = $this->db->query("SELECT *,concat(d_firstname,' ',d_lastname) as name FROM accounts where d_firstname = '".$d_firstname."' and d_lastname = '".$d_lastname."'  ");
			// if($qry->num_rows > 0){
			// 	foreach ($qry->fetch_array() as $key => $value) {
			// 		if(!is_numeric($key))
			// 			$_SESSION['abuloy_'.$key] = $value;
			// 		}
					return 1;
			// }else{
			// 	return 2;
			// }
		}
	}

	// Donation Payment from Donators
	function donation_payment(){
		extract($_POST);
		$uid = "";
		$check = $this->db->query("SELECT * FROM abuloy_payments p INNER JOIN abuloy_accounts a ON(p.aid = a.id) where a.uid = '$uid'  ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$utype = 2;

			require_once 'global_call.php';
			$gcash_public_key = $_ENV['GCASH_PK'];

			$curl = curl_init();

			$webhooksuccessurl = 'https://abuloy.ph/success';
			$redirectsuccessurl = 'https://abuloy.ph/success';
			$redirectfailurl = 'https://abuloy.ph/fail';

			$payload = json_encode([
				'x-public-key' => $gcash_public_key,
				'amount' => $amount,
				'description' => $description,
				'customername' => $customer_name,
				'customermobile' => $customer_mobile,
				'customeremail' => $customer_email,
				'expiry' => $expiry,
				'webhooksuccessurl' => $webhooksuccessurl,
				'redirectsuccessurl' => $redirectsuccessurl,
				'redirectfailurl' => $redirectfailurl
			]);


			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://g.payx.ph/payment_request',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array(
				'x-public-key' => $gcash_public_key,
				'amount' => $amount,
				'description' => $description,
				'customername' => $customer_name,
				'customermobile' => $customer_mobile,
				'customeremail' => $customer_email,
				'expiry' => $expiry,
				'webhooksuccessurl' => $webhooksuccessurl,
				'redirectsuccessurl' => $redirectsuccessurl,
				'redirectfailurl' => $redirectfailurl
			)
			));

			$response = curl_exec($curl);

			curl_close($curl);
			echo $response;
			$data = json_decode($response, true);

			$code = $data['data']['code'];
			$amount = $data['data']['amount'];
			$description = $data['data']['description'];
			$checkout_url = $data['data']['checkouturl'];
			$request_id = $data['data']['hash'];
			$customer_name = $data['data']['customername'];
			$customer_email = $data['data']['customeremail'];
			$customer_mobile = $data['data']['customermobile'];
			$expiry = $data['data']['expiry'];
			$date_added = $data['data']['dateadded'];

			$env_af = 0.03; //3% - abuloy fee
			$env_gcf = 0.02; //2% - gcash fee
			$admin_fee = $amount * $env_af; // abuloy fee amount ex. 100 x 0.03 = Php 3
			$gcash_fee = $amount * $env_gcf; // gcash fee amount ex. 100 x 0.02 = Php 2
			$total_gcash = $amount - $gcash_fee;  // total amount minus gcash fee
			$total_abuloy = $total_gcash - $admin_fee; // total fund raise minus admin fees
			$total_fee = $admin_fee + $gcash_fee; // total fee (gcash)+(abuloy) 


			$save = $this->db->query("INSERT INTO abuloy_payments (aid, utype, short_code, account_name, code, amount, total_fee, gcash_fee, admin_fee, total_abuloy, customer_name, customer_mobile, customer_email, message, description, request_id, checkout_url, date_added) VALUES ('$aid', '$utype', '$short_code', '$account_name', '$code', '$amount', '$total_fee', '$gcash_fee', '$admin_fee', '$total_abuloy', '$customer_name', '$customer_mobile', '$customer_email', '$message', '$description', '$request_id', '$checkout_url', '$date_added')");

			
		}else{
			// $save = $this->db->query("UPDATE abuloy_payments (account_id, user_type, gcash_amount, gcash_fee, gcash_abuloy_fee) VALUES ('$account_id', '$user_type', '$gcash_amount', '$gcash_fee', '$gcash_abuloy_fee') WHERE id = $id");
			echo "Insert query failed to create new data for this id !";
		}
	}

	// GCash Payment Success Update Code
	function update_code(){
		extract($_POST);
		$check_id = $this->db->query("SELECT * FROM abuloy_payments ORDER BY id DESC")->num_rows;
		$code_id = $check_id; 
		if($code_id > 0){
			// status pending=0,paid=2,refund=2,expired=3,cancelled=4
			$update = $this->db->query("UPDATE abuloy_payments SET code='$code' WHERE id = $code_id");
		}
		if($update){
			return 1;
		}
	}

	// GCash Payment Success Update Hash
	function update_payment_success(){
		extract($_POST);
		$check_id = $this->db->query("SELECT * FROM abuloy_payments ORDER BY id desc")->num_rows;
		$code_id = $check_id; 
		if($code_id > 0){
			// status pending=0,paid=2,refund=2,expired=3,cancelled=4
			$update = $this->db->query("UPDATE abuloy_payments SET payment_status=1 WHERE id = $code_id");
		}
		if($update){
			return 1;
		}
	}

	// ==============================================
	// Admin Fund Tracking
	function update_all_fund_status(){
		extract($_POST);
		// $value = $_POST['value'];
		$update = $this->db->query("UPDATE abuloy_payments SET payment_status=$value WHERE id = $id");
		if($update){
			return 1;
		}
	}

}