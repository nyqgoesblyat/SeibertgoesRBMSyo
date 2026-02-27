<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['benutzername'];
    $pass = $_POST['passwort'];

    $sql = "SELECT * FROM benutzer WHERE benutzername='$user' AND passwort='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['rolle'] = $row['rolle'];
        header("Location: dashboard.php");
    } else {
        echo "Login fehlgeschlagen";
    }
}
?>

<form method="post">
    Benutzername: <input type="text" name="benutzername"><br>
    Passwort: <input type="password" name="passwort"><br>
    <button type="submit">Login</button>
</form>
