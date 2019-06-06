<?php
    require_once '../app/views/navigation.php';
    require_once '../app/views/header.php';
    require_once '../app/views/contact-edit.php';

    class ContactEditModel extends Model {
        protected $nav = null;
        protected $head = null;
        protected $view = null;
        protected $tags = [];

        public function loadModel() {
            $this->nav = new NavigationView;
            $this->view = new ContactEditView;
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
            $this->head = new Header($this->tags, "Index");

            //Afiseaza bara de navigatie
            $this->nav->showBody();
            //Afiseaza pagina
            $this->view->showBody();

        }
    


    }
?>