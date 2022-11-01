<?php
require_once "config.php";

$name = $count = $price = "";
$name_error = $count_error = $price_error = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

        $name = trim($_POST["name"]);
        if (empty($name)) {
            $name_error = "Name is required.";
        } elseif (!filter_var($name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $name_error = "Name is invalid.";
        } else {
            $name = $name;
        }

        $count = trim($_POST["count"]);
        if (empty($count)){
            $count_error = "Count is required.";
        } else {
            $count = $count;
        }

        $price = trim($_POST["price"]);
        if (empty($price)){
            $price_error = "Price is required.";
        } else {
            $price = $price;
        }

    if (empty($name_error) && empty($count_error) && empty($price_error)) {

          $sql = "UPDATE `items` SET `name`= '$name', `count`= '$count', `price`= '$price' WHERE id='$id'";

          if (mysqli_query($conn, $sql)) {
              header("location: index.php");
          } else {
              echo "Something went wrong. Please try again later.";
          }

    }

    mysqli_close($conn);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        $query = mysqli_query($conn, "SELECT * FROM items WHERE ID = '$id'");

        if ($item = mysqli_fetch_assoc($query)) {
            $name   = $item["name"];
            $count  = $item["count"];
            $price  = $item["price"];
        } else {
            echo "Something went wrong. Please try again later.";
            header("location: edit.php");
            exit();
        }
        mysqli_close($conn);
    }  else {
        echo "Something went wrong. Please try again later.";
        header("location: edit.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
                    <div class="page-header">
                        <h2>Update Item</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <div class="form-group <?php echo (!empty($name_error)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($count_error)) ? 'has-error' : ''; ?>">
                            <label>Count</label>
                            <input type="number" name="count" class="form-control" value="<?php echo $count; ?>">
                            <span class="help-block"><?php echo $count_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($price_error)) ? 'has-error' : ''; ?>">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block"><?php echo $price_error;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>