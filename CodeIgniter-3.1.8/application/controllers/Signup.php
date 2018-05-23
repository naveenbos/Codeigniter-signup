<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('User_Model');
    }

    /**
     * [index loading singup form]
     */
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/signup_form');
    }

    /**
     * [form_submit form submission]
     * @return [type] [description]
     */
    public function form_submit()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('templates/signup_form');
        } else {
            $key  = sha1(mt_rand(10000, 99999) . time() . $this->input->post('email'));
            $data = array(
                'name'           => $this->input->post('name'),
                'password'       => md5($this->input->post('password')),
                'email'          => $this->input->post('email'),
                'ip_address'     => $this->input->post('ip'),
                'activation_key' => $key,
                'active_status'  => '0',
            );
            $email = $this->input->post('email');
            $user  = $this->checkUserexists($email);
            if (!$user) {
                $this->User_Model->insertUserDetails($data);
                $this->sendActivationLinktoCustomer($email, $key);
                $this->session->set_flashdata('msg', '<div id="alert-success"  class="alert alert-success text-center">Successfully registered. Please confirm the mail that has been sent to your email. </div>');
            } else {
                $this->session->set_flashdata('msg', '<div id="alert-danger"  class="alert alert-danger text-center">This email address is already exists in our database. </div>');
            }

            $this->load->view('templates/header');
            $this->load->view('templates/signup_form');
        }
    }

    /**
     * [checkUserexists checking the currect signup form submitted user is exists or not in our db]
     * @param  [string] $email email address of the current signup form submited user
     * @return [string] user detials
     */
    public function checkUserexists($email)
    {
        $user = $this->User_Model->checkUser($email);
        return $user;
    }

    /**
     * [sendActivationLinktoCustomer description]
     * @param  [string] $email [email address of a user]
     * @param  [string] $key   activation key
     * @return void
     */
    public function sendActivationLinktoCustomer($email, $key)
    {
        $data = array(
            'email'          => $email,
            'key'            => $key,
            'activation_url' => site_url() . '/signup/activate?email=' . $email . '&key=' . $key,
        );
        $this->load->library('email');
        $config['protocol']     = 'ssmtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'naveen.bos@gmail.com';
        $config['smtp_pass']    = '';
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['mailtype']     = 'text';
        $config['validation']   = true;
        $this->email->initialize($config);
        $this->email->from('nmohanan@suyati.com', 'Naveen');
        $this->email->to($email);
        $this->email->subject("Activation Link");
        $message = $this->load->view('email/activation', $data, true);
        $this->email->message($message);
        if ($this->email->send($message)) {
            return true;
        } else {
            $this->session->set_flashdata('msg', '<div id="alert-danger"  class="alert alert-danger text-center">Email not send. </div>');
            redirect('signup', 'refresh');
        }
    }

    /**
     * [activate function is used for activating users using the signup link]
     * getting query strings from url
     * @return
     */
    public function activate()
    {
        $params      = $this->input->server('QUERY_STRING');
        $email       = $this->input->get('email', true);
        $key         = $this->input->get('key', true);
        $space_check = strrpos($email, " ");
        if ($space_check) {
            $email = str_replace(" ", "+", $email); //This line is added for replacing space to plus sign, when user add email id with plus for signup
        }
        $this->User_Model->activateUser($email, $key);
        $this->session->set_flashdata('msg', '<div id="alert-success"  class="alert alert-success text-center">Successfully Activated. Please login. </div>');
        redirect('signup', 'refresh');
    }
}
