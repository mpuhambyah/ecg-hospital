<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $data = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        if (!$this->session->userdata('email')) {
            redirect(base_url('auth'));
        } else if ($data['role_id'] == 1) {
            redirect(base_url('dokter'));
        } else if ($data['role_id'] == 3) {
            redirect(base_url('pasien'));
        } else if ($data['role_id'] == 2) {
            redirect(base_url('alat'));
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List Pasien";
        $data['listPasien'] = $this->db->get('user')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('template/footer', $data);
    }

    public function resetPassword($id)
    {
        $data = [
            "password" => '$2y$10$ve4j.jZy5sXIvHoPgf2WvuBiK2fMy2yf5cCpIBtmSbIqGwiLEhaky', //000000

        ];
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Password User berhasil di reset! (password : 000000)
                </div>');
        $this->db->where('id', $id);
        $this->db->update('user', $data);
        redirect(base_url('alat/'));
    }


    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
              User berhasil dihapus!
              </div>');
        redirect(base_url('admin/'));
    }
}
