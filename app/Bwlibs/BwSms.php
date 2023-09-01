<?PHP
namespace App\Bwlibs;

use App\Models\SystemSetting;

class BwSms {
	##########################################################################
	# Declare variable
	##########################################################################
	protected $gatewayurl="";

	function __construct(){
		$this->gatewayurl="http://brightwin.com/smsapi";
	}

	function sms_token(){
		$agent = $_SERVER['HTTP_USER_AGENT'];
		try{
			$agent = (isset($_SERVER['HTTP_USER_AGENT']))?$_SERVER['HTTP_USER_AGENT']:"";
			$curl=curl_init();
			$data["client_id"] = "PWS";
			$data["client_secret"] = "SMS1889";
			$data["grant_type"] = "password";
			$data["username"] = "SMS";
			$data["password"] = "Sms1688";
			curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => 1,
				CURLOPT_HEADER => 0,
				CURLOPT_URL => $this->gatewayurl."/index.php/TOKEN",
				CURLOPT_USERAGENT => $agent,
				CURLOPT_POSTFIELDS =>http_build_query($data),
				CURLOPT_CONNECTTIMEOUT => 3600,
				CURLOPT_TIMEOUT => 3600,
				CURLOPT_SSL_VERIFYHOST=>0
			));
			unset($data);
			$resp="";
			$resp = curl_exec($curl);
			// Close request to clear up some resources
			curl_close($curl);
			if($resp!==false){
				$rdata = json_decode($resp, true);
				$arr_return["access_token"] = $rdata["access_token"];
			}
		} catch (Exception $e) {
			$arr_return = array("status"=>"Offline", "msg"=> $e->getMessage());
		}
		return $arr_return;
	}

	function sms_chk_status(){
		$agent = $_SERVER['HTTP_USER_AGENT'];
		try{
			$ch=curl_init();
			$url = $this->gatewayurl;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_USERAGENT, $agent);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_VERBOSE, false);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSLVERSION, 3);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			$page=curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			if($httpcode>=200 && $httpcode<300) {
				$arr_return = array('status' => "Online");
			} else {
				throw new Exception('Connection break down. error code : 10002');
			}
		} catch (Exception $e) {
			$arr_return = array("status"=>"Offline", "msg"=> $e->getMessage());
		}
		return $arr_return;
	}

	function sms_chk_credit($access_token){
		$systemsetting= SystemSetting::first();
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		$data["u"] = $systemsetting->sms_username;
		$data["p"] = $systemsetting->sms_password;
		$data["access_token"] = $access_token;
		$data["sms_gateway"] = "http://sms.websys.com.my/api/get_balance.php";
		$url = $this->gatewayurl."/index.php/CHECKCREDIT";
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_URL => $url,
			CURLOPT_POSTFIELDS =>http_build_query($data),
			CURLOPT_CONNECTTIMEOUT => 3600,
			CURLOPT_TIMEOUT => 3600,
			CURLOPT_SSL_VERIFYHOST=>0
		));
		unset($data);
		$resp="";
		$resp = curl_exec($curl);
		if (FALSE === $resp) {
			$arr_return = array("status"=>"Offline", "msg"=> curl_error($curl));
		} else {
			$rdata = json_decode($resp, true);
			$arr_return=$rdata;
			$arr_return["status"]="Online";
		}
		// Close request to clear up some resources
		curl_close($curl);
		return $arr_return;
	}
}

?>
