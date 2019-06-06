<?php
require_once '../app/core/ContactData.php';
require_once '../app/views/navigation.php';
require_once '../app/views/header.php';
require_once '../app/views/groups.php';


class GroupsModel extends Model {

    protected $nav = null;
    protected $header = null;
    protected $view = null;

    protected $tags = [];

    public function loadModel() {
        $this->nav = new NavigationView;
        $this->view = new GroupsView;

        foreach ($this->nav->getHeadTags() as $tag) {
            array_push($this->tags, $tag);
        }

        foreach ($this->view->getHeadTags() as $tag) {
            array_push($this->tags, $tag);
        }

        $this->header = new Header($this->tags,"Grupari");
        $cts = $this->getContacts();
        $gps = $this->getGroups();

        $this->view->setContacts($cts);
        $this->view->setGroups($gps);

        $this->view->constructBody();
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

}

?>