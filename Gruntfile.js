'use strict';
/* eslint-env node */
module.exports = function ( grunt ) {

	require( 'load-grunt-tasks' )( grunt );

	grunt.initConfig( {
		banana: {
			all: 'i18n/'
		},
		eslint: {
			options: {
				cache: true
			},
			all: [
				'**/*.{js,json}',
				'!node_modules/**',
				'!vendor/**',
				'!extensions/**'
			]
		},
		clean: {
			css: {
				src: [ 'modules/styles.css' ]
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
				files: [ 'styles/*.scss' ],
				tasks: [ 'clean:css', 'sass' ]
			}
		}
	} );

	grunt.registerTask( 'test', [ 'eslint', 'banana' ] );
	grunt.registerTask( 'default', [ 'clean', 'sass', 'test' ] );

};
