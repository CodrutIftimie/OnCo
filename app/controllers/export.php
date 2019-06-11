<?php
require_once '../app/models/export.php';

class Export extends Controller {
    protected $model = null;
    protected $contactId = null;

    public function __construct() {
        $this->model = new ExportModel;
    }

    public function index($params = []) {
        $parametru=$this->model->parseParams($params);
        
        //$this->model->loadParams($params);
    }

    public function csv($params = []) {
        $parametru=$this->model->parseParams($params);
        if(isset($parametru['id']))
            {
                $this->model->exportCSV($parametru['id'][0]);
                header("Location: /public");
            }
        else {
            $this->model->exportCSV();
            header("Location: /public");
            }   
    }

    public function vcard($params = []) {
      
    }
}
?>