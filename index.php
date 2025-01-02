<?php
/***
 * 
 ** mcMAIL - v0.01
 ** Email sending html design
 *
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index, follow">
    <title>Send Multiple E-Mails - mcMAIL by TUBER BOY</title>
    <meta name="msapplication-TileColor" content="#786fff">
    <meta name="theme-color" content="#786fff">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
<div class="header"><a href="">SEND E-MAILS - (Tuber Boy)</a></div>
    <div class="box">
    <div class="title">SEND E-MAILS TO MULTIPLE RECIPIENTS</div>
    <form method="post">
        <input type="email" name="email" placeholder="Enter A Gmail/E-mail Address *" required>
        <input type="text" name="password" placeholder="Enter Gmail/E-mail Password (for gmail AppPassword) *" required>
		<input type="text" name="name" placeholder="Enter Name">
        <input type="text" name="subject" placeholder="Enter Subject">
        <textarea type="text" name="content" placeholder="Enter Text *" required></textarea>
        <textarea type="text" name="to" placeholder="Enter E-mail List *" required></textarea>
        <input type="text" name="reply" placeholder="Enter Reply E-mail">
        <input type="text" name="cc" placeholder="Enter CC E-mail">
        <input type="text" name="bcc" placeholder="Enter BCC E-mail">
        <button name="send">SEND MAIL</button>
    </form>
    </div>
	<div class="box">
		<div class="title">RESULTS</div>
<?php
set_time_limit(0);
require 'mcMAIL/mcMAIL.php';
if(isset($_POST['send']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	$toList = explode(PHP_EOL, $_POST['to']);
	$name = $_POST['name'];
	$subject = $_POST['subject'];
	$content = $_POST['content'];
	$reply = $_POST['reply'];
	$cc = $_POST['cc'];
	$bcc = $_POST['bcc'];
	foreach($toList as $to)
	{
		echo sendMAIL($email, $password, $to, $name, $subject, $content, $reply, $cc, $bcc);
	}
} else {
	echo 'At First Send E-mails To See Results.';
}

function sendMAIL($email, $password, $to, $name, $subject, $content, $reply = false, $cc = false, $bcc = false)
{
	$mail = new SMTPMailer($email, $password);
	if($reply != false)
	{
		$mail->addReplyTo($reply, $name);
	}
	if($cc != false)
	{
		$mail->addCc($cc, $name);
	}
	if($bcc != false)
	{
		$mail->addBcc($bcc, $name);
	}
	$mail->From($email, $name);
	$mail->addTo($to);
	$mail->Subject($subject);
	$mail->Body($content);
	if($mail->Send())
	{
		return 'Mail Sent Successfully To: <font color="green">'.$to.'</font><br><br>';
	} else {
		return 'Oops!!! Failed To Sent Mail: <font color="red">'.$to.'</font><br><br>';
	}
}
?>
		</div>
<div class="footer">&copy; Copyright <?php echo date('Y'); ?> - mcMAIL (<a href="https://github.com/TuberBoy">Tuber Boy</a>)</div>
</body>
</html>