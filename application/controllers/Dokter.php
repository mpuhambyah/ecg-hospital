<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
    public function __construct()
    {
        ini_set('memory_limit', '-1');
        parent::__construct();
        $data = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        if (!$this->session->userdata('email')) {
            redirect(base_url('auth'));
        } else if ($data['role_id'] == 2) {
            redirect(base_url('alat'));
        } else if ($data['role_id'] == 3) {
            redirect(base_url('pasien'));
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

    public function gantiPassword()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Rekaman";

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[1]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[1]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('dokter/gantiPassword', $data);
            $this->load->view('template/footer', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                  Kata sandi lama salah!
                  </div>');
                redirect(base_url('dokter/gantiPassword'));
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                     Kata sandi baru tidak boleh sama dengan yang lama!
                      </div>');
                    redirect(base_url('dokter/gantiPassword'));
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                      Kata sandi berhasil diubah!
                      </div>');
                    redirect(base_url('dokter/gantiPassword'));
                }
            }
        }
    }

    public function listFile()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List File";
        $this->load->model('M_dokter');
        $data['listFile'] = $this->M_dokter->listFile();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('dokter/listFile', $data);
        $this->load->view('template/footer', $data);
    }

    public function profile()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "Profile";
        $this->load->model('M_data');
        $data['profileUser'] = $this->M_data->dataProfile($this->session->userdata('id'));
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/profile', $data);
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
        $data['minute'] = $this->uri->segment(5);
        $data['rekamanPasien'] = $this->M_dokter->rekamanPasien($data['id'], $data['id_rekaman']);
        $data['listRekaman'] = $this->M_dokter->listRekaman($data['id']);
        $this->load->model('M_data');
        $data['totalData'] = count($this->M_data->dataEcgFull($data['id'], $data['id_rekaman']));
        $data['loopData'] = intval(ceil($data['totalData'] / 800));
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('dokter/record', $data);
        $this->load->view('template/footer', $data);
    }


    public function recordRpeak()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List File";
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
        $this->load->view('dokter/recordRpeak', $data);
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
        $tempData = array();
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List Pasien";
        $this->load->model('M_dokter');
        $id = $this->uri->segment(3);
        $data['pasien'] = $this->db->get_where('pasien', ['id' => $id])->row_array();
        $data['listRekaman'] = $this->M_dokter->listRekaman($id);
        for ($i = 0; $i < count($data['listRekaman']); $i++) {
            $data['JumlahlistMinute'] = $this->M_dokter->JumlahlistMinute($id, $data['listRekaman'][$i]['id_rekaman']);
            $temp = intval($data['JumlahlistMinute']['jumlah']);
            array_push($tempData, $temp);
        }
        $data['duration'] = $tempData;
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('dokter/listRecord', $data);
        $this->load->view('template/footer', $data);
    }

    public function listMinute()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['title'] = "List Pasien";
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
        $this->load->view('dokter/listMinute', $data);
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

    public function uploadFile()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['profile'] = $this->db->get('profile')->row_array();
        $data['listPasien'] = $this->db->get('pasien')->result_array();
        $data['title'] = "Upload File";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('dokter/upload', $data);
        $this->load->view('template/footer', $data);
    }

    public function list_pasien()
    {
        echo json_encode($this->db->get('pasien')->result_array());
    }

    public function list_rekaman()
    {
        echo json_encode($this->db->get_where('rekaman', ['id_pasien' => $this->input->post('id')])->result_array());
    }

    public function addFile()
    {
        $file = $_FILES['fileuser']['name'];

        $file = str_replace(' ', '_', $file);

        $config['upload_path'] = './assets/file/';
        $config['allowed_types'] = 'csv';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('fileuser')) {
            $rDataUpload = [
                "id_pasien" => $this->input->post('pasien', true),
                "id_rekaman" => $this->input->post('rekaman', true),
                "keterangan" => $this->input->post('keterangan', true),
                "id_file" => $this->input->post('id_file', true),
                "created_by" => $this->session->userdata('id'),
                "created_at" => time()
            ];
            $this->db->insert('uploaded', $rDataUpload);
            $this->db->from('uploaded');
            $this->db->order_by('id', 'DESC');
            $this->db->limit('1');
            $id_upload = $this->db->get()->row_array();
            $flag = true;
            $data = fopen(base_url('assets/file/') . $file, "r");
            while (!feof($data)) {
                $csv = fgetcsv($data, 0, ';');
                if ($flag) {
                    $flag = false;
                    continue;
                }
                $rPuncakData = [
                    "annotation" => $csv[0],
                    "timestamp" => $csv[1],
                    "ecg" => $csv[2],
                    "id_upload" => $id_upload['id']
                ];
                $this->db->insert('rpeak', $rPuncakData);
            }

            fclose($data);
            unlink(FCPATH . 'assets/file/' . $file);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">File berhasil di upload</div>');
            redirect(base_url('dokter/uploadFile'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect(base_url('dokter/uploadFile'));
        }
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
