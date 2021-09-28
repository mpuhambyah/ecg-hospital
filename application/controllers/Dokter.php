<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
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
        $this->load->model('M_dokter');
        $data['listPasien'] = $this->M_dokter->listPasien();
        $data['dataPasien'] = $this->M_dokter->dataPasien();
        $data['listPasienUnchecked'] = $this->M_dokter->dataPasienUnchecked();
        $data['total'] = count($data['listPasienUnchecked']);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('dokter/dashboard', $data);
        $this->load->view('template/footer', $data);
    }

    public function profile()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Profile";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('dokter/profile', $data);
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
        $this->load->view('dokter/pasien', $data);
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
        $data['rekamanPasien'] = $this->M_dokter->rekamanPasien($data['id'], $data['id_rekaman']);
        $data['listRekaman'] = $this->M_dokter->listRekaman($data['id']);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('dokter/record', $data);
        $this->load->view('template/footer', $data);
    }

    public function checkDataRekaman($id_pasien, $id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $this->load->model('M_dokter');
        $data = $this->M_dokter->rekamanPasien($id_pasien, $id);
        if ($data['status'] == 0) {
            $data_check = [
                "id_pasien" => $id_pasien,
                "status_check" => 1,
                "check_at" => time(),
                "check_by" => $this->session->userdata('id')
            ];
        } else {
            $data_check = [
                "id_pasien" => $id_pasien,
                "status_check" => 0,
                "check_by" => $this->session->userdata('id')
            ];
        }
        $this->db->where('id', $id);
        $this->db->update('rekaman', $data_check);
        $this->load->model('M_dokter');
        $data = $this->M_dokter->rekamanPasien($id_pasien, $id);
        echo json_encode($data);
    }

    public function getActivities($id_pasien, $id, $id_activities)
    {
        $data_activities = [
            "id_user" => $this->session->userdata('id'),
            "id_activity" => $id_activities,
            "target" => $id_pasien,
            "id_rekaman" => $id,
            "created_at" => time()
        ];
        $this->db->insert('activities', $data_activities);
    }

    public function deleteRecord($id, $id_rekaman)
    {
        $this->db->where('id', $id_rekaman);
        $this->db->delete('rekaman');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
              Record berhasil dihapus!
              </div>');
        $data_activities = [
            "id_user" => $this->session->userdata('id'),
            "id_activity" => 4,
            "target" => $id,
            "id_rekaman" => $id_rekaman,
            "created_at" => time()
        ];
        $this->db->insert('activities', $data_activities);
        redirect(base_url('dokter/listRecord/' . $id));
    }

    public function listRecord()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List Pasien";
        $this->load->model('M_dokter');
        $id = $this->uri->segment(3);
        $data['listRekaman'] = $this->M_dokter->listRekaman($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('dokter/listRecord', $data);
        $this->load->view('template/footer', $data);
    }

    public function activities()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Activities";
        $this->load->model('M_dokter');
        $data['listActivity'] = $this->M_dokter->listActivity();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('dokter/activities', $data);
        $this->load->view('template/footer', $data);
    }

    public function logData()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Log Data";
        $this->load->model('M_dokter');
        $data['listPasien'] = $this->M_dokter->dataPasien();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('dokter/logData', $data);
        $this->load->view('template/footer', $data);
    }
}
