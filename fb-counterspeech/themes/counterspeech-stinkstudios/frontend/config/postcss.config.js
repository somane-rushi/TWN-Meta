module.exports = {
    plugins: [
        require('cssnano')({
            preset: 'default',
						discardUnused: false,
        }),
				require('autoprefixer')({
					
				}),
    ],
};
