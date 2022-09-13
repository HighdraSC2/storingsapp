<?php
session_start();
//Variabelen vullen
$action = $_POST['action'];

    if ($action == "create"){
        $attractie = $_POST['attractie'];
        if(empty($attractie))
            {
                $errors[] = "Vul de attractie-naam in.";
            }
        $type = $_POST['type'];
        if(empty($type))
            {
                $errors[] = "Vul een juiste type in";
            }
        $capaciteit = $_POST['capaciteit'];
        if(!is_numeric($capaciteit))
            {
                $errors[] = "Vul de attractie-naam in.";
            }
        $prioriteit = $_POST['prioriteit'];
        if(empty($prioriteit))
            {
                $errors[] = "Vul de juiste prioriteit in.";
            }
        $melder = $_POST['melder'];

    
        if(isset($errors))
            {
                var_dump($errors);
                die();
            }
        //1. Verbinding
        require_once 'conn.php';

        //2. Query
        $query="INSERT INTO meldingen (attractie,`type`,prioriteit,melder,capaciteit)VALUES(:attractie,:type,:prioriteit,:melder,:capaciteit)";

        //3. Prepare
        $statement=$conn->prepare($query);

        //4. Execute
        $statement->execute([
            ":attractie"=>$attractie,
            ":type"=>$type,
            ":melder"=>$melder,
            ":prioriteit"=>$prioriteit,
            ":capaciteit"=>$capaciteit
        ]);

        header("Location:../meldingen/index.php?msg=Melding is opgeslagen");
    }

    if  ($action == "update"){
        $melder = $_POST['melder'];
        $id = $_POST['id'];
        $prioriteit = isset($_POST['prioriteit']);
        $capaciteit = $_POST['capaciteit'];
        $overig = $_POST['overig'];

        require_once 'conn.php';

        $query='UPDATE meldingen SET melder = :melder, capaciteit = :capaciteit, prioriteit = :prioriteit, overige_info = :overig WHERE id= :id';

        $statement=$conn->prepare($query);

        $statement->execute([
            ":melder" => $melder,
            ":id" => $id,
            ":prioriteit" =>  $prioriteit,
            ":capaciteit" => $capaciteit,
            ":overig" => $overig,
        ]);

        header("location:../meldingen/index.php?msg=Update is complete");
    }

    
    if ($action == "delete"){


        $id = $_POST['id'];

        require_once 'conn.php';

        $query='DELETE FROM meldingen WHERE id = :id';

        $statement=$conn->prepare($query);

        $statement->execute([
        ":id" => $_POST['id']
        ]);




        header("location:../meldingen/index.php?msg=Deleting is complete");
    }