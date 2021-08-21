<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-CPFhEb941poDUZmwImeJ-GiQ', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url', 'form');
		$this->load->model('myMode');
	}

	public function index()
	{
		$data['item'] = $this->myMode->tampilkanData('items')->result();
		$data['judul'] = 'Data';
		$this->load->view('home', $data);
	}
	public function tambahData()
	{
		$data['judul'] = 'Tambah Data';
		$this->load->view('tambah', $data);
	}
	public function aksitambah()
	{
		$nama_items = $this->input->post('nama_item');
		$harga = $this->input->post('harga');
		$gambar = $_FILES['gambar']['name'];
		if ($gambar == '') {
		} else {
			$config['upload_path'] = './asset/gambar';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']        = '2048';
			$config['file_name']				= 'gambar-' . substr(md5(rand()), 0, 3);
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('gambar')) {
			} else {
				$gambar = $this->upload->data('file_name');
			}
		}
		$data = array(
			'id'		=>	'',
			'nama_items' => $nama_items,
			'harga' => $harga,
			'gambar' => $gambar

		);
		$this->myMode->tambahData($data, 'items');

		$this->session->set_flashdata('pesan', '
		<script>
		alert("data berhasil ditambahkan");
		</script>
		');
		redirect('home');
	}
	public function aksiubah()
	{
		$nama_items = $this->input->post('nama_item');
		$harga = $this->input->post('harga');
		$id = $this->input->post('id');
		$gambar = $_FILES['gambar']['name'];
		if ($gambar == '') {
		} else {
			$config['upload_path'] = './asset/gambar';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']        = '2048';
			$config['file_name']				= 'gambar-' . substr(md5(rand()), 0, 3);
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('gambar')) {
			} else {
				$gambar = $this->upload->data('file_name');
				$this->db->set('gambar', $gambar);
			}
		}
		$data = array(
			'nama_items' => $nama_items,
			'harga' => $harga,

		);
		$where = array(
			'id'  => $id
		);
		$this->myMode->ubahData($data, 'items', $where);


		$this->session->set_flashdata('pesan', '
		<script>
		alert("data berhasil diubah");
		</script>
		');
		redirect('home');
	}
	public function ubah($id)
	{
		$data['judul'] = 'Ubah Data';
		$data['item'] = $this->myMode->itemById($id, 'items')->result();
		$this->load->view('ubahdata', $data);
	}
	public function hapus($id)
	{
		$this->myMode->hapusData($id, 'items');

		$this->session->set_flashdata('pesan', '
		<script>
		alert("data berhasil dihapus");
		</script>
		');
		redirect('home');
	}
	public function pembelian()
	{
		$data['item'] = $this->myMode->tampilkanData('items')->result();
		$data['judul'] = 'Data';
		$this->load->view('pembelian', $data);
	}
	public function token($id)
	{
		$data = $this->myMode->itemById($id, 'items')->result();
		// var_dump($data);
		foreach ($data as $d) {
			// Required
			$transaction_details = array(
				'order_id' => rand(),
				'gross_amount' => $d->harga, // no decimal allowed for creditcard
			);

			// Optional
			$item1_details = array(
				'id' => $d->id,
				'price' => $d->harga,
				'quantity' => 1,
				'name' => $d->nama_items
			);

			// Optional

		}

		// Optional
		$item_details = array($item1_details);

		// Optional
		$billing_address = array(
			'first_name'    => "Andri",
			'last_name'     => "Litani",
			'address'       => "Mangga 20",
			'city'          => "Jakarta",
			'postal_code'   => "16602",
			'phone'         => "081122334455",
			'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array();

		// Optional
		$customer_details = array();

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'minute',
			'duration'  => 2
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}
	public function status()
	{
		$cek = 	$this->midtrans->transactions('1919642463');
		var_dump($cek);
	}
	public function laporan()
	{
		$cek = $this->myMode->laporan()->result();
		for ($i = 0; $i < count($cek); $i++) {
			$status[$i] = $this->midtrans->status($cek[$i]->id_order);
		};

		$i = 0;
		foreach ($cek as $c) {
			if ($status[$i]->transaction_status == 'settlement') {
				$data = array(
					'status_transaksi' => 'settlement',

				);
				$where = array(
					'id_order'  => $c->id_order
				);
				$this->myMode->ubahData($data, 'pembayaran', $where);
			}
			if ($status[$i]->transaction_status == 'expire') {
				$data = array(
					'status_transaksi' => 'expire',

				);
				$where = array(
					'id_order'  => $c->id_order
				);
				$this->myMode->ubahData($data, 'pembayaran', $where);
			}
			$i++;
		}
		$data['judul']  = 'Laporan';
		$data['laporan'] = $this->myMode->laporan();
		$this->load->view('laporan', $data);
	}
	public function finish($id)
	{
		$result = json_decode($this->input->post('result_data'));
		// $result = json_decode($this->input->post('result_data'));
		echo 'RESULT <br><pre>';
		echo '</pre>';
		$id_item = $id;
		$total_harga = $result->gross_amount;
		$jenis_pembayaran = $result->payment_type;
		$status_transaksi = $result->transaction_status;
		$id_order = $result->order_id;

		$data = array(
			'id'		=>	'',
			'id_item' => $id_item,
			'id_order' => $id_order,
			'total_harga' => $total_harga,
			'jenis_pembayaran' => $jenis_pembayaran,
			'status_transaksi' => $status_transaksi
		);
		$this->myMode->tambahData($data, 'pembayaran');

		$this->session->set_flashdata('pesan', '
		<script>
		alert("data berhasil ditambahkan");
		</script>
		');
		redirect('home/laporan');
	}
}
