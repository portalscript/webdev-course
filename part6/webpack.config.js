const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	entry: './src/test.js',
	output: {
		path: path.resolve(__dirname, 'dist'),
		filename: 'my-output-code.js',
	},
	module: {
		rules: [
			{
				test: /\.jsx?$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: [
							['@babel/preset-env', { targets: "defaults" }],
							['@babel/preset-react'],
						]
					}
				}
			},
			{
				test: /\.css$/i,
				use: [MiniCssExtractPlugin.loader, "css-loader"],
			},
		]
	},
	plugins: [
		new HtmlWebpackPlugin({
			title: 'My Custom Webpack App'
		}),
		new MiniCssExtractPlugin()
	],
};
