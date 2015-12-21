module.exports = function (grunt) {
    grunt.initConfig({
        sass: {
            dist: {
                options: {
                    style: 'expanded',
                    maps: false
                },
                files: {
                    '../not-min/main-style.css': 'main-style.sass',
                    '../not-min/critical.css': 'critical.sass',
                    '../not-min/base64-fonts.css': 'base64-fonts.sass',
                }
            }
        },
        postcss: {
            options: {
                map: {
                    inline: false,
                    annotation: '../not-min/'
                },
                processors: [
                    require('autoprefixer')({
                        browsers: 'last 2 versions'
                    })
                ]
            },
            dist: {
                src: ['../not-min/style.css', '../not-min/critical.css']
            }
        },
        jade: {
            pretty: {
                files: {
                    '../../index.html': ['../../jade/index.jade']
                },
                options: {
                    pretty: true
                }
            }
        },
        watch: {
            jade: {
                files: ['../../jade/*.jade', '../../jade/components/*', '../../jade/parts/*'],
                tasks: ['jade'],
            },
            files: ['main-style.sass', 'critical.sass', 'base64-fonts.sass', 'base/*', 'components/*', 'fonts/*', 'helpers/*', 'layout/*', 'parts/*', 'theme/*', 'vendors/*'],
            tasks: ['sass', 'postcss'],
        }
    });
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-jade');
    grunt.registerTask('default', ['sass', 'postcss', 'jade', 'watch']);
}