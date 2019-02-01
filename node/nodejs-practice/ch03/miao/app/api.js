'use strict'

module.exports = ctl => ({
    post: {
        '/signup': ctl.user.signup,
        '/signin': ctl.user.signin
    }
});