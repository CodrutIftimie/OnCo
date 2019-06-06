<?php
require_once '../app/models/groups.php';

class Groups extends Controller {
    protected $model = null;

    public function __construct() {
        $this->model = new GroupsModel;
    }

    public function index($params) {
        $this->model->loadModel();
    }
}
?>