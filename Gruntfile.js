module.exports = function (grunt) {
    grunt.initConfig({
        sass: { // Task
            dist: { // Target
                options: { // Target options
                    style: 'expanded'
                },
                files: { // Dictionary of files
                    'assets/themeclubcube-design/vendor/stylesheets/not-min/style.css': 'assets/themeclubcube-design/vendor/stylesheets/bootstrap.scss' // 'destination': 'source'
                }
            }
        },
        cssmin: {
            minify: {
                expand: true,
                cwd: 'assets/themeclubcube-design/vendor/stylesheets/not-min/',
                src: ['*.css', '!*.min.css'],
                dest: 'assets/themeclubcube-design/css/',
                ext: '.min.css'
            }
        },
        watch: {
            files: ['assets/themeclubcube-design/vendor/stylesheets/bootstrap/*', 'assets/themeclubcube-design/vendor/stylesheets/*'],
            tasks: ['sass', 'cssmin'],
        }
    });
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.registerTask('default', ['sass', 'cssmin', 'watch']);
};