<?php

class ContactEditView extends View {
    protected $headTags = [];
    protected $body = '';

    public function __construct() {

        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">');
        array_push($this->headTags, '<link href="styles//reseter.css" rel="stylesheet">');
        array_push($this->headTags, '<link href="/styles/add_contact.css" rel="stylesheet">');
    }

    public function constructBody() {
        $this->body = '
      
            <div class="card">

                <div id="add_contact">

                    <h1>Adauga un contact</h1>

                    <form action="#">
                        <label for="nume_prenume">Nume complet</label><br>
                        <input id="nume_prenume" type="text" name="name" placeholder="Introduceti numele si prenumele"><br>
                        <label for="adresa">Adresa</label><br>
                        <input id="adresa" type="text" name="adresa" placeholder="Strada. Bloc. Ap. Nr."><br>
                        <label for="data_nastere">Data nastere</label><br>
                        <input id="data_nastere" type="date" name="data_nastere"><br>
                        <label for="email1">E-mail</label><br>
                        <input id="email1" type="email" name="email1" placeholder="Introduceti un E-mail"><br>
                        <input id="email2" type="email" name="email2" placeholder="* Introduceti un alt E-mail"><br>
                        <label for="nr_telefon1">Numar de telefon</label><br>
                        <input id="nr_telefon1" type="text" name="nr_telefon1" placeholder="0712345678"><br>
                        <input id="nr_telefon2" type="text" name="nr_telefon2" placeholder="* 0712345678"><br>
                        <label for="adresa_web1">Adresa web</label><br>
                        <input id="adresa_web1" type="text" name="adresa_web1" placeholder="https://web-adress.com"><br>
                        <input id="adresa_web2" type="text" name="adresa_web2" placeholder="* https://web-adress.com"><br>
                        <label for="descriere">Descriere</label><br>
                        <textarea id="descriere" cols="54" rows="5" placeholder="Introduceti o descriere"></textarea><br>
                        <label for="interese">Interese</label><br>
                        <input id="interese" type="text" name="interese" placeholder="Introduceti interese"><br>
                        <label for="imagine">Poza de profil</label><br>
                        <input id="imagine" type="text" name="imagine" placeholder="Introduceti adresa linkului unei imagini de profil"><br>
                        <br>
                        <p>(*) - Optional</p>




                        <br><br>
                        <button type="submit" value="adauga_contact">Adauga contact</button><br>

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


}

?>