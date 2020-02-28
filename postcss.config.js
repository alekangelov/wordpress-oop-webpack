const autoprefixer = require("autoprefixer");
const nano = require("cssnano");
const postcssNormalize = require("postcss-normalize");

module.exports = {
  ident: "postcss",
  plugins: [autoprefixer, nano, postcssNormalize]
};
