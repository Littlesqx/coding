'use strict';
const R = require('ramda');
const chalk = require('chalk');

module.exports = appInfo => {
  const config = exports = {};

  // use for cookie sign key, should change to your own and keep security
  config.keys = appInfo.name + '_1547532768739_1227';

  // add your config here
  config.middleware = [];

  config.sequelize = {
    dialect: 'mysql',
    database: 'miao',
    host: '172.17.0.2',
    port: '3306',
    username: 'root',
    password: '123456',
  };

  config.security = {
    csrf: {
      ignoreJSON: true
    }
  };

  config.validator = {
    open: 'zh-CN',
    languages: {
      'zh-CN': {
        required: '% 字段必填'
      }
    },
    async formatter (ctx, error) {
      info('[egg-y-validator] -> %s', JSON.stringify(error, ' '));
      throw new Error(error[0].message);
    }
  };

  config.jwt = {
    secret: '123456',
    enable: true,
    ignore (ctx) {
      const paths = ['api/v1/signin', 'api/v1/signup'];
      if (ENV) {
        const tip = `${chalk.yellow('[ JWT ]')} --> ${
          R.contains(ctx.path, paths)
          ? chalk.green(ctx.path)
          : chalk.red(ctx.path)
        }`
        console.log(tip);
      }
      return R.contains(ctx.path, paths);
    }
  }

  return config;
};
