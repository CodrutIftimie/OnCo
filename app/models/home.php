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

    protected $lcts = [];
    protected $stds = [];
    protected $ints = [];

    public function loadModel() {
        $this->nav = new NavigationView;
        $this->view = new HomeView;
        $this->loadDefault();
    }

    public function loadParams($params = []) {
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

        $this->lcts = $this->getLocations();
        $this->stds = $this->getStudies($cts);
        $this->ints = $this->getInterests($cts);
        $this->checkFilters();

        $this->view->setFilters($this->lcts,$this->stds,$this->ints);
        $this->view->setParams($this->params);

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
            $locations = array_unique($locations);
        }
        return $locations;
    }

    private function getStudies($contacts) {
        $studies = [];
        foreach($contacts as $cont) {
            if($cont->studies != null) {
                array_push($studies, $cont->studies);
            }
        }
        return array_unique($studies);
    }

    private function getInterests($contacts) {
        $interests = [];
        foreach($contacts as $cont) {
            if($cont->studies != null) {
                array_push($interests, $cont->interests);
            }
        }
        return array_unique($interests);
    }

    private function checkFilters() {
        $newArr = [];
        if($this->params != null) {
            foreach($this->params as $key => $val) {
                if($key == "name" || $key == "minage" || $key == "maxage")
                    $newArr[$key] = $val;
                else if($key == "location") {
                    $newArr[$key] = array();
                    $vals = explode("|",$val);
                    foreach($vals as $value) {
                        $value = implode(" ", explode("+", $value));
                        if(in_array($value,$this->lcts))
                            array_push($newArr[$key], $value);
                    }
                }
                else if($key == "studies") {
                    $newArr[$key] = array();
                    $vals = explode("|",$val);
                    foreach($vals as $value) {
                        $value = implode(" ", explode("+", $value));
                        if(in_array($value,$this->stds))
                            array_push($newArr[$key], $value);
                    }
                }
                else if($key == "interests")
                    $newArr[$key] = explode(" ",$val);
            }
        }
        $this->params = $newArr;
    }
}
