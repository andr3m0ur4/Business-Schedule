const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  configureWebpack: {
    module: {
      rules: [
        {
          test: /\.hbs$/,
          loader: "handlebars-template-loader"
        },
        {
          test: /\.tsx?$/,
          use: [
            {
              loader: 'ts-loader',
              options: {
                transpileOnly: true
              }
            }
          ]
        }
      ]
    }
  },
  chainWebpack: (config) => {
    config.plugins.delete('fork-ts-checker')
  },
  pwa: {
    iconPaths: {
      favicon32: "./public/favicon.ico",
      favicon16: "./public/favicon.ico",
      appleTouchIcon: "./public/favicon.ico",
      maskIcon: "./public/favicon.ico",
      msTileImage: "./public/favicon.ico"
    }
  }
})
