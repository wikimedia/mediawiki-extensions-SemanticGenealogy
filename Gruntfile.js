'use strict';
/*jshint node:true */
module.exports = function ( grunt ) {

	require( 'load-grunt-tasks' )( grunt );

	grunt.initConfig({
		banana: {
			all: 'i18n/'
		},
		jshint: {
			all: [
				'**/*.js',
				'!node_modules/**',
				'!vendor/**'
			]
		},
		jsonlint: {
			all: [
				'**/*.json',
				'!node_modules/**',
				'!vendor/**'
			]
		},
		clean: {
			css: {
				src: ['modules/styles.css']
			}
		},
		sass: {
			dist: {
				options: {
					style: 'nested',
					sourcemap: 'none',
					cacheLocation: 'styles/.sass-cache'
				},
				files: {
					'modules/styles.css': 'styles/decorators.scss'
				}
			}
		},
		watch: {
			css: {
				options: { livereload: true },
				files: ['styles/*.scss'],
				tasks: ['clean:css', 'sass']
			}
		}
	});

	grunt.registerTask( 'test', [ 'jsonlint', 'banana', 'jshint' ] );
	grunt.registerTask( 'default', [ 'clean', 'sass', 'test' ] );

};
