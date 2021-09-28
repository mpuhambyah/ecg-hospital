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
}
