const webpack = require('webpack');
const { merge } = require('webpack-merge');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const chokidar = require('chokidar');

const common = require('./webpack.common');
const paths = require('./paths');

module.exports = merge(common, {
  // Set the mode to development or production
  mode: 'development',

  // Control how source maps are generated
  devtool: 'inline-source-map',

  output: {
    publicPath: '/wp-content/themes/wpnk/dist/',
    filename: 'js/[name].js',
  },

  // Spin up a server for quick development
  devServer: {
    historyApiFallback: true,
    static: [paths.build, paths.src],
    open: true,
    // compress: true,
    hot: true,
    port: 3015,
    host: 'site.local',
    proxy: {
      '/': {
        target: 'http://site.local',
        secure: false,
        changeOrigin: true,
      },
    },
    onBeforeSetupMiddleware(server) {
      chokidar.watch(['/wp-content/themes/wpnk/**/*.php']).on('all', () => {
        // eslint-disable-next-line no-restricted-syntax
        for (const ws of server.webSocketServer.clients) {
          ws.send('{"type": "static-changed"}');
        }
      });
    },
    headers: {
      'Access-Control-Allow-Origin': '*',
      'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, PATCH, OPTIONS',
      'Access-Control-Allow-Headers': 'X-Requested-With, content-type, Authorization',
    },
  },

  module: {
    rules: [
      // Styles: Inject CSS into the head with source maps
      {
        test: /\.(scss|css)$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: { sourceMap: true, importLoaders: 2, url: false },
          },
          { loader: 'postcss-loader', options: { sourceMap: true } },
          { loader: 'sass-loader', options: { sourceMap: true } },
        ],
      },
    ],
  },

  plugins: [
    new MiniCssExtractPlugin({
      filename: 'styles/style.css',
      chunkFilename: 'styles/[id].css',
    }),
    // Only update what has changed on hot reload
    new webpack.HotModuleReplacementPlugin(),
  ],
});
