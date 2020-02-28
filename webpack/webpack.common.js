const Path = require("path");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const CopyWebpackPlugin = require("copy-webpack-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const path = require("path");

const THEME_NAME = "Alek's OOP";
const PROXY_TARGET = "wordpress-dev.me";
const themePath = path.resolve(__dirname, `../`);

module.exports = {
  entry: {
    app: Path.resolve(__dirname, "../src/scripts/index.js")
  },
  output: {
    path: Path.join(__dirname, "../assets"),
    filename: "js/[name].js"
  },
  optimization: {
    splitChunks: {
      chunks: "all"
    }
  },
  plugins: [
    new CleanWebpackPlugin(),
    new CopyWebpackPlugin([
      { from: Path.resolve(__dirname, "../public"), to: "public" }
    ])
  ],
  resolve: {
    alias: {
      "~": Path.resolve(__dirname, "../src")
    }
  },
  module: {
    rules: [
      {
        test: /\.(html)$/,
        use: {
          loader: "html-loader",
          options: {
            interpolate: true,
            attrs: [":data-src"]
          }
        }
      },
      {
        test: /\.mjs$/,
        include: /node_modules/,
        type: "javascript/auto"
      },
      {
        test: /\.(ico|jpg|jpeg|png|gif|eot|otf|webp|svg|ttf|woff|woff2)(\?.*)?$/,
        use: {
          loader: "file-loader",
          options: {
            name: "[path][name].[ext]"
          }
        }
      }
    ]
  }
};
