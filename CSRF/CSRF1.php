
//that code would help you to understood
//and to understand the main idea and how to build you payload

<?php
session_start();

if (empty($_SESSION['token'])) {

    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

if (!empty($_POST['token'])) {
    if (hash_equals($_SESSION['token'], $_POST['token'])){
        echo "CSRF token verified";     
    } else {
        echo "Nope";
    }
}
?>

<form action "CSRF1.php" method="POST">
    <div>
        <label for="bla"bla bla bla</label>
        <input name="bla" id="bla" value="bla ble">
    </div>
    <div>
        <label for="to">bla bla bla bla</label>
        <input name="to" id="to" value="Mom">
    </div>
    <input name="token" id="token" value="<?php echo $token;?>" hidden>
    <div>
        <button>submit</button>
    </div>
</form>
