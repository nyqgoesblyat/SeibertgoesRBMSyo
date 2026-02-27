<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM buchungen");
?>

<h2>Wochenübersicht</h2>
<a href="buchen.php">Neue Buchung</a> |
<a href="logout.php">Logout</a>

<table border="1">
<tr>
<th>Raum</th>
<th>Datum</th>
<th>Block</th>
<th>Kurs</th>
<th>Status</th>
<?php if($_SESSION['rolle']=='admin') echo "<th>Aktion</th>"; ?>
</tr>

<?php
while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row['raum_id']."</td>";
    echo "<td>".$row['datum']."</td>";
    echo "<td>".$row['start_block']." (".$row['block_anzahl']." Blöcke)</td>";
    echo "<td>".$row['kursname']."</td>";
    echo "<td>".$row['status']."</td>";
    if($_SESSION['rolle']=='admin'){
        echo "<td>
        <a href='status.php?id=".$row['id']."&s=bestätigt'>Bestätigen</a> |
        <a href='status.php?id=".$row['id']."&s=abgelehnt'>Ablehnen</a>
        </td>";
    }
    echo "</tr>";
}
?>
</table>
