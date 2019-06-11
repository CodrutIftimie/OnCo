<?php
    require_once '../app/core/ContactData.php';
    require_once '../app/views/navigation.php';
    require_once '../app/views/header.php';
    require_once '../app/views/contact.php';

    class ContactModel extends Model {
        protected $nav = null;
        protected $head = null;
        protected $view = null;
        protected $tags = [];
        protected $data = [];
        protected $contactId = null;

        public function loadModel() {
            $this->nav = new NavigationView;
            $this->view = new ContactView;
           
             $this->loadDefault();
        }

        


        public function loadDefault(){
            
            foreach ($this->nav->getHeadTags() as $tag) {
                array_push($this->tags, $tag);
            }
            foreach ($this->view->getHeadTags() as $tag) {
                array_push($this->tags, $tag);
            }

            //incarca tagul <head>
            $this->head = new Header($this->tags, "Profil");

            //Afiseaza bara de navigatie
            $this->nav->showBody();
            $data=$this->getContactData($this->contactId);
            $this->view->setValues($data);
            $this->view->constructBody();
            //Afiseaza pagina
            $this->view->showBody();

        }


        private function getContactData($contactId) {
            $data = null;
            $query = 'SELECT * FROM contacts where contactId="'.$contactId.'"' ;
            $result = $this->database->query($query);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data = new ContactData;
                    $data -> id = $row["contactId"];
                    $data -> name = $row["name"];
                    $data -> phone = $row["phoneNumber1"];
                    $data -> phone2 = $row["phoneNumber2"];
                    $data -> email = $row["email1"];
                    $data -> email2 = $row["email2"];
                    $data -> description = $row["description"];
                    $data -> address = $row["address"];
                    $data -> birthDate = $row["birthDate"];
                    $data -> webAddress = $row["webAddress1"];
                    $data -> webAddress2 = $row["webAddress2"];
                    $data -> interests = $row["interests"];
                    $data -> studies = $row["studies"];
                    $data -> pictureURL = $row["pictureAddress"];
                    $data -> groupId = $row["groupId"];
                    $data -> userId = $row["userId"];
                }
            }
            return $data;
        }

        public function setContactId($id){
            $this->contactId=$id;
            
        }

        public function edit($id) {
            header("Location: /public/contactedit/mode=edit/id=".$id);
        }

    }
?>