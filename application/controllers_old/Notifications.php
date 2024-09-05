<?php
/**
 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
require_once APPPATH.'third_party/google-api-php-client-main/vendor/autoload.php';
// use Kreait\Firebase\Messaging\Notification;
class Notifications extends Main
{
	public function index($action=null,$p1=null,$p2=null,$p3=null)
	{
		$data['user']    	= $this->checkLogin();
		switch ($action) {
			case null:
				$data['title']      = 'Send Notification';
				$data['contant']    = 'notifications/index';
				$_POST['status']	= 'active';
				$data['templates']	= $this->app_lib->get_options('notification_template_master','id','title');
				$data['app_users']	= $this->app_lib->app_users();
				// echo _prx($data['templates']);
				// $data['tb_url']	    = base_url().'plan-master/tb';
				$this->template($data);
				break;
			case 'template-details':
				$id = $p1;
				$data['row']		= $this->model->getRow('notification_template_master',['id'=>$id]);
				$this->load->view('notifications/template_details',$data);
				break;

			case 'send':
				
				// echo _prx($_POST);
				$can_send = false;
				$res['res'] = 'error';
				$res['msg'] = 'Notification not send!';
				$post = $this->input->post();
				$client= new Google_Client();
				$client->setAuthConfig(APPPATH."third_party/google-api-php-client-main/JSON_KEY/after-me-cde24-b8ff58adb2bb.json");
				$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
				$httpClient = $client->authorize();
				$project = "after-me-cde24";

				$notification = array('title' => $post['title'], 
								'body' => $post['body'], 
								'image' => $post['image']
							);

				if($post['individual_topic'] == 'individual'){
					$id = $post['app_user'];
					$row = $this->model->getRow('users',['id'=>$id]);
					if($row->token!=''){
						$can_send = true;
					}
					$message = [
						"message" => [
							"token" => $row->token,
							"notification" => $notification
						]
					];
				}
				elseif($post['individual_topic'] == 'topic'){
					if($post['topic']!=''){
						$can_send = true;
					}
					$message = [
						"message" => [
						"topic" => $post['topic'],
						"notification" =>$notification
						]
						];
				}
				if($can_send){
					$response = $httpClient->post("https://fcm.googleapis.com/v1/projects/{$project}/messages:send", ['json' =>  $message]);
						// echo _prx($response);
					$statusCode = $response->getStatusCode();


					// echo $data['statusCode'];
				}

				if (@$statusCode=='200') {
					$res['res'] = 'success';
					$res['msg'] = 'Notification send successfully.';
				}
				
				echo json_encode($res);
				break;
			
			default:
				// code...
				break;
		}
	}

	// public function template_details($id)
	// {

	// 	echo $id;
	// }
}