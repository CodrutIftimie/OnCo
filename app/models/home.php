<?php
require_once '../app/core/ContactData.php';
require_once '../app/views/navigation.php';
require_once '../app/views/header.php';
require_once '../app/views/home.php';


class HomeModel extends Model
{
    protected $nav = null;
    protected $head = null;
    protected $view = null;

    protected $params = [];
    protected $contacts = [];
    protected $tags = [];

    public function loadModel() {
        $this->nav = new NavigationView;
        $this->view = new HomeView;
        $this->loadDefault();
    }

    public function loadParams($params = [])
    {
        $this->params = $this->parseParams($params);
    }

    private function loadDefault() {
        // Incarca linkurile din head
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
