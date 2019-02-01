'use strict'

const { forEachObjIndexed, forEach } = require('ramda');
const chalk = require('chalk');

function initRouterMap (prefix, maps, router) {
    forEachObjIndexed((map, method) => {
        forEachObjIndexed((controller, url) => {
            if (process.env.NODE_ENV && process.env.NODE_ENV !== 'production') {
                const chalk = require('chalk')
                console.log(
                    `${chalk.blue('[' + method + ']')} -> ${chalk.red(prefix + url)}`
                )
            }
            router[method](prefix + url, controller);
        }, map)
    }, maps)
}

function mountPassportToController (keys, passport, controller) {
    if (!controller) {
        controller.passport = {}
    }
    forEach(value => {
        if (DEV) {
            console.log(`${chalk('[mount passport]')} ${chalk.red(value)}`);
        }
        controller.passport[value] = passport.authenticate(value, {
            session: false,
            successRedirect: undefined
        });
    }, keys);
}

function installPassword(passport, { verify }) {
    passport.verify(verify);
}

module.exports = {
    initRouterMap,
    mountPassportToController,
    installPassword
};