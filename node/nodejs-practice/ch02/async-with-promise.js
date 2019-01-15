const getName = new Promise((resolve, reject) => {
    setTimeout(_ => resolve('nodejs'), 50);
});

const getNumber = Promise.resolve(1);
const getError = Promise.reject('error...');

getError.catch(console.log);

Promise.all([getName, getName])
    .then(console.log)
    .catch(console.log);

Promise.race([getName, getName])
    .then(console.log)
    .catch(console.log);

getName.then(name => {
    console.log(name);
    return 20;
})
.then(number => {
    console.log(number);
});
    