<?php
    session_start();
    if (isset($_SERVER["REQUEST_METHOD"])) {
        /** Signature **/
        if (isset($_POST['sign'])) {
            $_SESSION['payload']        = $_POST['payload'];
            $_SESSION['private_key']    = $_POST['private_key'];
            $_SESSION['public_key']     = $_POST['public_key'];

            if ($_SESSION['payload'] and $_SESSION['private_key'] !== null) {
                $binary_signature = "";
                openssl_sign($_SESSION['payload'], $binary_signature, $_SESSION['private_key'], OPENSSL_ALGO_SHA1);
                $_SESSION['signature'] = base64_encode($binary_signature);
            }
            else {
                $_SESSION['verify'] = 'Please fill in the required "payload" or "private key"!';
            }
        }
        /** Validation **/
        if(isset($_POST['valid'])){
            $_SESSION['payload']        = $_POST['payload'];
            $_SESSION['public_key']     = $_POST['public_key'];
            $_SESSION['signature']      = $_POST['signature'];

            if ($_SESSION['payload'] and $_SESSION['public_key'] and $_SESSION['signature'] !== null) {

                $result = openssl_verify($_SESSION['payload'], base64_decode($_SESSION['signature']), $_SESSION['public_key'], OPENSSL_ALGO_SHA1);

                if ($result == 1) {
                    $_SESSION['verify'] = "Valid";
                } elseif ($result == 0) {
                    $_SESSION['verify'] = "Not Valid";
                } else {
                    $_SESSION['verify'] = "Error, checking signature";
                }
            }
            else {
                $_SESSION['verify'] = 'Please fill in the required "payload" or "public key" or "signature"!';
            }

        }
    }
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <link href="bootstrap-5.0.2/css/bootstrap.css" rel="stylesheet">
    <title>RSA-SecTools</title>
</head>
<body class="text-sm-center">
<div class="container">
    <h1>Create Sign</h1>
    <form method="post" action="" >
        <div class="row">
            <div class="col">
                <textarea class="form-control m-2" type="text" id="payload" name="payload" placeholder="Payload" rows="4" cols="50"><?php echo $_SESSION['payload']; ?></textarea>
            </div>
            <div class="col">
                <textarea class="form-control m-2" type="text" id="signature" name="signature" placeholder="Signature" rows="4" cols="50"><?php echo $_SESSION['signature']; ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <textarea class="form-control m-2" type="text" id="public_key" name="public_key" placeholder="Public Key" rows="4" cols="50"><?php echo $_SESSION['public_key']; ?></textarea>
            </div>
            <div class="col">
                <textarea class="form-control m-2" type="text" id="private_key" name="private_key" placeholder="Private Key" rows="4" cols="50"><?php echo $_SESSION['private_key']; ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button class="btn btn-success w-50" name="sign" type="submit">Signature</button>
            </div>
            <div class="col">
                <button class="btn btn-secondary w-50" name="valid" type="submit">Validator</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <textarea class="form-control m-2" type="text" id="result" name="result" placeholder="Result" rows="4" cols="50" ><?php echo $_SESSION['verify'] ?></textarea>
            </div>
        </div>

    </form>
</div>
</body>
</html>
