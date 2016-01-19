module.exports = function (grunt) {
  grunt.initConfig({
    sass: {
      dist: {
        options: {
          style: 'expanded',
          maps: false
        },
        files: {
          //'css/base64-fonts.css': 'css/sass/base64-fonts.sass',
          'css/main-style.css': 'css/sass/main-style.sass',
          'css/critical.css': 'css/sass/critical.sass'
        }
      }
    },
    postcss: {
      options: {
        map: true, // inline sourcemaps
        map: {
          inline: false, // save all sourcemaps as separate files...
          annotation: '../' // ...to the specified directory
        },

        processors: [
          require('autoprefixer')({
            browsers: [
              //
              // Official browser support policy:
              // http://v4-alpha.getbootstrap.com/getting-started/browsers-devices/#supported-browsers
              //
              'Chrome >= 35', // Exact version number here is kinda arbitrary
              // Rather than using Autoprefixer's native "Firefox ESR" version specifier string,
              // we deliberately hardcode the number. This is to avoid unwittingly severely breaking the previous ESR in the event that:
              // (a) we happen to ship a new Bootstrap release soon after the release of a new ESR,
              //     such that folks haven't yet had a reasonable amount of time to upgrade; and
              // (b) the new ESR has unprefixed CSS properties/values whose absence would severely break webpages
              //     (e.g. `box-sizing`, as opposed to `background: linear-gradient(...)`).
              //     Since they've been unprefixed, Autoprefixer will stop prefixing them,
              //     thus causing them to not work in the previous ESR (where the prefixes were required).
              'Firefox >= 31', // Current Firefox Extended Support Release (ESR)
              // Note: Edge versions in Autoprefixer & Can I Use refer to the EdgeHTML rendering engine version,
              // NOT the Edge app version shown in Edge's "About" screen.
              // For example, at the time of writing, Edge 20 on an up-to-date system uses EdgeHTML 12.
              // See also https://github.com/Fyrd/caniuse/issues/1928
              'Edge >= 12',
              'Explorer >= 9',
              // Out of leniency, we prefix these 1 version further back than the official policy.
              'iOS >= 8',
              'Safari >= 8',
              // The following remain NOT officially supported, but we're lenient and include their prefixes to avoid severely breaking in them.
              'Android 2.3',
              'Android >= 4',
              'Opera >= 12'
            ]
          }),
        ]
      },
      dist: {
        src: ['css/main-style.css', 'css/critical.css']
      }
    },
    jade: {
      pretty: {
        files: {
          'index.html': ['jade/index.jade'],
          'controls.html': ['jade/controls.jade'],
          'typography.html': ['jade/typography.jade'],
          'grid.html': ['jade/grid.jade'],
          'sections.html': ['jade/sections.jade'],
          'tabs-accordion.html': ['jade/tabs-accordion.jade'],
          'media.html': ['jade/media.jade'],
          //'': [''],
        },
        options: {
          pretty: true
        }
      }
    },
    watch: {
      jade: {
        files: ['jade/*.jade', 'jade/components/*', 'jade/parts/*'],
        tasks: ['jade'],
      },
      files: ['css/sass/*.sass', 'css/sass/base/*', 'css/sass/components/*', 'css/sass/fonts/*', 'css/sass/helpers/*', 'css/sass/layout/*', 'css/sass/parts/*', 'css/sass/theme/*', 'css/sass/vendors/*'],
      tasks: ['sass', 'postcss'],
    }
  });
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-jade');
  grunt.registerTask('default', ['sass', 'postcss', 'jade', 'watch']);
}