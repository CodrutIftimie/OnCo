<?php
require_once '../app/models/authentication.php';

class Authentication extends Controller {
    protected $model = null;

    public function __construct() {
        $this->model = new AuthenticationModel;
    }

    public function index($params = []) {
        $this->model->loadModel($params);

        if(isset($_POST["submit"])) {
            switch($_POST['submit']) {
                case 'Submit_register':
                    if(isset($_POST['nume'])){
                        $vector = array();
                        $vector['nume']=$_POST['nume'];
                        $vector['email1']=$_POST['email'];
                        $vector['parola']=$_POST['parola'];
                        $vector['adresa']='';
                        $vector['data_nastere']='';
                        $vector['email2']='';
                        $vector['descriere']='';
                        $vector['nr_telefon1']='';
                        $vector['nr_telefon2']='';
                        $vector['interese']='';
                        $vector['adresa_web2']='';
                        $vector['adresa_web1']='';
                        $vector['studii']='';
                        $vector['imagine']='/../../public/styles/default_profile_icon.png';
                        $this->model->register($vector);
                        header("Location: /public/home/"); 
                    }
                    break;

                case 'Submit_login':
                    if(isset($_POST['utilizator'])){
                        $vector = array();
                        $vector['email']=$_POST['utilizator'];
                        $vector['parola']=$_POST['parola'];
                        if($this->model->login($vector) == 1 )
                            header("Location: /public/home/");  
                    }
                    break;

                default:
                    break;
            }
        }
        
    }

    public function logout($params = []){
        setcookie("authentication", null, -1, "/");
        unset($_SESSION["userId"]);
        header("Location: /public/authentication");
    }
}
?>