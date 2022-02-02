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
?>


    FORMULIER

<?php
echo '</div>'; //frmDetail afsluiten
echo '</main>'; //main afsluiten 
include ("inc/footer.php") ;
?>