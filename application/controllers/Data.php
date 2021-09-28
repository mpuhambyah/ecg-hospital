<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function getdata($id_pasien, $id)
    {
        $this->load->model('M_data');
        $data = $this->M_data->dataEcg($id_pasien, $id);
        echo json_encode($data);
    }

    public function getdataII($id_pasien, $id)
    {
        $this->load->model('M_data');
        $data = $this->M_data->dataEcgII($id_pasien, $id);
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
        echo json_encode($data);
    }
}
