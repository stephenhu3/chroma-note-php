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
                <li><a href="notes.php" class="header-links">Notes</a></li>
                <li class="active"><a href="about.php" class="header-links">About</a></li>
            </ul>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container body-content">

        <h2>About</h2>

        <div class="jumbotron">
            <p>Press enter to submit current text input.</p>

            <p>Press ALT + SHIFT to cycle through colors.</p>

            <p>Press ALT + 1 through 5 to select color.</p>
        </div>
            <hr />
    <div class="footer">
        <p>Developed by <a href="https://github.com/stephenhu3">Stephen Hu</a> | stephenhu3@gmail.com</p>
    </div>
    </div>
</body>
</html>