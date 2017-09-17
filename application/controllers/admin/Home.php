<?php
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends Admin_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->load->model('Common_function_model','common');
    }

    public function index() {
         if ($this->session->userdata('is_admin_login')) {
            redirect('admin/dashboard');
        } else {
        
		$this->load->view('admin/controls/vwLoginHeader');
		$this->load->view('admin/vwLogin');
		$this->load->view('admin/controls/vwLoginFooter');
		
		
        }
    }

     public function do_login() {

        if ($this->session->userdata('is_admin_login')) {
            redirect('admin/home/dashboard');
        } else {
            /*$user = $_POST['username'];
            $password = $_POST['password'];*/

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
               	$this->load->view('admin/controls/vwLoginHeader');
				$this->load->view('admin/vwLogin');
				$this->load->view('admin/controls/vwLoginFooter');
            } else {
               
				$this->db->where('email',$this->input->post('username'));
				$result = $this->db->get('admin');
				$user_count = $result->num_rows();
				$admin_user=$result->result_array();
                /*$val = $this->db->query($sql,array($user ,$enc_pass ));*/

                if ($user_count>=1 && $this->encrypt->decode($admin_user[0]['password'])==$this->input->post('password')) {

                        $this->session->set_userdata(array(
                            'id' => $admin_user[0]['id'],
                            'username' => $admin_user[0]['username'],
                            'email' => $admin_user[0]['email'],                            
                            'is_admin_login' => true,
                            'user_type' => $admin_user[0]['user_type']
                                )
                        );
                    redirect('admin/dashboard');
                } else {
                    $err['error'] = 'Invalid username or password';
                  
				   $this->load->view('admin/controls/vwLoginHeader');
				   $this->load->view('admin/vwLogin', $err);
				   $this->load->view('admin/controls/vwLoginFooter');
                }
            }
        }
           }

	//This function checks your session 
	 public function check_session(){
		$id = $this->session->userdata('id');
	   if($id!="" ){
			 echo '1';
	   }else{
			 echo '0';
	   
	   }
	
	 }        
    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('is_admin_login');   
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('admin/home', 'refresh');
    }

    

}

