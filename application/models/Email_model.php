<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Email_model extends CI_Model {
    function __construct()
    {
		$this->load->library('email');
        // Call the Model constructor
        parent::__construct();
    }
	
	public function send_mail_in_ci($data){
		$this->load->library('email');
		$config = array (
			  'mailtype' => 'html',
			  'charset'  => 'utf-8',
			  'priority' => '1'
			   );
		$this->email->initialize($config);

		$this->email->from($data['from_email'],  $data['from_name']);
		$this->email->to($data['to_email']);
		
		$this->email->subject( $data['subject']);
		$this->email->message( $data['html']);
		if($this->email->send()){
			return 'sent';
		}
		else{
			return 'error';
		}
	}
		
	public function send_mail_in_smtp($data){
		$this->load->library('email');
		$config = array (
			  'mailtype' =>'html',
			  'charset'  =>'utf-8',
			  'protocol'  =>'smtp',
			  'smtp_host' => C_SMTP_HOST,
			  'smtp_user' => C_SMTP_USER,
			  'smtp_pass' => C_SMTP_PASS,
			  'smtp_port' => C_SMTP_PORT,
			  'smtp_crypto' =>'tls',
			  '_smtp_auth' => TRUE,
			  'newline' =>"\r\n",
			  'priority' =>'1'
		   );
			   
		$this->email->initialize($config);
		$this->email->SMTPAuth = true;
		$this->email->from($data['from_email'],  $data['from_name']);
		if(isset($data['cc'])){
			$this->email->bcc($data['cc']);
		}
		$this->email->to($data['to_email']);
		
		$this->email->subject( $data['subject']);
		$this->email->message( $data['html']);
		if($this->email->send()){
			return 'sent';
		}
		else{
			return 'error';
		}
		
	}
	
    public function send_mail_in_curl($data) {
		$url = 'https://api.sendgrid.com/';
		$user = 'dollars234';
		$pass = 'Magodo123';
		$json_string = array(
						  'to' => array($data['to_email']),
						  'category' => 'test_category'
						);


		$params = array(
			'api_user'  => $user,
			'api_key'   => $pass,
			'x-smtpapi' => json_encode($json_string),
			'to'        => $data['to_email'],
			'subject'   => $data['subject'],
			'html'      => $data['html'],
			'text'      => $data['html'],
			'from'      => $data['from_email'],
		  );

		
		$request =  $url.'api/mail.send.json';
		
		// Generate curl request
		$session = curl_init($request);
		// Tell curl to use HTTP POST
		curl_setopt ($session, CURLOPT_POST, true);
		// Tell curl that this is the body of the POST
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		// Tell curl not to return headers, but do return the response
		curl_setopt($session, CURLOPT_HEADER, false);
		// Tell PHP not to use SSLv3 (instead opting for TLS)
		curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		
		// obtain response
		$response = curl_exec($session);
		curl_close($session);
		
// print everything out
	return $response;	

	
	}
}
?>