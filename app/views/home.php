<?php

class HomeView extends View {
    protected $headTags = [];
    protected $body = '';
    protected $contacts = null;
    protected $groups = null;

    public function __construct() {
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/reseter.css" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/index.css" rel="stylesheet">');
    }

    public function constructBody() {
        $this->body = 
        '<button id="show-filters" onclick="showFilters()">Filtre</button>
        <form class="filter-list" method="GET" action="index.html">
            <button id="close-filters" onclick="closeFilters()">❌ Inchide</button>
            <button id="apply-filters" onclick="applyFilters()">Aplica</button>
            <div class="filter-list-object">
                <h1>Nume</h1>
                <input name="name" type="text" placeholder="Klaus" />
            </div>
            <div class="filter-list-object">
                <h1>Varsta</h1>
                <input name="age-min" id="age-min-input" class="age" type="number" value="8" min="8" max="56" />
                <input name="age-max" id="age-max-input" class="age" type="number" value="120" min="56" max="120" />
            </div>
            <div class="filter-list-object">
                <h1>Locatie</h1>
                <input name="location" id="iasi" type="checkbox" value="Iasi" />
                <label for="iasi" class="check-box">Iasi</label>
                <input name="location" id="bucuresti" type="checkbox" value="Bucuresti" />
                <label for="bucuresti" class="check-box">Bucuresti</label>
                <input name="location" id="cluj" type="checkbox" value="Cluj" />
                <label for="cluj" class="check-box">Cluj</label>
                <input name="location" id="timisoara" type="checkbox" value="Timisoara" />
                <label for="timisoara" class="check-box">Timisoara</label>
            </div>
            <div class="filter-list-object">
                <h1>Scoala / Facultate</h1>
                <input name="studies" id="fii" type="checkbox" value="FII" />
                <label for="fii" class="check-box">Facultatea de Informatica</label>
                <input name="studies" id="feaa" type="checkbox" value="FEAA" />
                <label for="feaa" class="check-box">Facultatea de Economie și
                        Administrarea Afacerilor</label>
                <input name="studies" id="etti" type="checkbox" value="ETTI" />
                <label for="etti" class="check-box">Facultatea de Electronică,
                        Telecomunicații și Tehnologia Informației</label>
                <input name="studies" id="chimie" type="checkbox" value="Chimie" />
                <label for="chimie" class="check-box">Facultatea de Chimie</label>
            </div>
            <div class="filter-list-object">
                <h1>Interese</h1>
                <input name="interests" type="text" placeholder="ceai filme" />
            </div>
            <input type="submit" style="display:none" />
    
        </form>
        <ul class="contacts-list">';
        if($this->contacts != null) {
            foreach($this->groups as $group) {
                $this->body = $this->body . '
                <li class="group-start">
                    <p>' . $group -> name . '</p>
                </li>';
                    foreach($this->contacts as $card) {
                        if($card->groupId == $group -> id) {
                            $contactHTML = '
                            <li class="card">
                                <div class="card-up">
                                    <h1 class="description">'. $card -> description.'</h1>';
                            $contactHTML = $contactHTML . '
                            </div>
                                <div class="card-down">
                                <img src="' . $card -> pictureURL . '" alt="Profile picture" />';
                            $contactHTML = $contactHTML . '
                            <h3>' . $card -> name . '</h3>';
        
                            $contactHTML = $contactHTML . '
                            <h2>'. $card -> phone . '</h2>
                            </div>
                            <div class="card-hover">
                                <h3>'. $card -> name . '</h3>
                                <button>Copiaza numarul</button>
                                <a href="profile.html">Profil</a>
                                </div>
                            </li>';
                            $this->body = $this->body . $contactHTML;
                        }
                    }
                }   
            }
            else  {
                $this->body = $this->body . '<p>Nici un contact</p>';
            }

        $this->body = $this->body . '
        </ul>
        <script>
        var minAge = document.getElementById("age-min");
        var maxAge = document.getElementById("age-max");
        var minAgeInput = document.getElementById("age-min-input");
        var maxAgeInput = document.getElementById("age-max-input");
        minAge.oninput = function() {
            minAgeInput.value = this.value;
        }
        maxAge.oninput = function() {
            maxAgeInput.value = this.value;
        }
        minAgeInput.oninput = function() {
            minAge.value = this.value;
        }
        maxAgeInput.oninput = function() {
            maxAge.value = this.value;
        }

        function showFilters() {
            var filters = document.getElementsByClassName("filter-list")[0];
            var contacts = document.getElementsByClassName("contacts-list")[0];
            filters.classList.add("filter-list-shown");
            contacts.classList.add("hide-contacts-list");
        }

        function closeFilters() {
            var filters = document.getElementsByClassName("filter-list")[0];
            var contacts = document.getElementsByClassName("contacts-list")[0];
            filters.classList.remove("filter-list-shown");
            contacts.classList.remove("hide-contacts-list");
        }
        </script>
        ';
    }

    public function setContacts($contacts) {
        $this->contacts = $contacts;
    }

    public function setGroups($groups) {
        $this->groups = $groups;
    }

    public function getHeadTags() {
        return $this->headTags;
    }

    public function getBody() {
        return $this->body;
    }

    public function showBody() {
        echo $this->body;
    }
}

?>