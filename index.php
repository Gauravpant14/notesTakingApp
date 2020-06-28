<?php
// INSERT INTO `notes` (`sno`, `tittle`, `description`, `tstamp`) VALUES ('1', 'alert', 'hello gaurav its php here', CURRENT_TIMESTAMP);
$insert = false;
//connect to database
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

//create connection
$conn = mysqli_connect($servername, $username, $password, $database);

//die if connection was not successful
if(!$conn ){
   die("Could not connect: ". mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST["title"];
    $description = $_POST["description"];

    //sql query to be executed
    $sql = "INSERT INTO `notes` (`title`,`description`) VALUES ('$title', '$description')";

    if (mysqli_query($conn, $sql)) {
        $insert = true;
     } else {
        echo "Error: " . $sql . "" . mysqli_error($conn);
     }

}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">  
      

    <title>curd Application</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">iNotes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <?php
    if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> You notes has been recorded successfully.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    ?>

    <div class="container my-4">
        <form action="/phpcurd/index.php" method="post" >
            <div class="form-group">
                <label for="title">Note Tittle</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">

            </div>
            <div class="form-group">
                <label for="desc">Note Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>
    <div class="container my-4">
        
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = 'SELECT * FROM `notes`';
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <th scope='row'>". $row['sno'] . "</th>
                <td>". $row['title'] . "</td>
                <td>". $row['description'] ."</td>
                <td>Tittle</td>
            </tr>";
                
             }
        ?>
               
                
            </tbody>
        </table>

    </div>
    <hr>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
</body>

</html>