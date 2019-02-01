'use strict'

class User extends C {
    /**
     * 
     * @description signup
     * 
     * @memberof User
     */
    async signup() {
        await this.ctx.verify('user.signup', 'body');
        const json = await this.ctx.service.user.signup();
        this.ctx.body = json;
    }

    /**
     * @description signin
     * 
     * @memberof User
     */
    async signin() {
        this.ctx.body = 'signin';
    }
}

module.exports = User