<?php
if (!isset($_POST["username"], $_POST["password"])) {
	exit("Please fill both the username and password fields!");
} else {
    ob_start();
    ?>
    <form id="redirectForm" action="../model/authenticate.php" method="POST">
        <input type="hidden" name="username" value="<?php echo htmlspecialchars($_POST['username']); ?>">
        <input type="hidden" name="password" value="<?php echo htmlspecialchars($_POST['password']); ?>">
    </form>
    <script type="text/javascript">
        document.getElementById('redirectForm').submit();
    </script>
    <?php
    ob_end_flush();
    exit();
}
?>