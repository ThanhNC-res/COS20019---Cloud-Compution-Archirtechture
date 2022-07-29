<!DOCTYPE html>
<html lang="en">
head>
  <meta charset = "utf-8"/>
  <meta name = "description" content = "Assignment 2"/>
  <meta name = "keywords" content ="cos20019.aws.cloud"/>
  <meta name = "author" content = "Ngo Cong Thanh - 103433609">
  <title>PHP File Upload</title>
</head>
<body>
    <H2>Student ID: 103433609</H2>
    <H2>Student Name: NGO CONG THANH</H2>
    <fieldset>
        <legend>Upload photo Form</legend>
    <form action="handle.php" method="POST" enctype="multipart/form-data">
    <label for="title">Photo title</label>
    <input type="text" id="title" name="title"> <br><br>
    <label>Select a photo</label>
    <input type="file" name="anyfile" id="anyfile"> <br><br>
    <label for="description">Description</label>
    <input type="text" id="description" name="description"> <br><br>
    <label for="date">Date</label>
    <input type="date" id="date" name="date"> <br><br>
    <p>Keywords (separated by semicolon, e.g. keyword1; keyword2; etc.)
    </p>
    <input type="text" id="keywords" name="keywords"> <br><br>
    <button style="font-size: 1.5rem;" type="submit">
    Upload
    </button>
    </form>
    </fieldset>
    <form action="getphotos.php">
    <input type="submit" value="Go to Photo Album view" />
    </form>
</body>
</html>


