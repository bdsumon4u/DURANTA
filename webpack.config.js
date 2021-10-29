const path = require('path');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    optimization :  {
        splitChunks: {
            chunks: "all",
            minSize: 200000,
            maxSize: 244000,
        }
    },
};
