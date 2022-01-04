<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function process()
	{
		$nama = $this->input->post('nama');
		$nominal = $this->input->post('nominal1');
		$tgldeposito = $this->input->post('tgl1');
		$tglambil = $this->input->post('tgl2');
		$date1 = date_create($tgldeposito);
		$date1Format = date_format($date1,"d M Y");
		$date2 = date_create($tglambil);
		$date2Format = date_format($date2,"d M Y");
		$diff = date_diff($date1,$date2);
		$Bunga = ((($nominal * 5) / 100) * $diff->days);
		$result = $nominal + $Bunga;
		
		$datas = [
			'nama' => $nama,
			'nominal' => number_format($nominal),
			'tgldeposito' => $date1Format,
			'tglambil' => $date2Format,
			'bunga' => 5,
			'hasil' => number_format($result)
		];
		
		echo json_encode([
			'status' => 'TRUE',
			'result' =>  $datas
		]);
	}
}
