<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <link href="View/bootstrap-5.0.2/css/bootstrap.css" rel="stylesheet">
    <title>RSA-SecTools</title>

</head>
<body class="text-sm-center">
<div class="container">
    <h1>Create Sign</h1>
    <form id="form" method="post">
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
        <div class="row m-0" style="padding-left: 18px">
            <div class="col">
                <button class="btn btn-success w-100" id="sign" name="sign" type="submit">Sign</button>
            </div>
            <div class="col">
                <button class="btn btn-secondary w-100" id="valid" name="valid" type="submit">Validator</button>
            </div>
            <div class="col">
                <button class="btn btn-primary w-100" id="Decryption" name="Decryption" type="submit">Decryption</button>
            </div>
            <div class="col">
                <script>
                    function clearer() {
                        const form = document.getElementById('form');
                        console.log(form)
                        form.addEventListener('submit',function (e) {
                            e.preventDefault();
                        });
                        document.getElementById('payload').value = '';
                        document.getElementById('signature').value = '';
                        document.getElementById('public_key').value = '';
                        document.getElementById('private_key').value = '';
                    }

                </script>
                <button class="btn btn-danger w-100" name="clear" onclick="clearer()">Clear</button>
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


