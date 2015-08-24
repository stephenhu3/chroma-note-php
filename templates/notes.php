<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chroma-Note</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/notetake.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/styles.css" type="text/css">
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
            </div>

            <ul class="nav navbar-nav">
                <li><a href="../index.php" class="header-links">ChromaNote</a></li>
                <li class="active"><a href="notes.php" class="header-links">Notes</a></li>
                <li><a href="about.php" class="header-links">About</a></li>
            </ul>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li></li>
                </ul>
            </div>
        </div>
    </div>
    
    
    <div class="container body-content">

        <h2>Notes</h2>

        <div class="jumbotron" id="note-textarea">
        <?php
            require_once("../db.php");
            $notes = NoteDB::getInstance()->get_notes_by_user_name('Stephen');
            if (0 === $notes->count()) {
                echo '<div class="error">';
                    echo 'The person ';
                    echo 'Stephen';
                    echo 'is not found. Please check the spelling and try again.';
                echo '</div>';
            } else {
                while ($notes->valid()) { 
                    $row = $notes->current();
                    echo '<div id="note">';
                    echo 'Date Created: ';
                    echo $row['DATE_CREATED'];
                    echo '<br>';
                    // Saved notes appear here
                    echo $row['CONTENT'];
                    echo '</div>';
                    $notes->next();
                }
            }
        ?>
        </div>
            <hr />
    <div class="footer">
        <p>Developed by <a href="https://github.com/stephenhu3">Stephen Hu</a> | stephenhu3@gmail.com</p>
    </div>
    </div>
</body>
</html>
