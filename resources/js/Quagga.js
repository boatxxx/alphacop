import Quagga from 'quagga';
Quagga.init({
    inputStream: {
        name: 'Live',
        type: 'LiveStream',
        target: document.querySelector('#your-target-element'), // ใส่เป้าหมายของคุณที่นี่
    },
    decoder: {
        readers: ['code_128_reader', 'ean_reader', 'ean_8_reader', 'code_39_reader', 'code_39_vin_reader', 'codabar_reader', 'upc_reader', 'upc_e_reader', 'i2of5_reader'],
    },
}, function (err) {
    if (err) {
        console.error(err);
        return;
    }
    Quagga.start();
});
