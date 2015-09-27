module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // Compiling sass
    sass: {
      dist: {
        files: {
          'assets/css/main.css': 'assets/sass/main.scss'
        }
      }
    },

    // compiling when changes happens in sass files
    watch: {
      sass: {
        files: ['assets/sass/**/*'],
        tasks: ['sass'],
      },
    },

  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');

};
