<?php
    if ($_GET['module']=='home') {
        include "dashboard.php";
    }elseif($_GET['module']=='movie') {
        include "module\movies\movies.php";
    }elseif($_GET['module']=='jadwal') {
        include "module\jadwal\jadwal.php";
    }elseif($_GET['module']=='penjualan') {
        include "module\jual\jual.php";
    }else{
        echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
    }
?>