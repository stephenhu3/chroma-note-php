<?php
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        // case 'getNote':
        //     getNote();
        //     break;
        case 'testSaveNote':
            $noteContent = $_POST["noteContent"];
            $userDate = $_POST["userDate"];
            echo $noteContent;
            saveNote(1, $noteContent, $userDate);
            break;
    }
}

    function saveNote($user_id, $content, $date_created) {
        try {
            $con = new PDO(
                        "mysql:host=MBP13.local;port=3307;dbname=chromanote",
                        "phpadmin",
                        "php",
                        array(
                            PDO::ATTR_PERSISTENT => true,
                            PDO::MYSQL_ATTR_INIT_COMMAND =>
                                "SET CHARACTER SET 'utf8'",
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        )
            );
        } catch (Exception $e) {
            throw new RuntimeException(
                    "Failed to initiate connection to database. Shutting down!",
                    1010
            );
            exit;
        }

        $query = "";
        $stid = null;

        // $date = $this->format_date_for_sql($date_created);

        $query = "
            INSERT INTO notes (user_id, content, date_created)
            VALUES (
                :user_id_bv,
                :content_bv,
                :date_created_bv
                )
            ";

        $stid = $con->prepare($query);
        $stid->bindParam(":user_id_bv", $user_id, PDO::PARAM_INT);
        $stid->bindParam(':content_bv', $content, PDO::PARAM_STR);
        $stid->bindParam(':date_created_bv', $date_created, PDO::PARAM_STR);
        $stid->execute();
    }

    function format_date_for_sql($date)
    {
        if ($date == "") {
            return null;
        } else {
            $dateTime = new DateTime($date, new DateTimeZone("UTC"));
            return $dateTime->format("Y-n-j H:i:s e");
        }
    }

    function testSaveNote($content) {
        echo $content;
    }
?>