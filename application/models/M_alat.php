<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_alat extends CI_Model
{
  public function listPasien()
  {
    $query = "SELECT pasien.nik, pasien.alamat, pasien.id as 'id', pasien.nama as 'nama', alat.nama as 'nama_alat' FROM pasien 
    INNER JOIN alat ON pasien.id_alat = alat.id
    INNER JOIN user ON pasien.NIK = user.email";

    return $this->db->query($query)->result_array();
  }
}
