<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Test_model');
        $this->load->helper(['url','form']);
        $this->load->library('session');
    }

    public function index() {
        $data['surat'] = $this->Surat_model->get_all();
        $this->load->view('surat', $data);
    }

    public function store() {
        $data = [
            'nomor_surat' => $this->input->post('nomor_surat'),
            'perihal' => $this->input->post('perihal'),
            'tanggal' => $this->input->post('tanggal'),
            'keterangan' => $this->input->post('keterangan'),
        ];

        $this->Surat_model->insert($data);
        $this->session->set_flashdata('success', 'Surat berhasil ditambahkan.');
        redirect('surat');
    }

    public function edit($id) {
        $data['surat'] = $this->Surat_model->get_all();
        $data['edit_surat'] = $this->Surat_model->get_by_id($id);
        $this->load->view('surat', $data);
    }

    public function update($id) {
        $data = [
            'nomor_surat' => $this->input->post('nomor_surat'),
            'perihal' => $this->input->post('perihal'),
            'tanggal' => $this->input->post('tanggal'),
            'keterangan' => $this->input->post('keterangan'),
        ];

        $this->Surat_model->update($id, $data);
        $this->session->set_flashdata('success', 'Surat berhasil diupdate.');
        redirect('surat');
    }

    public function delete($id) {
        $this->Surat_model->delete($id);
        $this->session->set_flashdata('success', 'Surat berhasil dihapus.');
        redirect('surat');
    }
}
