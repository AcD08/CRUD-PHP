<?php 


require 'functions.php';
$products = query("SELECT * FROM master_product LEFT JOIN master_unit ON master_product.unit_id = master_unit.unit_id LEFT JOIN master_product_tag ON master_product.tag_id = master_product_tag.tag_id LEFT JOIN master_users ON master_product.user_id = master_users.user_id");

foreach ($products as $key => $value) {
    $tmp = json_decode($value["mapping_product_tag"]);
    $temp = '';
    $comma = ' , ';
    for ($i=0; $i < count($tmp); $i++) { 
        if ($i == count($tmp) - 1) {
            $comma = '';
        }
        $result = query("SELECT product_tag_name FROM master_product_tag WHERE tag_id = $tmp[$i]");
        $temp .= $result[0]["product_tag_name"]. $comma;
    }
    $products[$key]["product_tag_name_1"] = $temp;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
</head>
<body>


<div class="container-table">
<h1 class="heading-table">Product List</h1>

<a href="logout.php" class="link">Logout</a> | 
<a href="tambah.php" class="link">Add New Product</a>
<br><br>



<table border="1" cellpadding="10" cellspacing="0">

    <tr>
    <th>No.</th>
    <th>Action</th>
    <th>Product Name</th>
    <th>Unit Name</th>
    <th>Product Tag</th>
    <th>Photo</th>
    <th>Ditambahkan oleh</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($products as $product) : ?>
    <tr>
    <td><?= $i ?></td>
    <td>
        <a href="ubah.php?id=<?= $product["id"]; ?>">Edit</a> | 
        <a href="hapus.php?id=<?= $product["id"]; ?>" onclick="return confirm('yakin?');">Delete</a>
    </td>
    <td><?= $product["product_name"]; ?></td>
    <td><?= $product["unit_name"]; ?></td>
    <td><?= $product["product_tag_name_1"]; ?></td>
    <td><img src="img/<?= $product["photo"]; ?>" alt=""></td>
    <td><?= $product["username"]; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>


</table>
</div>
    
</body>
</html>

<!-- ctrl + d untuk block semua elemen yang ingin diganti -->