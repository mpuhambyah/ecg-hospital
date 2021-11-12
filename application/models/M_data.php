<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{

  public function dataProfile($id)
  {
    $query = "SELECT user.name as 'nama', user.email as 'username', user.is_activem, user.date_created, pasien.alamat, user_role.name as 'role'
    FROM user 
    INNER JOIN pasien ON user.email = pasien.NIK 
    INNER JOIN user_role ON user.role_id = user_role.id 
    WHERE user.id = $id";

    return $this->db->query($query)->row_array();
  }

  public function listPasienAPI($id)
  {
    $query = "SELECT pasien.id, pasien.id_alat, pasien.nik,  pasien.nama as 'nama', pasien.alamat, user.is_active
    FROM pasien 
    INNER JOIN user ON pasien.NIK = user.email
    WHERE user.is_active = 1 AND pasien.id_alat = $id";

    return $this->db->query($query)->result_array();
  }

  public function dataEcgFull($id_pasien, $id)
  {
    $query = "SELECT ecg.timestamp, ecg.i, ecg.ii, ecg.iii, ecg.avr, ecg.avl, ecg.avf, ecg.v1, ecg.v2, ecg.v3, ecg.v4, ecg.v5, ecg.v6 FROM ecg WHERE id_pasien = $id_pasien AND id_rekaman = $id ORDER BY id DESC";

    return $this->db->query($query)->result_array();
  }

  public function dataEcg($id_pasien, $id, $loopRange)
  {
    $limit = 800;
    $limit2 = 800 * ($loopRange - 1);
    $query = "SELECT ecg.timestamp, ecg.i, ecg.ii, ecg.iii, ecg.avr, ecg.avl, ecg.avf, ecg.v1, ecg.v2, ecg.v3, ecg.v4, ecg.v5, ecg.v6 FROM ecg WHERE id_pasien = $id_pasien AND id_rekaman = $id ORDER BY id DESC LIMIT $limit2, $limit";

    return $this->db->query($query)->result_array();
  }


  public function dataRpeak($id)
  {
    $query = "SELECT * FROM rpeak WHERE id_upload = $id ORDER BY id ASC";

    return $this->db->query($query)->result_array();
  }

  public function dataEcgII($id_pasien, $id)
  {
    $query = "SELECT ecg.timestamp, ecg.ii FROM ecg WHERE id_pasien = $id_pasien AND id_rekaman = $id ORDER BY id DESC";

    return $this->db->query($query)->result_array();
  }

  public function dataFile($id)
  {
    $query = "SELECT rpeak.annotation, rpeak.timestamp, rpeak.ecg
    FROM rpeak WHERE rpeak.id_upload = $id
    ORDER BY rpeak.id ASC";

    return $this->db->query($query)->result_array();
  }

  public function getDataFilePasien($id)
  {
    $query = "SELECT uploaded.id as 'id', user.name as 'nama_user', pasien.nama as'nama_pasien', uploaded.created_at as 'tanggal', uploaded.id_rekaman, uploaded.keterangan
    FROM uploaded 
    INNER JOIN pasien ON pasien.id = uploaded.id_pasien 
    INNER JOIN user ON user.id = uploaded.created_by 
    WHERE uploaded.id = $id";

    return $this->db->query($query)->row_array();
  }
}
