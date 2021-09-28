<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{
  public function dataEcg($id_pasien, $id)
  {
    $query = "SELECT ecg.i, ecg.ii, ecg.iii, ecg.avr, ecg.avl, ecg.avf, ecg.v1, ecg.v2, ecg.v3, ecg.v4, ecg.v5, ecg.v6 FROM ecg WHERE id_pasien = $id_pasien AND id_rekaman = $id ORDER BY id DESC LIMIT 800";

    return $this->db->query($query)->result_array();
  }

  public function dataEcgII($id_pasien, $id)
  {
    $query = "SELECT ecg.ii FROM ecg WHERE id_pasien = $id_pasien AND id_rekaman = $id ORDER BY id DESC LIMIT 800";

    return $this->db->query($query)->result_array();
  }

  public function dataFile($id)
  {
    $query = "SELECT rpeak.annotation, rpeak.ecg
    FROM rpeak WHERE rpeak.id_upload = $id
    ORDER BY rpeak.id DESC";

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
