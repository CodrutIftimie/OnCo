<?php
require_once '../app/models/contact-edit.php';

class ContactEdit extends Controller {
    protected $model = null;
    protected $contactId = null;

    public function __construct() {
        $this->model = new ContactEditModel;
    }

    public function index($params = []) {
        $parametru=$this->model->parseParams($params);
        if(isset($parametru["mode"])){
            if($parametru["mode"]== 'edit')
                if(isset($parametru["id"])){
                    $this->model->setContactId($parametru['id']);
                    $this->model->loadModel('edit');
                }
                
                    else
                $this->model->loadModel('add');
        }
        else
        $this->model->loadModel('add');
        print_r($parametru);
    }
}
?>