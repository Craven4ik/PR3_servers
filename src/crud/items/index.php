<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Dashboard</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <style type="text/css">
          .wrapper {
              width: 1200px;
              margin: 0 auto;
          }
      </style>
  </head>
  <body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Items</h2>
                        <a href="create.php" class="btn btn-success pull-right">Add New Item</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // select all users
                    $data = "SELECT * FROM items";
                    if($items = mysqli_query($conn, $data)){
                        if(mysqli_num_rows($items) > 0){
                            echo "<table class='table table-bordered table-striped'>
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Count</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>";
                                while($item = mysqli_fetch_array($items)) {
                                    echo "<tr>
                                            <td>" . $item['id'] . "</td>
                                            <td>" . $item['name'] . "</td>
                                            <td>" . $item['count'] . "</td>
                                            <td>" . $item['price'] . "</td>
                                            <td>
                                              <a href='read.php?id=". $item['id'] ."' title='View Item' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>
                                              <a href='edit.php?id=". $item['id'] ."' title='Edit Item' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                                              <a href='delete.php?id=". $item['id'] ."' title='Delete Item' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>
                                            </td>
                                          </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            mysqli_free_result($items);
                        } else{
                            echo "<p class='lead'><em>No records found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }

                    // Close connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>