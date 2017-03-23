const path = require('path');

module.exports = {
  entry: './src/js/entry.jsx',
  output: {
    path: path.join(__dirname, './js'),
    filename: 'bundle.js',
  },
  module: {
    rules: [
      {
        use: 'babel-loader',
        test: /\.jsx?$/,
        exclude: /node_modules/,
      },
    ],
  },
  resolve: {
    extensions: ['.js', '.jsx'],
  },
  devtool: 'source-map',
};
