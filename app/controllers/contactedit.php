<?php
require_once '../app/models/contact-edit.php';

class ContactEdit extends Controller {
    protected $model = null;

    public function __construct() {
        $this->model = new ContactEditModel;
    }

    public function index($params = []) {
        $this->model->loadModel();
        
        //$this->model->loadParams($params);
    }
}
?>