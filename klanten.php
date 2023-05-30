<?php
// include header.php
$header_title = "Klanten";
include 'inc/header.php';
// header tags toevoegen
echo '<header class="head">';
// hier komt straks een url om een nieuwe klant aan te maken…
echo "<a href='klant_new.php' class='btn-new'><i class='material-icons md-24'>add</i></a>";
echo '</header>'; //afsluiten header
// voor gridopmaak alvast de main-content
echo '<main class="main-content">';
?>
<!-- tabelkop met klantgegevens als HTML-->
<table id="maintable">
    <tr>
        <th>klantnr</th>
        <th>klantnaam</th>
        <th>contactpersoon</th>
        <th>straat</th>
        <th>huisnummer</th>
        <th>postcode</th>
        <th>plaats</th>
        <th>telefoon</th>
        <th>actie</th>
    </tr>
<?php
//bepaling 'page' voor paginering
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}
else {
    $page=1;
}
//start vanaf
$start_from = ($page-1) * RECORDS_PER_PAGE;
//aantal pagina's bepalen t.b.v. paginering
$sql_count = "SELECT count(id) as aantal FROM Klant;";
$res_count = mysqli_query($dbconn, $sql_count);
$row = mysqli_fetch_assoc($res_count);
$total_rows = $row['aantal'];
$total_pages = ceil($total_rows / RECORDS_PER_PAGE);

// ophalen klantgegevens uit database
$query="SELECT id, naam, cp, straat, huisnummer, postcode, plaats, telefoon, notitie
        FROM Klant
        ORDER BY naam, plaats
        LIMIT " .$start_from.",". RECORDS_PER_PAGE.";";
//$resultaat bepalen....
$result=mysqli_query($dbconn, $query);
//aantal records bepalen....
$aantal=mysqli_num_rows($result);
$contentTable="";
// tabel aanvullen met klantgegevens
if ($aantal>0){ //controle of er wel wat opgehaald wordt...
    while ($row=mysqli_fetch_array($result)) {
        $contentTable.="<tr>
                            <td>".$row['id']."</td>                       
                            <td>".$row['naam']."</td>                       
                            <td>".$row['cp']."</td>                       
                            <td>".$row['straat']."</td>                       
                            <td>".$row['huisnummer']."</td>                       
                            <td>".$row['postcode']."</td>                      
                            <td>".$row['plaats']."</td>                      
                            <td>".$row['telefoon']."</td>
                            <!--<td>".$row['notitie']."</td>-->
                            <td>
                                <a href='klant_edit.php?id={$row['id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
                                <a href='klant_delete.php?id={$row['id']}' class='btn-delete'><i class='material-icons md-24'>delete</i></a>
                                <a href='orders.php?klant={$row['id']}' class='btn-local_shipping'><i class='material-icons md-24'>orders</i></a>
                            </td>
                        </tr>";
    }
}
else {
    $contentTable='<tr>
                        <td colspan="9">Geen gegevens om op te halen...</td>
                    </tr>';
}
// weergave van de rest van de tabel;
$contentTable.='</table><br>';
echo $contentTable;
// paginering van de tabel
$page_url="klanten.php";
include_once 'inc/paginering.php';


// include footer
echo '</div>'; //frmDetail afsluiten
echo '</main>'; //main afsluiten
include ("inc/footer.php") ;
?>