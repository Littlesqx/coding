module.exports = options => {
    if (!options.format) {
        console.error('format property is required');
    }
    return async (ctx, next) => {
        console.log(options.format(ctx.url));
        await next();
    };
};