'use strict';

const utils = require('utility');

module.exports = {
  up: async queryInterface => {
      await queryInterface.bulkInsert('Users', [{
        email: 'littlesqx@gmail.com',
        password: utils.md5('000000'),
        username: 'littlesqx',
        wechat: 'littlesqx',
        team_id: 1,
        receive_remote: 0,
        email_verifyed: 1,
        avatar: 'xxx.jpg',
        created_at: new Date(),
        updated_at: new Date()
      }])
  },

  down: async queryInterface => {
      await queryInterface.bulkDelete('Users');
  }
};
