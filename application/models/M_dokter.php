<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dokter extends CI_Model
{
  public function listPasien()
  {
    $query = "SELECT pasien.alamat, pasien.id as 'id', pasien.nama as 'nama', alat.nama as 'nama_alat' FROM pasien INNER JOIN alat ON pasien.id_alat = alat.id";

    return $this->db->query($query)->result_array();
  }

  public function dataPasien()
  {
    $query = "SELECT pasien.id as 'id', pasien.nama as 'nama', alat.nama as 'nama_alat', rekaman.status_check as 'status', rekaman.tanggal as 'tanggal', rekaman.id as 'id_rekaman' FROM pasien INNER JOIN alat ON pasien.id_alat = alat.id INNER JOIN rekaman ON pasien.id = rekaman.id_pasien";

    return $this->db->query($query)->result_array();
  }

  public function dataPasienUnchecked()
  {
    $query = "SELECT pasien.id as 'id', pasien.nama as 'nama', alat.nama as 'nama_alat', rekaman.status_check as 'status', rekaman.tanggal as 'tanggal', rekaman.id as 'id_rekaman' FROM pasien INNER JOIN alat ON pasien.id_alat = alat.id INNER JOIN rekaman ON pasien.id = rekaman.id_pasien WHERE rekaman.status_check = 0";

    return $this->db->query($query)->result_array();
  }

  public function listRekaman($id)
  {
    $query = "SELECT pasien.id as 'id', pasien.nama as 'nama', alat.nama as 'nama_alat', rekaman.status_check as 'status', rekaman.tanggal as 'tanggal', rekaman.id as 'id_rekaman' FROM pasien INNER JOIN alat ON pasien.id_alat = alat.id INNER JOIN rekaman ON pasien.id = rekaman.id_pasien WHERE pasien.id = $id";

    return $this->db->query($query)->result_array();
  }

  public function rekamanPasien($id, $id_rekaman)
  {
    $query = "SELECT pasien.id as 'id', pasien.nama as 'nama', alat.nama as 'nama_alat', rekaman.status_check as 'status', rekaman.tanggal as 'tanggal', rekaman.id as 'id_rekaman' FROM pasien INNER JOIN alat ON pasien.id_alat = alat.id INNER JOIN rekaman ON pasien.id = rekaman.id_pasien WHERE pasien.id = $id AND rekaman.id = $id_rekaman";

    return $this->db->query($query)->row_array();
  }

  public function listActivity()
  {
    $query = "SELECT activities.id as 'id', activities.id_rekaman, activities.created_at as 'tanggal', user.name as 'nama_user', pasien.nama as 'nama_pasien', activities_list.nama as 'nama_activity', 
    activities_list.keterangan as 'keterangan_activity', activities_list.logo as 'logo'
    FROM activities 
    INNER JOIN activities_list ON activities.id_activity = activities_list.id 
    INNER JOIN pasien ON activities.target = pasien.id INNER JOIN user ON activities.id_user = user.id ORDER BY activities.id DESC";

    return $this->db->query($query)->result_array();
  }

  public function listFile()
  {
    $query = "SELECT uploaded.id as 'id', user.name as 'nama_user', pasien.nama as'nama_pasien', uploaded.created_at as 'tanggal', uploaded.id_rekaman, uploaded.keterangan
    FROM uploaded 
    INNER JOIN pasien ON pasien.id = uploaded.id_pasien 
    INNER JOIN user ON user.id = uploaded.created_by 
    ORDER BY uploaded.id DESC";

    return $this->db->query($query)->result_array();
  }
}
