<?php

    require_once '../app/views/navigation.php';
    require_once '../app/views/header.php';

    class ExportModel extends Model {
        protected $nav = null;
        protected $head = null;
        protected $view = null;
        protected $tags = [];
        protected $data = [];
        protected $contactId = null;

        public function loadModel() {
            $this->view = new ExportView;
            $this->loadDefault();
        }



        public function loadDefault(){
            foreach ($this->view->getHeadTags() as $tag) {
                array_push($this->tags, $tag);
            }

            //incarca tagul <head>
            $this->head = new Header($this->tags, "Export");

            $this->view->constructBody();
            //Afiseaza pagina
            $this->view->showBody();

        }
        public function loadParams($params = []) {
            $this->params = $this->parseParams($params);
        }

        public function exportCSV($id = -1){
            $fisier = 'fisier.csv';
            $fp = fopen($fisier,'w');
            $sql = '';
            if($id != -1)
                $sql = 'SELECT * FROM contacts WHERE contactId=\''.$id.'\';';
            else $sql = 'SELECT * FROM contacts WHERE userId=\''.$_SESSION["userId"].'\';';

            $result = $this->database->query($sql);
            if(!$result){
                die($this->database->error);
            }
            else
            {
                while($row = $result->fetch_assoc()) 
                {
                    
                    $date = array($row["contactId"],$row["name"],$row["phoneNumber1"],$row["phoneNumber2"],$row["email1"],
                                $row["email2"],$row["description"],$row["address"],$row["birthDate"],$row["webAddress1"],$row["webAddress2"],
                                $row["interests"],$row["studies"],$row["pictureAddress"],$row["groupId"],$row["userId"]);
                    fputcsv($fp, $date, ',', '"');
                
                }
                fclose($fp);  
               
            }
            
            
        }

       


    }

?>