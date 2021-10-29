<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
set_time_limit(1800);
ini_set('memory_limit', '-1');

class Data extends CI_Controller
{
    public function apiGetData($id_pasien, $api_key)
    {
        $count = 0;
        $dataJson = json_decode(file_get_contents('php://input'), TRUE);
        $alat = $this->db->get_where('alat', ['key_api' => $api_key])->row_array();
        $dataRecord = [
            "id_pasien" => $id_pasien,
            "tanggal" => now()
        ];
        $this->db->insert('rekaman', $dataRecord);
        $this->db->select('id');
        $this->db->from('rekaman');
        $this->db->order_by('id', "desc");
        $rekaman = $this->db->get()->row_array();
        foreach ($dataJson as $value) {
            $value = array('id_pasien' => $id_pasien, 'id_rekaman' => $rekaman['id']) + $value;
            $this->db->insert('ecg', $value);
            $count++;
            echo $count . "\n";
        }
        echo "Success";
    }

    public function alatGetDataPasien($id)
    {
        $alat = $this->db->get_where('alat', ['key_api' => $id])->row_array();
        $id = $alat['id'];
        $data = $this->db->get_where('pasien', ['id_alat' => $id])->result_array();
        echo json_encode($data);
    }

    public function getdata($id_pasien, $id, $loopRange)
    {
        $this->load->model('M_data');
        $data = $this->M_data->dataEcg($id_pasien, $id, $loopRange);
        echo json_encode($data);
    }

    public function getdataFull($id_pasien, $id)
    {
        $this->load->model('M_data');
        $data = $this->M_data->dataEcgFull($id_pasien, $id);
        echo json_encode($data);
    }

    public function getdataII($id_pasien, $id)
    {
        $this->load->model('M_data');
        $data = $this->M_data->dataEcgII($id_pasien, $id);
        echo json_encode($data);
    }

    public function getDataFile($id)
    {
        $this->load->model('M_data');
        $data = $this->M_data->dataFile($id);
        echo json_encode($data);
    }

    public function getDataFilePasien($id)
    {
        $this->load->model('M_data');
        $data = $this->M_data->getDataFilePasien($id);
        echo json_encode($data);
    }

    public function getRpeak($id)
    {
        $this->load->model('M_data');
        $data = $this->M_data->dataRpeak($id);
        echo json_encode($data);
    }

    public function getdataPasien($id_pasien, $id)
    {
        $data = $this->db->get_where('pasien', ['id' => $id_pasien])->row_array();
        echo json_encode($data);
    }

    public function getDataRekaman($id_pasien, $id)
    {
        $this->load->model('M_dokter');
        $data = $this->M_dokter->rekamanPasien($id_pasien, $id);
        var_dump($data);
        die;
        echo json_encode($data);
    }
}
