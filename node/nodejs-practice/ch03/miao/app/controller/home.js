'use strict';

class HomeController extends Controller {
  async index() {
    // console.log(global.use);
    // const r = use('app.schemas.signup');
    this.ctx.type = 'json';
    this.ctx.body = this.ctx.state;
  }
}

module.exports = HomeController;
