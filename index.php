<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ChromaNote</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="js/notetake.js"></script>
      <script src="js/bootstrap-confirm-button.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" type="text/css">
      <link rel="stylesheet" href="css/styles.css" type="text/css">
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
                  <li class="active"><a href="index.php" class="header-links">ChromaNote</a></li>
                  <li><a href="templates/notes.php" class="header-links">Notes</a></li>
                  <li><a href="templates/about.php" class="header-links">About</a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
                  <li>
                     <a href="https://github.com/stephenhu3" class="github-link" target="_blank"><img class="logo" src="img/logo.png">GitHub | Stephen Hu</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <div class="container body-content">
         <h2>ChromaNote</h2>
         <div class="jumbotron" id="note-textarea">
            <div id="note">
               <ul id="note-list">
                  <!-- input text is appended here -->
               </ul>
            </div>
            <span id="note-span"><input type="text" id="note-input" placeholder="Type and Press Enter"></span>
         </div>
         <button type="button" class="btn btn-success btn-block button btn-flash-notice saveNote">Save Note</button>
         <button type="button" class="btn btn-warning btn-block button btn-delete-item discardNote">Discard Note</button>
         <hr />
         <div class="footer">
            <p>Developed for fun by <a href="https://github.com/stephenhu3">Stephen Hu</a></p>
         </div>
      </div>
   </body>
</html>