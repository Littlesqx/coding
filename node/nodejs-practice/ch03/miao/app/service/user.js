'use strict'

const R = require('ramda');

class User extends S {

    constructor (ctx) {
        super(ctx);
        this._User = this.ctx.model.User;
        this._Invitation = this.ctx.model.Invitation;
        this.where = this.ctx.helper.where;
    }

    async checkInvitation (code) {
        const invitation = await this._Invitation.find(this.where({ code }));
        if (!invitation || invitation.use_user_id) {
            return this.ctx.helper.throw(400, 'code', '无效的邀请码');
        }
        return invitation;
    }

    async generatorInvitation(user_id, length) {
        const invitation_promises = this.ctx.helper.range(length).map(
            _ => {
                return this._Invitation.create({ user_id });
            }
        );
        return Promise.all(invitation_promises);
    }

    async signUp() {
        const body = this.ctx.request.body;
        const invitation = await this.checkInvitation(body.code);
        const user = await this._User.create(
            R.pick(['username', 'password', 'email'], body)
        );
        console.dir(user.__proto__);
        console.dir(invitation.__proto__);
        invitation.use_user_id = user.id;
        invitation.use_username = user.username;
        await invitation.save();
        const invitations = await this.generatorInvitation(user.id, 5);
        return { user, invitations };
    }
}

module.exports = User;