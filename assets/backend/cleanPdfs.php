<?php

// echo "pdf deleted";

if(isset($_POST['pdfPath'])){

    unlink('../../'.$_POST['pdfPath']);


}

?>