<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $data = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        if (!$this->session->userdata('email')) {
            redirect(base_url('auth'));
        } else if ($data['role_id'] == 1) {
            redirect(base_url('dokter'));
        } else if ($data['role_id'] == 2) {
            redirect(base_url('alat'));
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Rekaman";
        $this->load->model('M_dokter');
        $id = $this->db->get_where('pasien', ['nik' => $this->session->userdata('email')])->row_array();
        $data['pasien'] = $this->db->get_where('pasien', ['id' => $id['id']])->row_array();
        $data['listRekaman'] = $this->M_dokter->listRekaman($id['id']);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pasien/listRecord', $data);
        $this->load->view('template/footer', $data);
    }

    public function record()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List Pasien";
        $this->load->model('M_dokter');
        $data['id'] = $this->uri->segment(3);
        $data['id_rekaman'] = $this->uri->segment(4);
        $data['minute'] = $this->uri->segment(5);
        $data['rekamanPasien'] = $this->M_dokter->rekamanPasien($data['id'], $data['id_rekaman']);
        $data['listRekaman'] = $this->M_dokter->listRekaman($data['id']);
        $this->load->model('M_data');
        $data['totalData'] = count($this->M_data->dataEcgFull($data['id'], $data['id_rekaman']));
        $data['loopData'] = intval(ceil($data['totalData'] / 800));
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pasien/record', $data);
        $this->load->view('template/footer', $data);
    }


    public function listMinute()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Rekaman";
        $this->load->model('M_dokter');
        $id = $this->uri->segment(3);
        $id_rekaman = $this->uri->segment(4);
        $data['pasien'] = $this->db->get_where('pasien', ['id' => $id])->row_array();
        $data['id'] =  $id;
        $data['id_rekaman'] = $id_rekaman;
        $data['JumlahlistMinute'] = $this->M_dokter->JumlahlistMinute($id, $id_rekaman);
        if (intval($data['JumlahlistMinute']['jumlah']) == 0) {
            $data['listRekaman'] = 0;
        } else if (intval($data['JumlahlistMinute']['jumlah']) < 12000) {
            $data['listRekaman'] = 1;
        } else {
            $data['listRekaman'] = ceil(intval($data['JumlahlistMinute']['jumlah']) / 12000);
        }
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pasien/listMinute', $data);
        $this->load->view('template/footer', $data);
    }

    public function logData()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Log Data";
        $this->load->model('M_dokter');
        $id = $this->db->get_where('pasien', ['nik' => $this->session->userdata('email')])->row_array();
        $data['listPasien'] = $this->M_dokter->dataPasienEach($id['id']);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('alat/logData', $data);
        $this->load->view('template/footer', $data);
    }
}
