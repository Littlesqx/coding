const fs = require('fs');

let data1 = fs.readFileSync('./data/mock.txt');

console.log(data1.toString());

let data2 = fs.readFile('./data/mock.txt', (err, data3) => {
    console.log('data3 ++++');
    console.log(data3.toString());
});

console.log(data2);