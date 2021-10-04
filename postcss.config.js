module.exports = {
  plugins: {
    'postcss-flexbugs-fixes': {},
    'postcss-preset-env': {
      browsers: 'last 2 versions',
      autoprefixer: {
        flexbox: true,
        grid: true,
      },
      stage: 1,
      features: {
        'custom-properties': true,
      },
    },
    'postcss-calc': {},
  },
};
