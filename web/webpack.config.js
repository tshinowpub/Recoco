const path = require('path');

module.exports = {
  entry: [
    './src/js/entry.jsx',
  ],
  output: {
    path: path.resolve(__dirname, './js'),
    filename: 'bundle.js',
  },
  module: {
    loaders: [
      {
        exclude: /node_modules/,
        loader: 'babel-loader',
        query: {
          presets: ['es2015', 'stage-1'],
        },
      },
    ],
  },
  resolve: {
    extensions: ['.js', '.jsx'],
  },
};
