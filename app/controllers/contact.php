<?php
require_once '../app/models/contact.php';

class Contact extends Controller {
    protected $model = null;
    protected $contactId = null;

    public function __construct() {
        $this->model = new ContactModel;
    }

    public function index($params = []) {
        $parametru=$this->model->parseParams($params);
        if(isset($parametru["id"])){
            $this->model->setContactId($parametru['id']);
            $this->model->loadModel();
        }
        
        //$this->model->loadParams($params);
    }
}
?>