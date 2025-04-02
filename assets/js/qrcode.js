document.addEventListener('DOMContentLoaded', function() {
    const qrData = window.qrData || [];
    qrData.forEach(data => {
        new QRCode(document.getElementById(`qrcode-${data.id}`), {
            text: data.text,
            width: 100,
            height: 100
        });
    });
});