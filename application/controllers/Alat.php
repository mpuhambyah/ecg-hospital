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
        } else if ($data['role_id'] == 1) {
            redirect(base_url('dokter'));
        } else if ($data['role_id'] == 3) {
            redirect(base_url('pasien'));
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List Pasien";
        $this->load->model('M_alat');
        $data['listPasien'] = $this->M_alat->listPasien();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('alat/dashboard', $data);
        $this->load->view('template/footer', $data);
    }

    public function changePassword()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Change Password";

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[1]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[1]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('profil/changepassword', $data);
            $this->load->view('template/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                  Kata sandi lama salah!
                  </div>');
                redirect(base_url('profil/changepassword'));
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                     Kata sandi baru tidak boleh sama dengan yang lama!
                      </div>');
                    redirect(base_url('profil/changepassword'));
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                      Kata sandi berhasil diubah!
                      </div>');
                    redirect(base_url('profil/changepassword'));
                }
            }
        }
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

    public function tambahPasien()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Tambah Pasien";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('alat/tambahPasien', $data);
        $this->load->view('template/footer', $data);
    }

    public function addPasien()
    {
        $user = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['alat'] = $this->db->get_where('alat', ['id_user' => $this->session->userdata('id')])->row_array();
        $data = [
            "id_alat" => $data['alat']['id'],
            "NIK" => $this->input->post('nik'),
            "nama" => $this->input->post('nama'),
            "alamat" => $this->input->post('alamat'),
        ];
        $password_hash = password_hash($data['NIK'], PASSWORD_DEFAULT);
        // $this->db->set('password', $password_hash);
        $id = password_verify($password_hash, $user['password']);
        var_dump($id);
        die;
        $this->db->insert('pasien', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pasien berhasil ditambahkan</div>');
        redirect(base_url('alat'));
    }

    public function deletePasien($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pasien');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
              Pasien berhasil dihapus!
              </div>');
        $data_activities = [
            "id_user" => $this->session->userdata('id'),
            "id_activity" => 4,
            "target" => $id,
            "id_rekaman" => $id,
            "created_at" => time()
        ];
        $this->db->insert('activities', $data_activities);
        redirect(base_url('alat/'));
    }

    public function listRecord()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List Pasien";
        $this->load->model('M_dokter');
        $id = $this->uri->segment(3);
        $data['pasien'] = $this->db->get_where('pasien', ['id' => $id])->row_array();
        $data['listRekaman'] = $this->M_dokter->listRekaman($id);
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
        $this->load->model('M_dokter');
        $data['id'] = $this->uri->segment(3);
        $data['id_rekaman'] = $this->uri->segment(4);
        $data['rekamanPasien'] = $this->M_dokter->rekamanPasien($data['id'], $data['id_rekaman']);
        $data['listRekaman'] = $this->M_dokter->listRekaman($data['id']);

        $this->load->model('M_data');
        $data['totalData'] = count($this->M_data->dataEcgFull($data['id'], $data['id_rekaman']));
        $data['loopData'] = intval(ceil($data['totalData'] / 800));

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('alat/record', $data);
        $this->load->view('template/footer', $data);
    }

    public function editPasien($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['pasien'] = $this->db->get_where('pasien', ['id' => $id])->row_array();
        $data['title'] = "List Pasien";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('alat/editPasien', $data);
        $this->load->view('template/footer', $data);
    }

    public function editPasienAction($id)
    {
        $data = [
            "NIK" => $this->input->post('nik'),
            "nama" => $this->input->post('nama'),
            "alamat" => $this->input->post('alamat'),
        ];
        $this->db->where('id', $id);
        $this->db->update('pasien', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pasien berhasil diubah</div>');
        redirect(base_url('alat'));
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
        $this->load->view('alat/logData', $data);
        $this->load->view('template/footer', $data);
    }
}
