<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress extends CI_Controller {

    public function index() {
        $this->load->model('Progress_model');
        $data['progress'] = $this->Progress_model->get_progress();
        $this->load->view('step_progress_view', $data);
    }
}
