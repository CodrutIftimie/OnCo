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

    public function loadModel($params = []) {
        $this->nav = new NavigationView;
        $this->view = new HomeView;
        if(count($params) == 0) {
            $this->params = [];
            $this->loadDefault();
        }
        else {
            $this->params = $this->parseParams($params);
            $this->loadFiltered();
        }
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
        $this->stds = $this->getStudies();
        $this->checkFilters();

        $this->view->setFilters($this->lcts,$this->stds);
        $this->view->setParams($this->params);

        $this->view->constructBody();
        //Afiseaza pagina
        $this->view->showBody();
    }

    private function loadFiltered() {
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

        $gps = $this->getGroups();
        $this->view->setGroups($gps);

        $this->lcts = $this->getLocations();
        $this->stds = $this->getStudies();
        $this->checkFilters();

        $query = "SELECT * FROM contacts WHERE";

        $somethingBefore = false;
        foreach($this->params as $key => $val) {
            if($key == 'name') {
                $query = $query . " name LIKE '%" . $val . "%'";
                $somethingBefore = true;
            }
        }

        if($somethingBefore == true)
            $condition = " AND (";
        else $condition = "(";

        $foundAddress = false;
        foreach($this->params as $key => $val) {
            if($key == 'location') {
                foreach($val as $single)
                    $condition = $condition . " OR address LIKE '%" . $single . "%'";
                    $foundAddress = true;
                    $somethingBefore = true;
            break;
            }
        }

        if($foundAddress == true)
            $query = $query . " (" . substr($condition, 5) . ")";


        if($somethingBefore == true)
            $condition = " AND (studies";
        else $condition = "(";

        $foundStudies = false;
        foreach($this->params as $key => $val) {
            if($key == 'studies') {
                foreach($val as $single)
                    $condition = $condition . " OR studies='" . $single . "'";
                    $foundStudies = true;
                    $somethingBefore = true;
            break;
            }
        }

        if($foundStudies == true)
            $query = $query . " (" . substr($condition, 5) . ")";

        $foundInterests = false;

        if($somethingBefore == true)
            $condition = " AND (";
        else $condition = "(";

        foreach($this->params as $key => $val) {
            if($key == 'interests') {
                foreach($val as $single)
                    $condition = $condition . " OR interests LIKE '%" . $single . "%'";
                    $foundInterests = true;
                    $somethingBefore = true;
                    break;
            }
        }

        if($foundInterests == true)
            $query = $query . " (" . substr($condition, 5) . ")";
        else if ($somethingBefore == false) {
            $query = "SELECT * FROM contacts";
        }
        $cts = $this->getContacts($query);
        $this->view->setContacts($cts);

        $this->view->setFilters($this->lcts,$this->stds);
        $this->view->setParams($this->params);

        $this->view->constructBody();
        //Afiseaza pagina
        $this->view->showBody();

    }

    private function getContacts($qr = null) {
        $contacts = null;
        $query = "";
        if($qr == null)
            $query = "SELECT * FROM contacts";
        else $query = $qr;
        $result = $this->database->query($query);
        if (!$result) {
            trigger_error('Invalid query: ' . $this->database->error);
        }
        else {
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

    private function getStudies() {

        $studies = null;
        $query = "SELECT studies FROM contacts";
        $result = $this->database->query($query);
        if($result->num_rows > 0) {
            $studies = array();
            while($row = $result->fetch_assoc()) {
                if($row["studies"] != null)
                    array_push($studies, $row["studies"]);
            }
        }
        if($studies!= null) {
            $studies = array_unique($studies);
        }
        return $studies;

        // $studies = [];
        // foreach($contacts as $cont) {
        //     if($cont->studies != null) {
        //         array_push($studies, $cont->studies);
        //     }
        // }
        // return array_unique($studies);
    }

    private function checkFilters() {
        $newArr = [];
        if($this->params != null) {
            foreach($this->params as $key => $val) {
                if($key == "age-max" || $key == "age-min")
                    $newArr[$key] = $val[0];
                else if($key == "name") {
                    $newArr[$key] = implode(" ", explode("+",$val[0]));
                }
                else if($key == "location") {
                    $newArr[$key] = array();
                    foreach($val as $value) {
                        $value = implode(" ", explode("+", $value));
                        if(in_array($value,$this->lcts))
                            array_push($newArr[$key], $value);
                    }
                }
                else if($key == "studies") {
                    $newArr[$key] = array();
                    foreach($val as $value) {
                        $value = implode(" ", explode("+", $value));
                        if(in_array($value,$this->stds))
                            array_push($newArr[$key], $value);
                    }
                }
                else if($key == "interests")
                    $newArr[$key] = explode("+",$val[0]);
            }
        }
        $this->params = $newArr;
    }
}
