<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chroma-Note</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/notetake.js"></script>
    <script src="../js/bootstrap-confirm-button.js"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-57297383-1', 'auto');
      ga('send', 'pageview');
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/styles.css" type="text/css">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="container">
            <div class="collapse navbar-collapse" id="example-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php" class="header-links">ChromaNote</a></li>
                    <li class="active"><a href="notes.php" class="header-links">Notes</a></li>
                    <li><a href="about.php" class="header-links">About</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="https://github.com/stephenhu3" class="github-link" target="_blank"><img class="logo" src="../img/logo.png">GitHub | Stephen Hu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


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
            <p>Developed for fun by <a href="https://github.com/stephenhu3">Stephen Hu</a></p>
        </div>
    </div>
</body>

</html>