<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $data = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        if (!$this->session->userdata('email')) {
            redirect(base_url('auth'));
        } else if ($data['role_id'] != 2) {
            redirect(base_url('dokter'));
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
        $this->load->view('alat/dashboard', $data);
        $this->load->view('template/footer', $data);
    }

    public function listRecord()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List Pasien";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('alat/listRecord', $data);
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
        $this->load->view('alat/record', $data);
        $this->load->view('template/footer', $data);
    }

    public function editPasien()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List Pasien";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('alat/editPasien', $data);
        $this->load->view('template/footer', $data);
    }

    public function logData()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Log Data";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('alat/logData', $data);
        $this->load->view('template/footer', $data);
    }
}
