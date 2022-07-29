<!DOCTYPE html>
<html lang = "en">
<head>
  <meta charset = "utf-8"/>
  <meta name = "description" content = "Assignment 2"/>
  <meta name = "keywords" content ="cos20019.aws.cloud"/>
  <meta name = "author" content = "Ngo Cong Thanh - 103433609">
  <title>View Photo Album</title>
</head>
<body>
  <h1>
Photo Viewer
  </h1>
<h2>Student ID: 103433609</h2>
<h2>Student Name: NGO CONG THANH</h2>
<form action="show.php" method="post" enctype="multipart/form-data">
<fieldset>
  <p><label for="PhotoTitle"><b> Photo Title: </b></label>
  <input type="text" name="PhotoTitle" id = "PhotoTitle"/>
  </p>
  <p>
<label for = "Date"><b> Date Start: </b></label>
<input type = "date" name ="DateStart" id ="DateStart"/>
<label for = "Date"><b> Date Finish: </b></label>
<input type = "date" name ="DateFinish" id ="DateFinish"/>
  </p>
  <p>
<label for = "Keywords" ><b> Keyword: </b></label></p>
<p>
<input type="text" name="Keywords" id = "Keywords" />
  </p>
  <p>
<input type="submit" value="show"/>
  </p>
</fieldset>
<form action="upload.php" style="border: 5px;">
    <input type="submit" value="Upload more photo" />
</form>
</html>