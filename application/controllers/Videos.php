<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
class Videos extends Main {

	public function index($action=null,$id=null)
	{
		$data['user'] 	= $user		= $this->checkLogin();
		$view_dir 		= 'videos/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Videos';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$data['new_url']	=  current_url().'/create';
				$data['clinics']	  	= $this->app_lib->videoCategory();
				$this->template($data);
				break;

			case 'tb':
                  $vedio= $_POST['clinic_id'];
				$this->load->library('pagination');
				$data['contant'] 		= $view_dir.'tb';
				$config 				= array();
				$config["base_url"] 	= base_url()."add-video/tb";
				$config["total_rows"]  	= count($this->model->getvideos($vedio));
				$data['total_rows']    	= $config["total_rows"];
				$config["per_page"]    	= 10;
				$config["uri_segment"] 	= 3;
				$config['attributes']  	= array('class' => 'pag-link');
				$this->pagination->initialize($config);
				$data['links']   		= $this->pagination->create_links();
			    $data['page']    		= $page = ($id!=null) ? $id : 0;
			    $data['search']	 		= $this->input->post('search');
			    $data['update_url']		= base_url('add-video/create/');
			    $data['delete_url']		= base_url('add-video/delete/');
			   

			    $data['rows']    		= $this->model->getvideos($vedio,$config["per_page"],$page);
			    load_view($data['contant'],$data);
				break;

			case 'create':

				$data['title'] 		  	= 'Add Video';
				$data['contant']      	= $view_dir.'create';
				$data['action_url']	  	= base_url('add-video/save');
				$data['states']	  		= $this->app_lib->states(101);
				$data['clinics']	  	= $this->app_lib->clinics();
				$data['cities']			= [];
				 $data['vcat']    		= $this->model->getvideocategory($user,$config["per_page"],$page);
				if ($id!=null) {
					$data['row'] 		= $this->model->getRow('se_videos',['id'=>$id]);
					$data['cities']		= $this->app_lib->cities(@$data['row']->state);
					$data['action_url']	  	= base_url('add-video/save/'.$id);
					
				}

				// $this->pr($data);
				// $data['rows'] \  = $this->model->categories(0);
				load_view($data['contant'],$data);
				break;

		 	case 'save':
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';
                if ($this->input->server('REQUEST_METHOD')=='POST') { 
                     if ($id!=null) {
                     //	echo $id; die();
                        $data = array(
                        	'cat_id'    => $this->input->post('cat_id'),
                            'title'     => $this->input->post('title'),
                            'description'  => $this->input->post('description'),
                            'url'    => $this->input->post('url'),
                        );

                        if($this->model->Update_data('se_videos',$id,$data)){
                            $return['res'] = 'success';
                            $return['msg'] = 'Updated.';
                           // echo $this->db->last_query();die();
                        }
                    }
                    else{ 
                        $data = array(
                        'cat_id'     => $this->input->post('cat_id'),
                           'title'     => $this->input->post('title'),
                            'description'  => $this->input->post('description'),
                            'url'    => $this->input->post('url'),
                            );
                        if ($this->model->Save('se_videos',$data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                        }
                    }
                }
                echo json_encode($return);
                break;


			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('se_videos',['id'=>$id])){
						$saved = 1;
						$return['res'] = 'success';
						$return['msg'] = 'Successfully deleted.';
					}
				}
				echo json_encode($return);
				break;


			
			default:
				// code...
				break;
		}
		

		// $this->pr($data);
		// $this->template($data);
	}




//--======================================= Video Categorys ====================================-->

	public function video_category($action=null,$id=null)
	{
		$data['user'] 	= $user		= $this->checkLogin();
		$view_dir 		= 'video_category/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Video Category';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$data['new_url']	=  current_url().'/create';
				$data['clinics']	  	= $this->app_lib->clinics();
				$this->template($data);
				break;

			case 'tb':
				$this->load->library('pagination');
				$data['contant'] 		= $view_dir.'tb';
				$config 				= array();
				$config["base_url"] 	= base_url()."add-video-category/tb";
				$config["total_rows"]  	= count($this->model->patients($user));
				$data['total_rows']    	= $config["total_rows"];
				$config["per_page"]    	= 10;
				$config["uri_segment"] 	= 3;
				$config['attributes']  	= array('class' => 'pag-link');
				$this->pagination->initialize($config);
				$data['links']   		= $this->pagination->create_links();
			    $data['page']    		= $page = ($id!=null) ? $id : 0;
			    $data['search']	 		= $this->input->post('search');
			    $data['update_url']		= base_url('add-video-category/create/');
			    $data['delete_url']		= base_url('add-video-category/delete/');
			    $data['rows']    		= $this->model->getvideocategory($user,$config["per_page"],$page);
			    load_view($data['contant'],$data);
				break;

			case 'create':

				$data['title'] 		  	= 'Add Video Category';
				$data['contant']      	= $view_dir.'create';
				$data['action_url']	  	= base_url('add-video-category/save');
				$data['states']	  		= $this->app_lib->states(101);
				$data['clinics']	  	= $this->app_lib->clinics();
				$data['cities']			= [];
				if ($id!=null) {
					$data['row'] 		= $this->model->getRow('se_video_category',['id'=>$id]);
					$data['cities']		= $this->app_lib->cities(@$data['row']->state);
					$data['action_url']	  	= base_url('add-video-category/save/'.$id);
					
				}

				// $this->pr($data);
				// $data['rows'] \  = $this->model->categories(0);
				load_view($data['contant'],$data);
				break;

		 	case 'save':
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';
                if ($this->input->server('REQUEST_METHOD')=='POST') { 
                     if ($id!=null) {
                     //	echo $id; die();
                        $data = array(
                            'name'     => $this->input->post('name'),
                        );

                        if($this->model->Update_data('se_video_category',$id,$data)){
                            $return['res'] = 'success';
                            $return['msg'] = 'Updated.';
                           // echo $this->db->last_query();die();
                        }
                    }
                    else{ 
                        $data = array(
							'name'     => $this->input->post('name'),
                            );
                        if ($this->model->Save('se_video_category',$data)) {
                            $return['res'] = 'success';
                            $return['msg'] = 'Saved.';
                        }
                    }
                }
                echo json_encode($return);
                break;


			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('se_video_category',['id'=>$id])){
						$saved = 1;
						$return['res'] = 'success';
						$return['msg'] = 'Successfully deleted.';
					}
				}
				echo json_encode($return);
				break;


			
			default:
				// code...
				break;
		}
		
	}


	}