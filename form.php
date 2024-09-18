<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .error { color: red; }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Form Input Siswa</h2>
    <?php
    $nisErr = $nameErr = $genderErr = $kelasErr = $ekstraErr = "";
    $nis = $name = $gender = $kelas = "";
    $ekstrakurikuler = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validasi NIS
        if (empty($_POST["nis"])) {
            $nisErr = "NIS wajib diisi.";
        } else {
            $nis = $_POST["nis"];
            if (!preg_match("/^[0-9]{10}$/", $nis)) {
                $nisErr = "NIS harus 10 karakter dan hanya berisi angka.";
            }
        }

        // Validasi Nama
        if (empty($_POST["name"])) {
            $nameErr = "Nama wajib diisi.";
        } else {
            $name = $_POST["name"];
        }

        // Validasi Jenis Kelamin
        if (empty($_POST["gender"])) {
            $genderErr = "Jenis kelamin wajib dipilih.";
        } else {
            $gender = $_POST["gender"];
        }

        // Validasi Kelas
        if (empty($_POST["kelas"])) {
            $kelasErr = "Kelas wajib dipilih.";
        } else {
            $kelas = $_POST["kelas"];
        }

        // Validasi Ekstrakurikuler (hanya untuk kelas X dan XI)
        if ($kelas === "X" || $kelas === "XI") {
            if (empty($_POST["ekstrakurikuler"])) {
                $ekstraErr = "Pilih minimal 1 ekstrakurikuler.";
            } else {
                $ekstrakurikuler = $_POST["ekstrakurikuler"];
                if (count($ekstrakurikuler) > 3) {
                    $ekstraErr = "Pilih maksimal 3 ekstrakurikuler.";
                }
            }
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
            <label for="nis">NIS:</label>
            <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $nis;?>">
            <span class="error"><?php echo $nisErr;?></span>
        </div>

        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>">
            <span class="error"><?php echo $nameErr;?></span>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin:</label><br>
            <input type="radio" name="gender" value="Pria" <?php if (isset($gender) && $gender=="Pria") echo "checked";?>> Pria
            <input type="radio" name="gender" value="Wanita" <?php if (isset($gender) && $gender=="Wanita") echo "checked";?>> Wanita
            <span class="error"><?php echo $genderErr;?></span>
        </div>

        <div class="form-group">
            <label for="kelas">Kelas:</label>
            <select class="form-control" id="kelas" name="kelas" onchange="toggleEkstrakurikuler()">
                <option value="">Pilih Kelas</option>
                <option value="X" <?php if ($kelas == "X") echo "selected";?>>X</option>
                <option value="XI" <?php if ($kelas == "XI") echo "selected";?>>XI</option>
                <option value="XII" <?php if ($kelas == "XII") echo "selected";?>>XII</option>
            </select>
            <span class="error"><?php echo $kelasErr;?></span>
        </div>

        <div class="form-group" id="ekstrakurikulerSection" style="display: none;">
            <label>Ekstrakurikuler:</label><br>
            <input type="checkbox" name="ekstrakurikuler[]" value="Pramuka" <?php if (in_array("Pramuka", $ekstrakurikuler)) echo "checked";?>> Pramuka<br>
            <input type="checkbox" name="ekstrakurikuler[]" value="Seni Tari" <?php if (in_array("Seni Tari", $ekstrakurikuler)) echo "checked";?>> Seni Tari<br>
            <input type="checkbox" name="ekstrakurikuler[]" value="Sinematografi" <?php if (in_array("Sinematografi", $ekstrakurikuler)) echo "checked";?>> Sinematografi<br>
            <input type="checkbox" name="ekstrakurikuler[]" value="Basket" <?php if (in_array("Basket", $ekstrakurikuler)) echo "checked";?>> Basket<br>
            <span class="error"><?php echo $ekstraErr;?></span>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>
</div>

<script>
    function toggleEkstrakurikuler() {
        var kelas = document.getElementById("kelas").value;
        var ekstraSection = document.getElementById("ekstrakurikulerSection");
        if (kelas === "X" || kelas === "XI") {
            ekstraSection.style.display = "block";
        } else {
            ekstraSection.style.display = "none";
        }
    }

    // Ensure the Ekstrakurikuler section is toggled correctly on page load
    window.onload = function() {
        toggleEkstrakurikuler();
    };
</script>

</body>
</html>
