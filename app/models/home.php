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

        $cts = $this->getContacts();
        $this->view->setContacts($cts);

        $gps = $this->getGroups();
        $this->view->setGroups($gps);

        $lcts = $this->getLocations();
        $this->view->setLocations($lcts);

        $this->view->constructBody();
        //Afiseaza pagina
        $this->view->showBody();
    }

    private function getContacts() {
        $contacts = null;
        $query = "SELECT * FROM contacts";
        $result = $this->database->query($query);
        if($result->num_rows > 0) {
            $contacts = array();
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
                array_push($contacts, $data);
            }
        }
        return $contacts;
    }

    private function getGroups() {
        $groups = null;
        $query = "SELECT * FROM groups";
        $result = $this->database->query($query);
        if($result->num_rows > 0) {
            $groups = array();
            while($row = $result->fetch_assoc()) {
                $data = (object)[
                    'id' => $row["groupId"],
                    "name" => $row["name"]
                ];
                array_push($groups, $data);
            }
        }
        return $groups;
    }

    private function getLocations() {
        $locations = null;
        $query = "SELECT SUBSTRING_INDEX(address,' ',-1) AS city FROM contacts";
        $result = $this->database->query($query);
        if($result->num_rows > 0) {
            $locations = array();
            while($row = $result->fetch_assoc()) {
                if($row["city"] != null)
                    array_push($locations, $row["city"]);
            }
        }
        if($locations != null) {
            array_unique($locations);
        }
        return $locations;
    }
}
