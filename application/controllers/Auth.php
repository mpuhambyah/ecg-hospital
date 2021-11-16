<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        var_dump("yoi");
        die;
    }

    #INDEX digunakan fungsi dashboard
    public function index()
    {
        $data['profile'] = $this->db->get('profile')->row_array();
        if ($this->session->userdata('id')) {
            redirect(base_url('dokter'));
        } else {
            $this->form_validation->set_rules('email', 'email', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            if ($this->form_validation->run() == false) {
                $this->load->view('auth/login', $data);
            } else {
                $this->_login();
            }
        }
    }

    private function _login()
    {
        #mengambil data yg diinput oleh user
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        #query data select * from user where 'nrp'='$nrp'
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        #jika data user ditemukan
        if ($user) {
            #jika user sudah diaktivasi

            if ($user['is_active'] == 1) {
                #mengecek password

                if (password_verify($password, $user['password'])) {
                    $data = [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'id' => $user['id'],
                        'role_id' => $user['role_id']
                    ];

                    #memasukkan data di atas ke session
                    $this->session->set_userdata($data);
                    redirect(base_url('dokter'));

                    #jika password salah
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                Wrong password!
                                </div>');
                    redirect(base_url('auth'));
                }

                #jika user belum diaktivasi
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        This account has not been activated!
                        </div>');
                redirect(base_url('auth'));
            }

            #jika data user tidak ditemukan
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Account is not registered! </div>');
            redirect(base_url('auth'));
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                You have been logged out!
                </div>');
        redirect(base_url('auth'));
    }
}
