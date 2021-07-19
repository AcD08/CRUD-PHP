<?php 

$DB = mysqli_connect("localhost", "root", "", "product_database");


function query($query) {
    global $DB;
    $result = mysqli_query($DB, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data) {
    global $DB;
    $productName = htmlspecialchars($data["productName"]);
    $unit = htmlspecialchars($data["unit"]);
    $productTag = json_encode($data["productTag"]);
    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }
     // Insert Data
    $query = "INSERT INTO master_product VALUES ('', '$productName', '$unit', '1', '$gambar', '6', '$productTag')";
    // $query = "INSERT INTO `master_product` VALUES ('', '$productName', '$unit', '$productTag', '$gambar', '6')";
    mysqli_query($DB, $query);
    return mysqli_affected_rows($DB);
}

function upload() {
    $namaFile = $_FILES['photo']['name'];
    $ukuranFile = $_FILES['photo']['size'];
    $error = $_FILES['photo']['error'];
    $tmpName = $_FILES['photo']['tmp_name'];

    // Cek apakah ada gambar yang diupload

    if ($error === 4) {
        echo "<script>alert('Pilih gambar dulu');</script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $extGambarFile = ['jpg', 'jpeg', 'png'];
    $extGambar = explode('.', $namaFile);
    $extGambar = strtolower(end($extGambar));
    if (!in_array($extGambar, $extGambarFile)) {
        echo "<script>alert('Yang diupload bukan gambar!');</script>";
        return false;
    }

    // cek ukuran gambar
    if ($ukuranFile > 1000000) {
        echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
        return false;
    }

    // lolos pengecekan
    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id) {
    global $DB;
    mysqli_query($DB, "DELETE FROM master_product where id = $id");
    return mysqli_affected_rows($DB);
}

function ubah($data) {
    global $DB;
    $id = $data["id"];
    $productName = htmlspecialchars($data["productName"]);
    $unit = htmlspecialchars($data["unit"]);
    $productTag = htmlspecialchars($data["productTag"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    // Cek apakah user pilih gambar baru atau tidak
    if ($_FILES['photo']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


     // Insert Data
    $query = "UPDATE master_product SET
                product_name = '$productName',
                unit_id = '$unit',
                tag_id = '$productTag',
                photo = '$gambar'
                WHERE id = $id;
                ";
    mysqli_query($DB, $query);

    return mysqli_affected_rows($DB);
}


function regist($data) {
    global $DB;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($DB, $data["password"]);
    $konfirmPassword = mysqli_real_escape_string($DB, $data["password2"]);

    // cek apakah username sudah ada
    $resultName = mysqli_query($DB, "SELECT username FROM master_users WHERE username = '$username'");
    if (mysqli_fetch_assoc($resultName)) {
        echo "
        <script>
            alert ('username sudah terdaftar!');
        </script>
        ";
        return false;
    }
    // cek apakah password sama dengan konfirmasi password 
    if ($password !== $konfirmPassword) {
        echo "
        <script>
            alert ('konfirmasi password tidak sesuai!');
        </script>
        ";
        return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // Tambah user ke database
    mysqli_query($DB, "INSERT INTO master_users VALUES ('', '$username', '$password')");

    return mysqli_affected_rows($DB);
}
?>