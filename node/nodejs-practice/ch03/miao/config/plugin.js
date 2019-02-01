'use strict';

// had enabled by egg
// exports.static = true;

exports.sequelize = {
    enable: true,
    package: 'egg-sequelize'
};

exports.validator = {
    enable: true,
    package: 'egg-y-validator'
};

exports.passport = {
    enable: true,
    package: 'egg-passport'
}

exports.jwt = {
    enable: true,
    package: 'egg-jwt'
}

exports.passportLocal = {
    enable: true,
    package: 'egg-passport-local',
    usernameField: 'email',
    passwordField: 'password'
}
