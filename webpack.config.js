const webpack = require('webpack');
const Path = require('path');
const { JavascriptWebpackConfig, CssWebpackConfig } = require('@silverstripe/webpack-config');

const PATHS = {
  ROOT: Path.resolve(),
};

const config = [
  // Main JS bundles
  new JavascriptWebpackConfig('js', PATHS)
    .setEntry({
      bundle: './client/src/boot/index.js'
    })
    .getConfig(),
  new CssWebpackConfig('css', PATHS)
    .setEntry({
      bundle: './client/src/styles/bundle.scss'
    })
    .getConfig(),

];

// Use WEBPACK_CHILD=js or WEBPACK_CHILD=css env var to run a single config
module.exports = (process.env.WEBPACK_CHILD)
  ? config.find((entry) => entry.name === process.env.WEBPACK_CHILD)
  : config;
