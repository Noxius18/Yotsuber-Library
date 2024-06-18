let tampilAlert = (pesan) => {
    let alertBox = document.getElementById('customAlert');
    alertBox.innerText = pesan;
    alertBox.style.display = 'block';
    setTimeout(function() {
        alertBox.style.display = 'none';
    }, 3000);
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.has('success') && urlParams.get('success') === 'true'){
        tampilAlert("Buku telah dikembalikan");
    }
}