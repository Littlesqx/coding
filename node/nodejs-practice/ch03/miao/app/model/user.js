'use strict'

module.exports = app => {
    const { STRING, INTEGER, DATE } = app.Sequelize;

    const User = app.model.define('Users', {
        id: {
            type: INTEGER,
            primaryKey: true,
            autoIncrement: true,
            allowNull: false
        },
        email: STRING(40),
        password: STRING,
        username: STRING(40),
        wechat: STRING(40),
        team_id: INTEGER,
        receive_remote: TINYINT(1),
        email_verifyed: TINYINT(1),
        avatar: STRING(40),
        created_at: {
            allowNull: false,
            type: DATE
        },
        updated_at: {
            allowNull: false,
            type: DATE
        }
    });

    async function hashPwd(user) {
        if (!user.changed('password')) {
            return;
        }
        user.password = await bcrypt.hash(user.password, 10);
    }

    User.Auth = async function (email, password) {
        const user = await this.findOne({
            where: {
                email
            }
        });
        if (await bcrypt.compare(password, user.password)) {
            return user;
        }
        return false;
    }

    user.beforeSave(hashPwd);

    return User;
}