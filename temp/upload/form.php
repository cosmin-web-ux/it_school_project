<html>
<head>
    <title>Upload file</title>
</head>
<body>

<form method="post" action="upload.php" enctype="multipart/form-data">
    <h1>Upload fisiere</h1>

    Name<br/>
    <input type="text" name="name"/>
    <br/><br/>

    Photo<br/>
    <input type="file" name="photo"/>
    <br/><br/>

    <input type="submit" value="upload"/>

</form>

</body>
</html>