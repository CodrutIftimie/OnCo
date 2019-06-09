<?php

class AuthenticationView extends View {
    protected $headTags = [];
    protected $body = '';
    protected $values = null;
    protected $numePagina = null;

    public function __construct() {

        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">');
        array_push($this->headTags, '<link href="styles//reseter.css" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/login_register.css" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/navigation.css" rel="stylesheet">');
        array_push($this->headTags, '<script src="/../../public/javascript/authentication.js"></script>');
    }

  
    
   

    

    public function constructBody() {


    $this->body = '
            <div class="card">

            <div class="register" id="js1" style="display: none">
                <h1>Register</h1>
                <form action="/public/authentication/" method="post">
                    <label for="nume">Nume complet</label><br>
                    <input id="nume" type="text" name="nume" placeholder="Introduceti numele"><br>
                    <label for="email">E-mail</label><br>
                    <input id="email" type="email" name="email" placeholder="Introduceti un E-mail"><br>
                    <label for="parola">Parola</label><br>
                    <input id="parola" type="password" name="parola" placeholder="Introduceti o parola"><br>



                    <br><br>
                    <button name="submit" type="submit" value="Submit_register">Register</button><br>
                    <button type="button" onclick="login()">Am deja un cont !</button>
                </form>
            </div>
            <div class="login " id="js2" style="display: block">
                <h1>Login</h1>
                <form action="/public/authentication/" method="post">
                    <label for="utilizator_login">Email</label><br>
                    <input id="utilizator_login" type="text" name="utilizator" placeholder="Introduceti numele contului"><br>
                    <label for="parola_login">Parola</label><br>
                    <input id="parola_login" type="password" name="parola" placeholder="Introduceti parola"><br>

                    <br><br>
                    <button name="submit" type="submit" value="Submit_login">Login</button>
                    <br>
                    <button type="button" onclick="login()">Vreau imi fac cont! !</button>
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

  
    
}

?>