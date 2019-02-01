'use strict';

module.exports = {
  up: async (queryInterface, Sequelize) => {
    const { INTEGER, DATE, STRING, TINYINT } = Sequelize;
    await queryInterface.createTable('Users', {
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
  },

  down: async queryInterface => {
    await queryInterface.dropTable('users');
  }
};
