module.exports = function (grunt) {

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks("grunt-contrib-watch");

	// 変換対象のLESS名
	var arLessFileNamse = [
		'app'
	];

	// ディレクトリ等
	var arLessConfig = {};
	arLessFileNamse.forEach(function(val){
	arLessConfig[val] = {
		src:  'public_html/css/' + val + '.less',
		dest: 'public_html/css/' + val + '.css'
	};
	/*
	arLessConfig[val + 'Min'] = {
		options:{ compress:true},
		src:  'css/' + val + '.less',
		dest: 'css/' + val + '.min.css'
	};
	*/
	});
//  console.log(arLessFileNamse);
	console.log(arLessConfig);

	// setting
	grunt.initConfig({
		less: arLessConfig, 
		watch : {
			less : {
				files : ['css/*.less'],
				tasks : ['less']
			}
		}
	});

	// do task
	grunt.registerTask('default', [ 'less', 'watch']);
};
