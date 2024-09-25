<?php

if( (isset($_SESSION['message'])) && (isset($_SESSION['icon'])) ){
    $message = $_SESSION['message'];
    $icon = $_SESSION['icon'];
    ?>
        <script>
            Swal.fire({
              position: "center",
              icon: '<?=$icon?>',
              title: '<?=$message?>',
              showConfirmButton: false,
              timer: 4000
            });
        </script>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['icon']);
}
?>