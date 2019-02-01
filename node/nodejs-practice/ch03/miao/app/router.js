'use strict'

const init = require('./util').initRouterMap;
const mount = require('./util').mountPassportToController;
const install = require('./util').installPassword;

/**
 * @param {Egg.Application} app - egg application
 */
module.exports = app => {
  const { router, controller } = app;
  router.get('/', controller.home.index);
  install(app.passport, require('./passport'));
  mount(['install'], app.passport, controller);
  init('/api/v1', require('./api')(controller), router);
};
