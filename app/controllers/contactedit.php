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
        $vector = null;
      
       

        if(isset($parametru["mode"])){
            if($parametru["mode"]== 'edit'){
                if(isset($parametru["id"])){
                    $this->model->setContactId($parametru['id']);
                    $this->model->loadModel('edit');  
                    
                }
                else
                $this->model->loadModel('add');
            }
            else
                $this->model->loadModel('add');
        }
        else
        $this->model->loadModel('add');
        
        if(isset($_POST['nume'])){
            
            $vector = array();
            $vector['nume']=$_POST['nume'];
            $vector['adresa']=$_POST['adresa'];
            $vector['data_nastere']=$_POST['data_nastere'];
            $vector['email1']=$_POST['email1'];
            $vector['email2']=$_POST['email2'];
            $vector['descriere']=$_POST['descriere'];
            $vector['nr_telefon1']=$_POST['nr_telefon1'];
            $vector['nr_telefon2']=$_POST['nr_telefon2'];
            $vector['interese']=$_POST['interese'];
            $vector['adresa_web2']=$_POST['adresa_web2'];
            $vector['adresa_web1']=$_POST['adresa_web1'];
            $vector['studii']=$_POST['studii'];
            $vector['imagine']=$_POST['imagine'];
            $vector['userId']=$this->model->setContactId($parametru['id']);


            
            if(isset($_POST['Editeaza']))
                $this->model->editContact($vector);
            else
                $this->model->addContact($vector);
        }
    }
}
?>