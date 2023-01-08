<?php
require_once 'connection.php';
@session_start();
$code = $_SESSION['code'];
$password = $_SESSION['password'];
$name = $_SESSION['name'];
$dashboard = $_SESSION['dashboard'];

if ($code == '' || $name == '' || $password == '') {
    print "<script language='JavaScript'>window.location='../../../index.php';</script>";
} else {
    if ($painelAtual != $dashboard) {
        print "<script language='JavaScript'>window.location='../../../index.php';</script>";
    }
}
?>

<?php
if (@$_GET['acao'] == 'quebra') {
    session_start();
    session_unset();
    session_destroy();

    $_SESSION['code'];
    $_SESSION['name'];
    $_SESSION['senha'];
    $_SESSION['dashboard'];

    print "<script language='JavaScript'>window.location='../../../index.php';</script>";
}
?>
