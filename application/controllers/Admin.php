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
        } else if ($data['role_id'] != 1) {
            redirect(base_url('alat'));
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List Pasien";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('template/footer', $data);
    }

    public function pasien($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Pasien";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('admin/pasien', $data);
        $this->load->view('template/footer', $data);
    }

    public function record()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List Pasien";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('admin/record', $data);
        $this->load->view('template/footer', $data);
    }


    public function activities()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Activities";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('admin/activities', $data);
        $this->load->view('template/footer', $data);
    }
}
