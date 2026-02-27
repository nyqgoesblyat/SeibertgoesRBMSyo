<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $raum = $_POST['raum'];
    $datum = $_POST['datum'];
    $start = $_POST['start_block'];
    $anzahl = $_POST['block_anzahl'];
    $kurs = $_POST['kursname'];

    $check = $conn->query("SELECT * FROM buchungen 
        WHERE raum_id=$raum 
        AND datum='$datum'
        AND ($start BETWEEN start_block AND start_block+block_anzahl-1)");

    if ($check->num_rows > 0) {
        echo "Konflikt vorhanden!";
    } else {
        $conn->query("INSERT INTO buchungen 
            (raum_id, benutzer_id, datum, start_block, block_anzahl, kursname)
            VALUES ($raum, ".$_SESSION['user_id'].", '$datum', $start, $anzahl, '$kurs')");
        header("Location: dashboard.php");
    }
}
?>

<form method="post">
Raum:
<select name="raum">
<?php
$raeume = $conn->query("SELECT * FROM raeume WHERE aktiv=1");
while($r = $raeume->fetch_assoc()){
    echo "<option value='".$r['id']."'>".$r['raumname']."</option>";
}
?>
</select><br>

Datum: <input type="date" name="datum"><br>
Startblock (1–12): <input type="number" name="start_block" min="1" max="12"><br>
Anzahl Blöcke (1–12): <input type="number" name="block_anzahl" min="1" max="12"><br>
Kursname: <input type="text" name="kursname"><br>

<button type="submit">Buchen</button>
</form>
