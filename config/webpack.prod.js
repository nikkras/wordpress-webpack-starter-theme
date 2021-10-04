const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const postcssObjectFitImages = require('postcss-object-fit-images');
const TerserPlugin = require('terser-webpack-plugin');
const { merge } = require('webpack-merge');

const common = require('./webpack.common');

module.exports = merge(common, {
  mode: 'production',

  devtool: false,

  output: {
    publicPath: 'auto',
    filename: 'js/[name].js',
  },

  module: {
    rules: [
      {
        test: /\.(scss|css)$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: '../',
            },
          },
          {
            loader: 'css-loader',
            options: {
              importLoaders: 2,
              sourceMap: false,
            },
          },
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [postcssObjectFitImages()],
              },
            },
          },
          'sass-loader',
        ],
      },
    ],
  },
  plugins: [
    // Extracts CSS into separate files
    new MiniCssExtractPlugin({
      filename: 'styles/style.css',
      // chunkFilename: '[id].css',
    }),
  ],
  optimization: {
    minimize: true,
    minimizer: [
      new TerserPlugin({
        terserOptions: {
          format: {
            comments: false,
          },
        },
        extractComments: false,
      }),
      new CssMinimizerPlugin(),
      '...',
    ],
    // runtimeChunk: {
    //   name: 'runtime',
    // },
  },
  performance: {
    hints: false,
    maxEntrypointSize: 512000,
    maxAssetSize: 512000,
  },
});
