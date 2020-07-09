<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Welcome extends CI_Controller {

   public function __construct() 
        {
            parent::__construct();

            $user_id = $this->session->userdata('id');
            $user_name = $this->session->userdata('user_name');
            $access_level = $this->session->userdata('access_level');
			
            if($user_id != NULL && $user_name != NULL && $access_level != NULL)
            {
                    redirect('access', 'refresh');
            }
       }

    public function index()
    {
        $data['title']='PTS';
        $this->load->view('login');
    }
	
	public function login()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		
		$result=$this->welcome_model->login_check($data);
		
	       if($result)
               {
                   $data1['id']=$result->id;
                   $data1['user_name']=$result->user_name;
                   $data1['shop']=$result->shop;
                   $data1['access_level']=$result->access_level; // 1=super_admin, 2=users
                   $this->session->set_userdata($data1);
				   
                   redirect('access','refresh');
               }
               else{
                   $data['exception']='Your User Name/Password is Invalid!';
                   $this->session->set_userdata($data);

                   redirect('welcome', 'refresh');
               }
			   
			   
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */