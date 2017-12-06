
const config = window.config || {};

const appId = (config.appId != null ) ? config.appId : '#app';

module.exports.config =config;
module.exports.appId = appId;