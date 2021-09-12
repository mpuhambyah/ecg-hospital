<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Rumah Fafa';
		$data['profile'] = $this->db->get('profile')->row_array();
		$data['contentCarousel'] = $this->db->get('content-carousel')->result_array();
		$data['contentAbout'] = $this->db->get('content-about')->result_array();
		$data['categoryMenu'] = $this->db->get('category-menu')->result_array();
		$data['listMenu'] = $this->db->get('menu')->result_array();
		$data['specialMenu'] = $this->db->get_where('menu', ['special' => 1])->result_array();
		$data['galleryMenu'] = $this->db->get_where('menu', ['show_to_gallery' => 1])->result_array();
		$data['feedBack'] = $this->db->get_where('feedback', ['is_active' => 1])->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('user/dashboard', $data);
		$this->load->view('template/footer', $data);
	}

	public function getData()
	{
		$data['profile']  = $this->db->get('profile')->row_array();
		$data['new'] = [
			"headerWA" => 'Temukan kami di WhatsApp!',
			"messagesWA" => 'Halo, apakah kami bisa bantu?',
		];
		echo json_encode($data);
	}

	public function getShowMenu()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('menu', ['id' => $id])->row_array();
		echo json_encode($data);
	}

	public function uploadFeedBack()
	{
		$data = array(
			'ok' => $this->input->post('email')
		);

		echo 'OK';
	}
}
