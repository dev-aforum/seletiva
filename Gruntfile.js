module.exports = function(grunt){

  'use strict';


  grunt.initConfig({

    // php files
    copy: {
      target: {
        files: [{
          expand: true,
          cwd: 'dev',
          src: '**/*.php',
          dest: 'built'
        }]
      }
    },

    clean: {
      src:'built/*.php'
    },

    // javascrpit
    jshint: {
      all: ['Gruntfile.js', 'dev/js/*.js']
    },
    uglify: {
      js: {
        files:{
          'built/indexR.js':'dev/indexR.js'
        }
      }
    },
    concat: {
      js: {
        src: 'dev/js/*.js',
        dest: 'dev/indexR.js'
      },

    // css
      css: {
        src: 'dev/styles/scss/*.scss',
        dest: 'dev/styles/index.scss'
      }
    },
    sass: {
      dist: {
        files: {
          'built/styles/index.css':'dev/styles/index.scss'
        }
       }
    },
    cssmin:{
      target:{
        'built/styles/index.css':'built/index.css'
      }
    },

    // watch
    watch: {
      options:{
        livereload: true
      },
			js: {
        files: ['dev/js/*.js','Gruntfile.js'],
        tasks: ['js'],
      },
      css: {
        files: ['dev/styles/scss/*.scss'],
        tasks: ['css'],
      },
      markup: {
        files: ['dev/**/*.php'],
        tasks: ['markup'],
      },
      images: {
        files: ['dev/img/*.{jpg,png,gif}'],
        tasks: ['imagemin','copy:images']
      }
    },

    // server
    connect: {
      server:{
        options: {
          port: 11000,
          base: "built",
          hostname: "localhost",
          livereload: true,
          open: true
        },
      }
    },


  });

  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-connect');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-cssmin');

  grunt.registerTask('markup',['clean','copy:target']);
  grunt.registerTask('js',['concat:js','uglify:js']);
  grunt.registerTask('css',['concat:css','sass','cssmin']);


  grunt.registerTask('server',['connect','watch']);

};
