<?php

require_once "core.php";
require_once "style/head.php";

setcookie("HOTEL_MAN_USER", "", time()-3600);

?>

Logged out successfully. You should be redirected to home page.

<script> setTimeout(function(){window.location.replace("index.php");}, 3000); </script>

<?php

require_once "style/foot.php";
?>