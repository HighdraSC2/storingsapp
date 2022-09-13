<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    $msg="Je moet eerst inloggen!";
    header("Location:../login.php?msg=$msg");
    exit;
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>
    
    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <?php 
        
        require_once '../backend/conn.php';
        $query ="SELECT * FROM meldingen";
        $statement = $conn->prepare($query);
        $statement->execute();
        $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        ?>
        <table>
            <tr>
                <th>Attractie</th>
                <th>Type</th>
                <th>Capaciteit</th>
                <th>Prioriteit</th>
                <th>Melder</th>
                <th>Overige_info</th>
                <th>Aanpassen</th>

            </tr>
            <?php foreach($meldingen as $melding):?>
                <tr>
                    <td><?php    echo $melding['attractie'] . "</h1>"; ?></td>
                    <td><?php    echo $melding['type'] . "</h1>"; ?></td>
                    <td><?php    echo $melding['capaciteit'] . "</h1>"; ?></td>
                    <td><?php    echo ($melding['prioriteit'] == 1 ? "Ja" : "Nee") . "</h1>";?></td>
                    <td><?php    echo $melding['melder'] . "</h1>"; ?></td>
                    <td><?php    echo $melding['overige_info'] . "</h1>"; ?></td>
                    <td><?php    echo "<a href='edit.php?id={$melding['id']}'>Aanpassen</a>";?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>  

</body>

</html>
