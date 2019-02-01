'use strict'

const passportingDebug = require('debug')('app:passport');

module.exports = {

    /**
     *
     * @param {*} ctx
     * @param {*} user
     * @returns
     */
    async verify (ctx, user) {
        passportingDebug('use ' + user.provider);
        return require('./' + user.provider)(ctx, user);
    },

    async serializeUser(ctx, user) {
        return user;
    },

    async deserializeUser(ctx, user) {
        return user;
    }
}