'use strict'

const path = require('path');
const R = require('ramda');

const check = R.curry((obj, key) => typeof obj[key] !== 'undefined');

const notInGlobal = key => !check(global)(key);

function globalBaseInitial (baseDir) {
    const _use = dir => require(path.resolve(baseDir, dir));
    if (notInGlobal('check')) {
        global.check = check;
    }

    if (notInGlobal('Controller')) {
        global.C = global.Controller = _use('app/controller/base');
    }

    if (notInGlobal('Service')) {
        global.S = global.Service = require('egg').Service;
    }

    if (notInGlobal('use')) {
        global.use = dir => {
            dir = dir.replace(/\./g, path.sep);
            return _use(dir);
        }
    }

    if (notInGlobal('ENV')) {
        global.ENV = process.env.NODE_ENV !== 'production';
    }
}

module.exports = {
    globalBaseInitial
};