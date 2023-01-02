module.exports = {
  chainWebpack: config => {
    config.module.rules.delete('eslint');
  },
  publicPath: '/naylit/',
  pluginOptions: {
    quasar: {
      rtlSupport: true
    }
  },
  transpileDependencies: [/[\\\/]node_modules[\\\/]quasar[\\\/]/]
};
