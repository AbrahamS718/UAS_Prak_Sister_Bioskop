<?php
    if ($_GET['module']=='home') {
        include "dashboard.php";
    }else{
        echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
    }
?>