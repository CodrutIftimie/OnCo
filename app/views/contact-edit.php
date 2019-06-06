<?php

class ContactEditView extends View {
    protected $headTags = [];
    protected $body = '';
    protected $values = null;
    protected $numePagina = null;

    public function __construct() {

        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/reseter.css" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/add_contact.css" rel="stylesheet">');
    }

    public function constructBody() {


        if($this->values == null) {

            $this->values->name="";            
            $this->values->description="";
            $this->values->phone ="";
            $this->values->pictureURL="";

            $this->values->phone2="";
            $this->values->email = "";
            $this->values->email2 = "";
            $this->values->address = "";
            $this->values->birthDate = "";
            $this->values->webAddress = "";
            $this->values->webAddress2 = "";
            $this->values->interests = "";
            $this->values->studies = "";

        }

        $this->body = '
      
            <div class="card">

                <div id="add_contact">

                    <h1>'.$this->numePagina.'</h1>

                    <form action="#">
                        <label for="nume_prenume">Nume complet</label><br>
                        <input id="nume_prenume" type="text" name="name" placeholder="Introduceti numele si prenumele" value="' .$this->values->name. '"><br>
                        <label for="adresa">Adresa</label><br>
                        <input id="adresa" type="text" name="adresa" placeholder="Strada. Bloc. Ap. Nr." value="' .$this->values->address. '"><br>
                        <label for="data_nastere">Data nastere</label><br>
                        <input id="data_nastere" type="date" name="data_nastere" value="' .$this->values->birthDate. '"><br>
                        <label for="email1">E-mail</label><br>
                        <input id="email1" type="email" name="email1" placeholder="Introduceti un E-mail" value="' .$this->values->email. '"><br>
                        <input id="email2" type="email" name="email2" placeholder="* Introduceti un alt E-mail" value="' .$this->values->email2. '"><br>
                        <label for="nr_telefon1">Numar de telefon</label><br>
                        <input id="nr_telefon1" type="text" name="nr_telefon1" placeholder="0712345678" value="' .$this->values->phone. '"><br>
                        <input id="nr_telefon2" type="text" name="nr_telefon2" placeholder="* 0712345678" value="' .$this->values->phone2. '"><br>
                        <label for="adresa_web1">Adresa web</label><br>
                        <input id="adresa_web1" type="text" name="adresa_web1" placeholder="https://web-adress.com" value="' .$this->values->webAddress. '"><br>
                        <input id="adresa_web2" type="text" name="adresa_web2" placeholder="* https://web-adress.com" value="' .$this->values->webAddress2. '"><br>
                        <label for="descriere">Descriere</label><br>
                        <textarea id="descriere" cols="54" rows="5" placeholder="Introduceti o descriere">' .$this->values->description. '</textarea><br>
                        <label for="interese">Interese</label><br>
                        <input id="interese" type="text" name="interese" placeholder="Introduceti interese" value="' .$this->values->interests. '"><br>
                        <label for="imagine">Poza de profil</label><br>
                        <input id="imagine" type="text" name="imagine" placeholder="Introduceti adresa linkului unei imagini de profil"  value="' .$this->values->pictureURL. '"><br>
                        <br>
                        <label for="studies">Studii</label><br>
                        <input id="studies" type="text" name="studies" placeholder=" Facultatea de .." value="' .$this->values->studies. '"><br>
                        <br>
                        <p>(*) - Optional</p>




                        <br><br>
                        <button type="submit" value="adauga_contact">Salveaza</button><br>

                    </form>
                </div>
            </div>
        </body>';
    }

    public function showBody() {
        echo $this->body;
    }
    
    public function getHeadTags() {
        return $this->headTags;
    }

    public function setValues($val) {
        $this->values=$val;
    }

    public function setNumePagina($mode){
        if($mode == "edit")
            $this->numePagina="Editeaza un contact";
        else
            $this->numePagina="Adauga un contact";

    }
    
}

?>