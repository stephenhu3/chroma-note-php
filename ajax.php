<?php
require_once("db.php");

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'insert_note':
            $noteContent = $_POST["noteContent"];
            $userDate    = $_POST["userDate"];
            echo $noteContent;
            NoteDB::getInstance()->insert_note(1, $noteContent, $userDate);
            break;
    }
}
?>