<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url('auth'));
        };
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List Pasien";
        $this->load->view('template/header_admin', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('template/navbar_admin', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('template/footer_admin', $data);
    }

    public function pasien($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Pasien";
        $this->load->view('template/header_admin', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('template/navbar_admin', $data);
        $this->load->view('admin/pasien', $data);
        $this->load->view('template/footer_admin', $data);
    }
}
