<?php
session_start();
$setTimer = new DateTime($_SESSION['timer']);
$countDown = new DateTime();

$interval = $setTimer->diff($countDown);


$min = str_pad($interval->i, 2, "0", STR_PAD_LEFT);
$sec = str_pad($interval->s, 2, "0", STR_PAD_LEFT);

echo $min . ':' . $sec;

if ($min == 0 && $sec == 0) {

?>
    <script>
        document.getElementById('test').submit();
    </script>
<?php
}
