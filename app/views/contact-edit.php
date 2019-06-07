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

                    <form action="/public/contactedit/" method="post">
                        <label for="nume_prenume">Nume complet</label><br>
                        <input id="nume_prenume" type="text" name="nume" placeholder="Introduceti numele si prenumele" value="' .$this->values->name. '"><br>
                        <label for="adresa">Oras</label><br>
                        <select name="adresa" id="adresa">
                            <option value="'.$this->values->address.'">'.$this->values->address.  '</option>
                            <option value="Abrud">Abrud</option>
                            <option value="Adjud">Adjud</option>
                            <option value="Agnita">Agnita</option>
                            <option value="Aiud">Aiud</option>
                            <option value="Alba Iulia">Alba Iulia</option>
                            <option value="Aleșd">Aleșd</option>
                            <option value="Alexandria">Alexandria</option>
                            <option value="Amara">Amara</option>
                            <option value="Anina">Anina</option>
                            <option value="Aninoasa">Aninoasa</option>
                            <option value="Arad">Arad</option>
                            <option value="Ardud">Ardud</option>
                            <option value="Avrig">Avrig</option>
                            <option value="Azuga">Azuga</option>
                            <option value="Babadag">Babadag</option>
                            <option value="Băbeni">Băbeni</option>
                            <option value="Bacău">Bacău</option>
                            <option value="Baia de Aramă">Baia de Aramă</option>
                            <option value="Baia de Arieș">Baia de Arieș</option>
                            <option value="Baia Mare">Baia Mare</option>
                            <option value="Baia Sprie">Baia Sprie</option>
                            <option value="Băicoi">Băicoi</option>
                            <option value="Băile Govora">Băile Govora</option>
                            <option value="Băile Herculane">Băile Herculane</option>
                            <option value="Băile Olănești">Băile Olănești</option>
                            <option value="Băile Tușnad">Băile Tușnad</option>
                            <option value="Băilești">Băilești</option>
                            <option value="Bălan">Bălan</option>
                            <option value="Bălcești">Bălcești</option>
                            <option value="Balș">Balș</option>
                            <option value="Baraolt">Baraolt</option>
                            <option value="Bârlad">Bârlad</option>
                            <option value="Bechet">Bechet</option>
                            <option value="Beclean">Beclean</option>
                            <option value="Beiuș">Beiuș</option>
                            <option value="Berbești">Berbești</option>
                            <option value="Berești">Berești</option>
                            <option value="Bicaz">Bicaz</option>
                            <option value="Bistrița">Bistrița</option>
                            <option value="Blaj">Blaj</option>
                            <option value="Bocșa">Bocșa</option>
                            <option value="Boldești-Scăeni">Boldești-Scăeni</option>
                            <option value="Bolintin-Vale">Bolintin-Vale</option>
                            <option value="Borșa">Borșa</option>
                            <option value="Borsec">Borsec</option>
                            <option value="Botoșani">Botoșani</option>
                            <option value="Brad">Brad</option>
                            <option value="Bragadiru">Bragadiru</option>
                            <option value="Brăila">Brăila</option>
                            <option value="Brașov">Brașov</option>
                            <option value="Breaza">Breaza</option>
                            <option value="Brezoi">Brezoi</option>
                            <option value="Broșteni">Broșteni</option>
                            <option value="Bucecea">Bucecea</option>
                            <option value="București">București</option>
                            <option value="Budești">Budești</option>
                            <option value="Buftea">Buftea</option>
                            <option value="Buhuși">Buhuși</option>
                            <option value="Bumbești-Jiu">Bumbești-Jiu</option>
                            <option value="Bușteni">Bușteni</option>
                            <option value="Buzău">Buzău</option>
                            <option value="Buziaș">Buziaș</option>
                            <option value="Cajvana">Cajvana</option>
                            <option value="Calafat">Calafat</option>
                            <option value="Călan">Călan</option>
                            <option value="Călărași">Călărași</option>
                            <option value="Călimănești">Călimănești</option>
                            <option value="Câmpeni">Câmpeni</option>
                            <option value="Câmpia Turzii">Câmpia Turzii</option>
                            <option value="Câmpina">Câmpina</option>
                            <option value="Câmpulung Moldovenesc">Câmpulung Moldovenesc</option>
                            <option value="Câmpulung">Câmpulung</option>
                            <option value="Caracal">Caracal</option>
                            <option value="Caransebeș">Caransebeș</option>
                            <option value="Carei">Carei</option>
                            <option value="Cavnic">Cavnic</option>
                            <option value="Căzănești">Căzănești</option>
                            <option value="Cehu Silvaniei">Cehu Silvaniei</option>
                            <option value="Cernavodă">Cernavodă</option>
                            <option value="Chișineu-Criș">Chișineu-Criș</option>
                            <option value="Chitila">Chitila</option>
                            <option value="Ciacova">Ciacova</option>
                            <option value="Cisnădie">Cisnădie</option>
                            <option value="Cluj-Napoca">Cluj-Napoca</option>
                            <option value="Codlea">Codlea</option>
                            <option value="Comănești">Comănești</option>
                            <option value="Comarnic">Comarnic</option>
                            <option value="Constanța">Constanța</option>
                            <option value="Copșa Mică">Copșa Mică</option>
                            <option value="Corabia">Corabia</option>
                            <option value="Costești">Costești</option>
                            <option value="Covasna">Covasna</option>
                            <option value="Craiova">Craiova</option>
                            <option value="Cristuru Secuiesc">Cristuru Secuiesc</option>
                            <option value="Cugir">Cugir</option>
                            <option value="Curtea de Argeș">Curtea de Argeș</option>
                            <option value="Curtici">Curtici</option>
                            <option value="Dăbuleni">Dăbuleni</option>
                            <option value="Darabani">Darabani</option>
                            <option value="Dărmănești">Dărmănești</option>
                            <option value="Dej">Dej</option>
                            <option value="Deta">Deta</option>
                            <option value="Deva">Deva</option>
                            <option value="Dolhasca">Dolhasca</option>
                            <option value="Dorohoi">Dorohoi</option>
                            <option value="Drăgănești-Olt">Drăgănești-Olt</option>
                            <option value="Drăgășani">Drăgășani</option>
                            <option value="Dragomirești">Dragomirești</option>
                            <option value="Drobeta-Turnu Severin">Drobeta-Turnu Severin</option>
                            <option value="Dumbrăveni">Dumbrăveni</option>
                            <option value="Eforie">Eforie</option>
                            <option value="Făgăraș">Făgăraș</option>
                            <option value="Făget">Făget</option>
                            <option value="Fălticeni">Fălticeni</option>
                            <option value="Făurei">Făurei</option>
                            <option value="Fetești">Fetești</option>
                            <option value="Fieni">Fieni</option>
                            <option value="Fierbinți-Târg">Fierbinți-Târg</option>
                            <option value="Filiași">Filiași</option>
                            <option value="Flămânzi">Flămânzi</option>
                            <option value="Focșani">Focșani</option>
                            <option value="Frasin">Frasin</option>
                            <option value="Fundulea">Fundulea</option>
                            <option value="Găești">Găești</option>
                            <option value="Galați">Galați</option>
                            <option value="Gătaia">Gătaia</option>
                            <option value="Geoagiu">Geoagiu</option>
                            <option value="Gheorgheni">Gheorgheni</option>
                            <option value="Gherla">Gherla</option>
                            <option value="Ghimbav">Ghimbav</option>
                            <option value="Giurgiu">Giurgiu</option>
                            <option value="Gura Humorului">Gura Humorului</option>
                            <option value="Hârlău">Hârlău</option>
                            <option value="Hârșova">Hârșova</option>
                            <option value="Hațeg">Hațeg</option>
                            <option value="Horezu">Horezu</option>
                            <option value="Huedin">Huedin</option>
                            <option value="Hunedoara">Hunedoara</option>
                            <option value="Huși">Huși</option>
                            <option value="Ianca">Ianca</option>
                            <option value="Iași">Iași</option>
                            <option value="Iernut">Iernut</option>
                            <option value="Ineu">Ineu</option>
                            <option value="Însurăței">Însurăței</option>
                            <option value="Întorsura Buzăului">Întorsura Buzăului</option>
                            <option value="Isaccea">Isaccea</option>
                            <option value="Jibou">Jibou</option>
                            <option value="Jimbolia">Jimbolia</option>
                            <option value="Lehliu Gară">Lehliu Gară</option>
                            <option value="Lipova">Lipova</option>
                            <option value="Liteni">Liteni</option>
                            <option value="Livada">Livada</option>
                            <option value="Luduș">Luduș</option>
                            <option value="Lugoj">Lugoj</option>
                            <option value="Lupeni">Lupeni</option>
                            <option value="Măcin">Măcin</option>
                            <option value="Măgurele">Măgurele</option>
                            <option value="Mangalia">Mangalia</option>
                            <option value="Mărășești">Mărășești</option>
                            <option value="Marghita">Marghita</option>
                            <option value="Medgidia">Medgidia</option>
                            <option value="Mediaș">Mediaș</option>
                            <option value="Miercurea Ciuc">Miercurea Ciuc</option>
                            <option value="Miercurea Nirajului">Miercurea Nirajului</option>
                            <option value="Miercurea Sibiului">Miercurea Sibiului</option>
                            <option value="Mihăilești">Mihăilești</option>
                            <option value="Milișăuți">Milișăuți</option>
                            <option value="Mioveni">Mioveni</option>
                            <option value="Mizil">Mizil</option>
                            <option value="Moinești">Moinești</option>
                            <option value="Moldova Nouă">Moldova Nouă</option>
                            <option value="Moreni">Moreni</option>
                            <option value="Motru">Motru</option>
                            <option value="Murfatlar">Murfatlar</option>
                            <option value="Murgeni">Murgeni</option>
                            <option value="Nădlac">Nădlac</option>
                            <option value="Năsăud">Năsăud</option>
                            <option value="Năvodari">Năvodari</option>
                            <option value="Negrești">Negrești</option>
                            <option value="Negrești-Oaș">Negrești-Oaș</option>
                            <option value="Negru Vodă">Negru Vodă</option>
                            <option value="Nehoiu">Nehoiu</option>
                            <option value="Novaci">Novaci</option>
                            <option value="Nucet">Nucet</option>
                            <option value="Ocna Mureș">Ocna Mureș</option>
                            <option value="Ocna Sibiului">Ocna Sibiului</option>
                            <option value="Ocnele Mari">Ocnele Mari</option>
                            <option value="Odobești">Odobești</option>
                            <option value="Odorheiu Secuiesc">Odorheiu Secuiesc</option>
                            <option value="Oltenița">Oltenița</option>
                            <option value="Onești">Onești</option>
                            <option value="Oradea">Oradea</option>
                            <option value="Orăștie">Orăștie</option>
                            <option value="Oravița">Oravița</option>
                            <option value="Orșova">Orșova</option>
                            <option value="Oțelu Roșu">Oțelu Roșu</option>
                            <option value="Otopeni">Otopeni</option>
                            <option value="Ovidiu">Ovidiu</option>
                            <option value="Panciu">Panciu</option>
                            <option value="Pâncota">Pâncota</option>
                            <option value="Pantelimon">Pantelimon</option>
                            <option value="Pașcani">Pașcani</option>
                            <option value="Pătârlagele">Pătârlagele</option>
                            <option value="Pecica">Pecica</option>
                            <option value="Petrila">Petrila</option>
                            <option value="Petroșani">Petroșani</option>
                            <option value="Piatra Neamț">Piatra Neamț</option>
                            <option value="Piatra-Olt">Piatra-Olt</option>
                            <option value="Pitești">Pitești</option>
                            <option value="Ploiești">Ploiești</option>
                            <option value="Plopeni">Plopeni</option>
                            <option value="Podu Iloaiei">Podu Iloaiei</option>
                            <option value="Pogoanele">Pogoanele</option>
                            <option value="Popești-Leordeni">Popești-Leordeni</option>
                            <option value="Potcoava">Potcoava</option>
                            <option value="Predeal">Predeal</option>
                            <option value="Pucioasa">Pucioasa</option>
                            <option value="Răcari">Răcari</option>
                            <option value="Rădăuți">Rădăuți</option>
                            <option value="Râmnicu Sărat">Râmnicu Sărat</option>
                            <option value="Râmnicu Vâlcea">Râmnicu Vâlcea</option>
                            <option value="Râșnov">Râșnov</option>
                            <option value="Recaș">Recaș</option>
                            <option value="Reghin">Reghin</option>
                            <option value="Reșița">Reșița</option>
                            <option value="Roman">Roman</option>
                            <option value="Roșiorii de Vede">Roșiorii de Vede</option>
                            <option value="Rovinari">Rovinari</option>
                            <option value="Roznov">Roznov</option>
                            <option value="Rupea">Rupea</option>
                            <option value="Săcele">Săcele</option>
                            <option value="Săcueni">Săcueni</option>
                            <option value="Salcea">Salcea</option>
                            <option value="Săliște">Săliște</option>
                            <option value="Săliștea de Sus">Săliștea de Sus</option>
                            <option value="Salonta">Salonta</option>
                            <option value="Sângeorgiu de Pădure">Sângeorgiu de Pădure</option>
                            <option value="Sângeorz-Băi">Sângeorz-Băi</option>
                            <option value="Sânnicolau Mare">Sânnicolau Mare</option>
                            <option value="Sântana">Sântana</option>
                            <option value="Sărmașu">Sărmașu</option>
                            <option value="Satu Mare">Satu Mare</option>
                            <option value="Săveni">Săveni</option>
                            <option value="Scornicești">Scornicești</option>
                            <option value="Sebeș">Sebeș</option>
                            <option value="Sebiș">Sebiș</option>
                            <option value="Segarcea">Segarcea</option>
                            <option value="Seini">Seini</option>
                            <option value="Sfântu Gheorghe">Sfântu Gheorghe</option>
                            <option value="Sibiu">Sibiu</option>
                            <option value="Sighetu Marmației">Sighetu Marmației</option>
                            <option value="Sighișoara">Sighișoara</option>
                            <option value="Simeria">Simeria</option>
                            <option value="Șimleu Silvaniei">Șimleu Silvaniei</option>
                            <option value="Sinaia">Sinaia</option>
                            <option value="Siret">Siret</option>
                            <option value="Slănic">Slănic</option>
                            <option value="Slănic-Moldova">Slănic-Moldova</option>
                            <option value="Slatina">Slatina</option>
                            <option value="Slobozia">Slobozia</option>
                            <option value="Solca">Solca</option>
                            <option value="Șomcuta Mare">Șomcuta Mare</option>
                            <option value="Sovata">Sovata</option>
                            <option value="Ștefănești, Argeș">Ștefănești, Argeș</option>
                            <option value="Ștefănești, Botoșani">Ștefănești, Botoșani</option>
                            <option value="Ștei">Ștei</option>
                            <option value="Strehaia">Strehaia</option>
                            <option value="Suceava">Suceava</option>
                            <option value="Sulina">Sulina</option>
                            <option value="Tălmaciu">Tălmaciu</option>
                            <option value="Țăndărei">Țăndărei</option>
                            <option value="Târgoviște">Târgoviște</option>
                            <option value="Târgu Bujor">Târgu Bujor</option>
                            <option value="Târgu Cărbunești">Târgu Cărbunești</option>
                            <option value="Târgu Frumos">Târgu Frumos</option>
                            <option value="Târgu Jiu">Târgu Jiu</option>
                            <option value="Târgu Lăpuș">Târgu Lăpuș</option>
                            <option value="Târgu Mureș">Târgu Mureș</option>
                            <option value="Târgu Neamț">Târgu Neamț</option>
                            <option value="Târgu Ocna">Târgu Ocna</option>
                            <option value="Târgu Secuiesc">Târgu Secuiesc</option>
                            <option value="Târnăveni">Târnăveni</option>
                            <option value="Tășnad">Tășnad</option>
                            <option value="Tăuții-Măgherăuș">Tăuții-Măgherăuș</option>
                            <option value="Techirghiol">Techirghiol</option>
                            <option value="Tecuci">Tecuci</option>
                            <option value="Teiuș">Teiuș</option>
                            <option value="Țicleni">Țicleni</option>
                            <option value="Timișoara">Timișoara</option>
                            <option value="Tismana">Tismana</option>
                            <option value="Titu">Titu</option>
                            <option value="Toplița">Toplița</option>
                            <option value="Topoloveni">Topoloveni</option>
                            <option value="Tulcea">Tulcea</option>
                            <option value="Turceni">Turceni</option>
                            <option value="Turda">Turda</option>
                            <option value="Turnu Măgurele">Turnu Măgurele</option>
                            <option value="Ulmeni">Ulmeni</option>
                            <option value="Ungheni">Ungheni</option>
                            <option value="Uricani">Uricani</option>
                            <option value="Urlați">Urlați</option>
                            <option value="Urziceni">Urziceni</option>
                            <option value="Valea lui Mihai">Valea lui Mihai</option>
                            <option value="Vălenii de Munte">Vălenii de Munte</option>
                            <option value="Vânju Mare">Vânju Mare</option>
                            <option value="Vașcău">Vașcău</option>
                            <option value="Vaslui">Vaslui</option>
                            <option value="Vatra Dornei">Vatra Dornei</option>
                            <option value="Vicovu de Sus">Vicovu de Sus</option>
                            <option value="Victoria">Victoria</option>
                            <option value="Videle">Videle</option>
                            <option value="Vișeu de Sus">Vișeu de Sus</option>
                            <option value="Vlăhița">Vlăhița</option>
                            <option value="Voluntari">Voluntari</option>
                            <option value="Vulcan">Vulcan</option>
                            <option value="Zalău">Zalău</option>
                            <option value="Zărnești">Zărnești</option>
                            <option value="Zimnicea">Zimnicea</option>
                            <option value="Zlatna">Zlatna</option>
                            
                           
                        </select>
                        <br>
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
                        <textarea id="descriere" cols="54" rows="5" placeholder="Introduceti o descriere" name="descriere">' .$this->values->description. '</textarea><br>
                        <label for="interese">Interese</label><br>
                        <input id="interese" type="text" name="interese" placeholder="Introduceti interese" value="' .$this->values->interests. '"><br>
                        <label for="imagine">Poza de profil</label><br>
                        <input id="imagine" type="text" name="imagine" placeholder="Introduceti adresa linkului unei imagini de profil"  value="' .$this->values->pictureURL. '"><br>
                        <br>
                        <label for="studies">Studii</label><br>
                        <input id="studies" type="text" name="studii" placeholder=" Facultatea de .." value="' .$this->values->studies. '"><br>
                        <br>
                        <p>(*) - Optional</p>




                        <br><br>
                        <input type="submit" name="'.explode(' ',$this->numePagina)[0].'" value="Salveaza"><br>

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