﻿<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChromaNote</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/notetake.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
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
                <li class="active"><a href="index.php" class="header-links">ChromaNote</a></li>
                <li><a href="templates/notes.php" class="header-links">Notes</a></li>
                <li><a href="templates/about.php" class="header-links">About</a></li>
            </ul>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container body-content">

        <h2>ChromaNote</h2>

        <div class="jumbotron" id="note-textarea">
            <form action="notes.php" method="GET" name="notelist">
                Show note list of:
                <input type="text" name="user" value="" />
                <input type="submit" value="Go" />
            </form>

            <div id="note">
                <ul id="note-list">
                    <!-- input text is appended here -->
                </ul>
            </div>
            <span id="note-span"><input type="text" id="note-input" placeholder="Type and Press Enter"></span>
        </div>


        <input type="submit" class="button saveNote" name="Save Note" value="testSaveNote" />

        <script>
            $(document).ready(function() {
                // $('.button').click(function(){
                //     var noteContent = document.getElementById('note').innerHTML;
                //     var clickBtnValue = $(this).val();
                //     var ajaxurl = 'ajax.php',
                //     data =  {'action': clickBtnValue};
                //     $.post(ajaxurl, data, function (response) {
                //         // Response div goes here.
                //         console.log(response);
                //         console.log("action performed successfully");
                //     });
                // });



                $('.button.saveNote').click(function() {
                    console.log("Insert note pressed");
                    var noteContent = document.getElementById('note').innerHTML;
                    var userDate = getCurrentDate();
                    var ajaxurl = 'ajax.php',
                        data = {
                            'action': 'insert_note',
                            'noteContent': noteContent,
                            'userDate': userDate
                        };
                    $.post(ajaxurl, data, function(response) {
                        // Response div goes here.
                        console.log(response);
                        console.log("action performed successfully");
                    });
                });

            });
        </script>

        <!-- <form name="saveNote" action="editWish.php">
            <input type="submit" value="Add Wish">
        </form> -->

        <hr />
        <div class="footer">
            <p>Developed by <a href="https://github.com/stephenhu3">Stephen Hu</a> | stephenhu3@gmail.com</p>
        </div>
    </div>

</body>

</html>