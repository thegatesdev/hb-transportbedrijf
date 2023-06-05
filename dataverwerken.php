<?php
include 'inc/header.php';
// header tags toevoegen
echo '<header class="head">';
    echo '<p>eventueel extra info</p>';
    echo '</header>'; //afsluiten header

// voor gridopmaak alvast de main-content
echo '<main class="main-content">';
// Begin FORM
echo '<div id="frmDetail">';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = isset($_POST["action"]) ? $_POST["action"] : 'LEEG';
    switch ($action) {
        case "UpdateKlant":
            updateKlant();
            break;
        case "InsertKlant":
            insertKlant();
            break;
        case "InsertOpdracht":
            insertOpdracht();
            break;
        case "UpdateOpdracht":
            UpdateOpdracht();
            break;
        case "LEEG":
        default:
            echo "geen geldige actie...";
    }
}
else {
    header('url=index.php');
}
    function updateKlant() {
        global $dbconn;
        $id=isset($_POST['klantnr']) ? $_POST['klantnr'] : 0;
        $klantnaam=isset($_POST['klantnaam']) ? addslashes($_POST['klantnaam']) : "";
        $contactpersoon=isset($_POST['contactpersoon']) ? addslashes($_POST['contactpersoon']) : "";
        $straat=isset($_POST['straat']) ? addslashes($_POST['straat']) : "";
        $huisnummer=isset($_POST['huisnummer']) ? $_POST['huisnummer'] : "";
        $postcode=isset($_POST['postcode']) ? $_POST['postcode'] : "";
        $plaats=isset($_POST['plaats']) ? addslashes($_POST['plaats']) : "";
        $telefoon=isset($_POST['telefoon']) ? $_POST['telefoon'] : "";
        $notitie=isset($_POST['notitie']) ? addslashes($_POST['notitie']) : "";
        $qryUpdateKlant="update Klant
                set naam='{$klantnaam}', cp='{$contactpersoon}', straat='{$straat}', huisnummer={$huisnummer}, postcode='{$postcode}', 
                    plaats='{$plaats}', telefoon='{$telefoon}', notitie='{$notitie}'
                    where id={$id}";

        if (mysqli_query($dbconn, $qryUpdateKlant)) {
            echo "<p>Klant {$klantnaam} ({$id}) is aangepast</p><br>";
            header('refresh: 1; url=klanten.php');
            exit();
        }
        else {
            echo "<p>Klant {$klantnaam} ({$id}) is NIET aangepast</p><br>";
            header('refresh: 10; url=klanten.php');
            exit();
        }

    }
    function insertKlant() {
        global $dbconn;
        $klantnaam=isset($_POST['klantnaam']) ? addslashes($_POST['klantnaam']) : "";
        $contactpersoon=isset($_POST['contactpersoon']) ? addslashes($_POST['contactpersoon']) : "";
        $straat=isset($_POST['straat']) ? addslashes($_POST['straat']) : "";
        $huisnummer=isset($_POST['huisnummer']) ? $_POST['huisnummer'] : "";
        $postcode=isset($_POST['postcode']) ? $_POST['postcode'] : "";
        $plaats=isset($_POST['plaats']) ? addslashes($_POST['plaats']) : "";
        $telefoon=isset($_POST['telefoon']) ? $_POST['telefoon'] : "";
        $notitie=isset($_POST['notitie']) ? addslashes($_POST['notitie']) : "";
        $qryInsertKlant= "insert into Klant
                        (naam, cp, straat, huisnummer, postcode, plaats, telefoon, notitie)
                        values('{$klantnaam}', '{$contactpersoon}', '{$straat}', {$huisnummer}, '{$postcode}',
                               '{$plaats}', '{$telefoon}', '{$notitie}')";

        if (mysqli_query($dbconn, $qryInsertKlant)) {
            echo "<p>Klant {$klantnaam} is toegevoegd</p><br>";
            header('refresh: 1; url=klanten.php');
            exit();
        }
        else {
            echo "<p>Klant {$klantnaam} is NIET toegevoegd...</p><br>";
            header('refresh: 10; url=klanten.php');
            exit();
        }

    }

    function InsertOpdracht(){
        global $dbconn;
        $date = date("Y-m-d");
        $klantid = getPostOr('klantid');
        $colli = getPostOr('colli');
        $gewicht = getPostOr('gewicht');
        $adres = getPostOr('adres');
        $postcode = getPostOr('postcode');
        $plaats = getPostOr('plaats');
        $datumplanning = getPostOr('datumplanning');
        $datumtransport = getPostOr('datumtransport');
        $bonbin = getPostOr('bonbin');
        $mdw = getPostOr('mdw');
        $bedrag = getPostOr('bedrag');
        $notitie = getPostOr('notitie');

        $queryInsertOpdracht = "INSERT INTO opdracht
        (datumopdr, klant_id, colli, kg, straat, huisnummer, plaats, datumplanning, datumtransport, notitie, postcode, bonbin, mdw, bedrag)
        values('{$date}', '{$klantid}', '{$colli}', '{$gewicht}', '{$adres}', 0,'{$plaats}','{$datumplanning}', '{$datumtransport}', '{$notitie}', '{$postcode}', '{$bonbin}', '{$mdw}', '{$bedrag}');";
        if (mysqli_query($dbconn, $queryInsertOpdracht)){
            echo "<p>Opdracht is toegevoegd</p><br>";
            header('refresh: 1; url=opdrachten.php');
            exit();
        }
        else {
            echo "<p>Opdracht is NIET toegevoegd...</p><br>";
            header('refresh: 10; url=klanten.php');
            exit();
        }
    }

    function UpdateOpdracht(){
        global $dbconn;
        $date = date("Y-m-d");
        $opdrnr = getPostOr('opdrnr');
        $klantid = getPostOr('klant_id');
        $colli = getPostOr('colli');
        $kg = getPostOr('kg');
        $straat = getPostOr('straat');
        $postcode = getPostOr('postcode');
        $plaats = getPostOr('plaats');
        $datumplanning = getPostOr('datumplanning');
        $datumtransport = getPostOr('datumtransport');
        $bonbin = getPostOr('bonbin');
        $mdw = getPostOr('mdw');
        $bedrag = getPostOr('bedrag');
        $notitie = getPostOr('notitie');

        $qryUpdateOpdr = "UPDATE opdracht SET
        klant_id='$klantid', colli='$colli', kg='$kg', straat='$straat', postcode='$postcode',
        plaats='$plaats', datumplanning='$datumplanning', datumtransport='$datumtransport',
        bonbin='$bonbin', mdw='$mdw', bedrag='$bedrag', notitie='$notitie'
        WHERE id=$opdrnr";

        echo $qryUpdateOpdr;

        if (mysqli_query($dbconn, $qryUpdateOpdr)) {
            echo "<p>Opdracht $opdrnr is aangepast</p><br>";
            header('refresh: 1; url=orders.php');
            exit();
        }
        else {
            echo "<p>Opdracht $opdrnr is NIET aangepast</p><br>";
            header('refresh: 10; url=orders.php');
            exit();
        }
    }

    function getPostOr($id, $or = ''){
        return addslashes($_POST[$id] ?? $or);
    }
?>


    FORMULIER

<?php
echo '</div>'; //frmDetail afsluiten
echo '</main>'; //main afsluiten 
include ("inc/footer.php") ;
?>