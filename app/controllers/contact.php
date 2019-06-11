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

        if(isset($_POST["exp"]))
            header("Location: /public/export/".$_POST["exp"]."/id=".$_POST["id"]);

        if(isset($parametru["id"])){
            $this->model->setContactId($parametru['id'][0]);
            $this->model->loadModel();
        }
        else if(isset($_POST["edit"])) {
            $this->model->edit($parametru["id"][0]);
        }
        //$this->model->loadParams($params);
    }
}
?>