<?php
include 'inc/header.php';
// header tags toevoegen
echo '<header class="head">';
echo '<p>Nieuwe order...</p>';
echo '</header>'; //afsluiten header

// voor gridopmaak alvast de main-content
echo '<main class="main-content">';
// FORM EDIT order...
echo '<div id="frmDetail">';
?>
<div>
    <form action ="dataverwerken.php" method="POST" class="frmDetail">
        <input type="hidden" name="action" value="InsertOpdracht">
        <label for="fklantid">Klant...</label>
        <input type="number" name="klantid" id="fklantid" placeholder="Klant id...">
        <label for="fcolli">Colli...</label>
        <input type="number" name="colli" id="fcolli" placeholder="Colli...">
        <label for="fgewicht">Gewicht...</label>
        <input type="number" name="gewicht" id="fgewicht" placeholder="Gewicht...">
        <label for="fadres">Adres...</label>
        <input type="text" name="adres" id="fadres" placeholder="Adres...">
        <label for="fpostcode">Postcode...</label>
        <input type="text" name="postcode" id="fpostcode" placeholder="Postcode...">
        <label for="fplaats">Plaats...</label>
        <input type="text" name="plaats" id="fplaats" placeholder="Plaats...">
        <label for="fdateplanning">Planning datum...</label>
        <input type="text" name="datumplanning" id="fdateplanning" placeholder="Planning datum...">
        <label for="fdatetransport">Transport datum...</label>
        <input type="text" name="datumtransport" id="fdatetransport" placeholder="Transport datum...">
        <label for="fbonbin">Bonbin...</label>
        <input type="text" name="bonbin" id="fbonbin" placeholder="Bonbin...">
        <label for="fmdw">Medewerker...</label>
        <input type="text" name="mdw" id="fmdw" placeholder="Medewerker...">
        <label for="fbedrag">Bedrag...</label>
        <input type="number" name="bedrag" id="fbedrag" placeholder="Bedrag...">
        <label for="fnotitie">Notitie:</label>
        <input type="text" name="notitie" value="" id="fnotitie" placeholder="Notitie...">
        <div class="submitbtn">
            <input type="submit" name="submit" value="bewaren..." class="btnDetailSubmit">
        </div>
    </form>
</div>


<?php
echo '</div>';
echo '</main>';
include ("inc/footer.php");
?>
