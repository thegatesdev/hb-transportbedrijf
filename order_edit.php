<?php
include 'inc/header.php';
// header tags toevoegen
echo '<header class="head">';
// hier komt straks een url om een nieuwe klant aan te maken…

echo '</header>'; //afsluiten header
// voor gridopmaak alvast de main-content
echo '<main class="main-content">';
// FORM EDIT opdracht...
echo '<div id="frmDetail">';
if (isset($_GET["id"])) {
    $opdrId=$_GET["id"];
}
else {
    echo 'Opdracht niet gevonden...';
    header('refresh: 2; url=orders.php');
}
$qryOpdr = "SELECT datumopdr, klant_id, colli, kg, straat, huisnummer, plaats, datumplanning, datumtransport, notitie, postcode, bonbin, mdw, bedrag
        FROM Opdracht
        WHERE id={$opdrId}";
//result...
$result = mysqli_query($dbconn, $qryOpdr);
if(mysqli_num_rows($result)!=1) {
    echo 'Er zijn meerdere orders geselecteerd. Dit gaat niet goed!';
    header('refresh: 2; url=orders.php');
}
//1 record...
$opdr=mysqli_fetch_assoc($result);
?>
<div>
    <form action ="dataverwerken.php" method="POST" class="frmDetail">
        <input type="hidden" name="action" value="UpdateOpdracht">
        <label for="fklantnr">OpdrachtNr.:</label>
        <input type="text" name="opdrnr" value="<?php echo $opdrId;?>" id="fopdrnr">
        <label for="fklantid">Klant...</label>
        <input type="number" name="klant_id" id="fklantid" placeholder="Klant id..." value="<?php echo $opdr["klant_id"];?>">
        <label for="fcolli">Colli...</label>
        <input type="number" name="colli" id="fcolli" placeholder="Colli..."  value="<?php echo $opdr["colli"];?>">
        <label for="fgewicht">Gewicht...</label>
        <input type="number" name="kg" id="fgewicht" placeholder="Gewicht..." value="<?php echo $opdr["kg"];?>">
        <label for="fadres">Adres...</label>
        <input type="text" name="straat" id="fadres" placeholder="Straat..." value="<?php echo $opdr["straat"];?>">
        <label for="fpostcode">Postcode...</label>
        <input type="text" name="postcode" id="fpostcode" placeholder="Postcode..." value="<?php echo $opdr["postcode"];?>">
        <label for="fplaats">Plaats...</label>
        <input type="text" name="plaats" id="fplaats" placeholder="Plaats..." value="<?php echo $opdr["plaats"];?>">
        <label for="fdateplanning">Planning datum...</label>
        <input type="text" name="datumplanning" id="fdateplanning" placeholder="Planning datum..." value="<?php echo $opdr["datumplanning"];?>">
        <label for="fdatetransport">Transport datum...</label>
        <input type="text" name="datumtransport" id="fdatetransport" placeholder="Transport datum..." value="<?php echo $opdr["datumtransport"];?>">
        <label for="fbonbin">Bonbin...</label>
        <input type="text" name="bonbin" id="fbonbin" placeholder="Bonbin..." value="<?php echo $opdr["bonbin"];?>">
        <label for="fmdw">Medewerker...</label>
        <input type="text" name="mdw" id="fmdw" placeholder="Medewerker..." value="<?php echo $opdr["mdw"];?>">
        <label for="fbedrag">Bedrag...</label>
        <input type="number" name="bedrag" id="fbedrag" placeholder="Bedrag..." value="<?php echo $opdr["bedrag"];?>">
        <label for="fnotitie">Notitie:</label>
        <input type="text" name="notitie" value="" id="fnotitie" placeholder="Notitie..." value="<?php echo $opdr["notitie"];?>">
        <div class="submitbtn">
            <input type="submit" name="submit" value="bewaren..." class="btnDetailSubmit">
        </div>
    </form>
</div>
<?php
echo '</div>'; //frmDetail
echo '</main>'; //main-content
include ("inc/footer.php");
?>
