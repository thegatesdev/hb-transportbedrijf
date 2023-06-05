<?php
// include header.php
$header_title = "Orders";
include 'inc/header.php';
// header tags toevoegen
echo '<header class="head">';
// hier komt straks een url om een nieuwe klant aan te maken…
echo "<a href='order_new.php' class='btn-new'><i class='material-icons md-24'>add</i></a>";
echo '</header>'; //afsluiten header
// voor gridopmaak alvast de main-content
echo '<main class="main-content">';
?>
<!-- tabelkop met klantgegevens als HTML-->
<table id="maintable">
    <tr>
        <th>datumopdr</th>
        <th>klant id</th>
        <th>colli</th>
        <th>gewicht (kg)</th>
        <th>adres</th>
        <th>postcode</th>
        <th>plaats</th>
        <th>datum planning</th>
        <th>datum transport</th>
        <th>bonbin</th>
        <th>mdw</th>
        <th>bedrag</th>
        <th>notitie</th>
        <th>actie</th>
    </tr>
<?php
//bepaling 'page' voor paginering
$page = $_GET["page"] ?? 1; 

//start vanaf
$start_from = ($page-1) * RECORDS_PER_PAGE;

//bepalen orders per klant
if (isset($_GET['klant'])){
    $_SESSION['klant_opdrachten'] = $klant_id = $_GET['klant'];
} else $klant_id = $_SESSION['klant_opdrachten'] ?? null;
$klant_sql_where = isset($klant_id) ? "klant_id=$klant_id AND" : "";

//bepalen eerdere orders
if (isset($_GET['past'])){
    $_SESSION['past_orders'] = $past_orders = $_GET['past'] == 1;
} else $past_orders = $_SESSION['past_orders'] ?? false;
$date_sql_where = $past_orders ? "datumopdr < CURDATE()" : "datumopdr >= CURDATE()";

//aantal pagina's bepalen t.b.v. paginering
$total_rows = mysqli_num_rows(mysqli_query($dbconn, "SELECT 1 FROM opdracht WHERE $klant_sql_where $date_sql_where"));
$total_pages = ceil($total_rows / RECORDS_PER_PAGE);

// ophalen klantgegevens uit database
$query="SELECT id, datumopdr, klant_id, colli, kg, 
        CONCAT(straat,' ', huisnummer, COALESCE(toevoeging, '')) as adres,
        postcode, plaats, datumplanning, datumtransport, bonbin, mdw, bedrag, notitie
        FROM opdracht
        WHERE
        $klant_sql_where
        $date_sql_where
        ORDER BY datumopdr DESC, postcode
        LIMIT " .$start_from.",". RECORDS_PER_PAGE.";";

//$resultaat bepalen....
$result=mysqli_query($dbconn, $query);
$contentTable="";

// tabel aanvullen met klantgegevens
if ($total_rows>0){ //controle of er wel wat opgehaald wordt...
    while ($row=mysqli_fetch_array($result)) {
        $contentTable.="<tr>
                            <td>".$row['datumopdr']."</td>                       
                            <td>".$row['klant_id']."</td>                       
                            <td>".$row['colli']."</td>                       
                            <td>".$row['kg']."</td>                       
                            <td>".$row['adres']."</td>                       
                            <td>".$row['postcode']."</td>                      
                            <td>".$row['plaats']."</td>
                            <td>".$row['datumplanning']."</td>
                            <td>".$row['datumtransport']."</td>
                            <td>".$row['bonbin']."</td>
                            <td>".$row['mdw']."</td>
                            <td>".$row['bedrag']."</td>
                            <td>".$row['notitie']."</td>
                            <td>
                                <a href='order_edit.php?id={$row['id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
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
$page_url="orders.php";
include_once 'inc/paginering.php';


// include footer
echo '</div>'; //frmDetail afsluiten
echo '</main>'; //main afsluiten
include ("inc/footer.php") ;
?>