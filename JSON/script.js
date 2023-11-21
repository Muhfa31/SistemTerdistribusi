// let mahasiswa = {
//     nama: "Faza Abdi",
//     nim: "068",
//     email: "fazaa3151@gmail.com"
// }

// console.log(JSON.stringify(mahasiswa));

// let coba = new XMLHttpRequest();
// coba.onreadystatechange = function() {
//     if (coba.readyState == 4 && coba.status == 200) {
//         let mahasiswa = JSON.parse(this.responseText);
//         console.log(mahasiswa);
//     }
// }

// coba.open('GET', 'data.json', true);
// coba.send();

$.getJSON('data.json', function(data) {
    console.log(data);
});