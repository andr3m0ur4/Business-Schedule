const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  configureWebpack: {
    module: {
      rules: [
        {
          test: /\.hbs$/,
          loader: "handlebars-template-loader"
        }
      ]
    }
  }
})
