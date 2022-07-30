function clearer() {
    const form = document.getElementById('form');

    form.addEventListener('submit',function (e) {
        e.preventDefault();
    });
    document.getElementById('payload').value = '';
    document.getElementById('signature').value = '';
    document.getElementById('public_key').value = '';
    document.getElementById('private_key').value = '';

    fetch('https://signature.test/index.php?clear=1').then(t=>console.log(t));
}

if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
