module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		watch: {
			css: {
				files: 'assets/css/main.scss',
				tasks: ['sass'],
				options: {
				livereload: true,
				},
			},
		},
        sass: {
            prod: {
				files: {
					'assets/css/style.css': ['assets/css/main.scss']
				}
            }
        },
		uglify: {
			prod: {
				files: {
					'assets/js/script.min.js': [
						'assets/js/convert.js',
						'assets/js/crush.js',
						'assets/js/modal.js',
						'assets/js/list.js',
						'assets/js/profile.js',
						'assets/js/anchor.js',
						//'assets/js/carousel/responsiveslides.js',
						//'assets/js/carousel/carousel.js',
						'assets/js/bookmark.js',
					],
					'assets/js/map.min.js': ['assets/js/map.js'],
				}
			}
		}
	});
    
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-uglify');

	grunt.registerTask('default', [
		'sass', 
		'uglify',
	]);
};