const R = require('ramda');

const func = R.curry((a, b, c) => [a, b, c]);

console.log(func(1, 2, 3));
console.log(func(1)(2)(3));
console.log(func(3, R.__, 2)(1));

const check = R.curry((obj, key) => {
    console.log(obj);
    return typeof obj[key] !== 'undefined';
});


const notInGlobal = key => !check({})(key);

if (notInGlobal('check')) {
   
}

if (notInGlobal('Controller')) {
    
}

if (notInGlobal('use')) {
    
}

const compose = (...fns) => (...args) => fns.reduceRight((acc, val) => val(acc), fns[fns.length - 1](...args));

const mockNumber = val => val*2;

compose(console.log, mockNumber)(100);
