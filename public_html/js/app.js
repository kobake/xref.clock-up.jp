jQuery(function(){
	jQuery('td').each(function(){
		var td = jQuery(this);
		var html = td.html();
		// 初期改行除去
		html = html.replace(/^\n/, "");

		// 最終改行除去
		html = html.replace(/\n\t+$/i, "");

		// 一旦配列にする
		var lines = html.split(/\n/);

		// 初期インデント -> baseIndent
		var baseIndent = '';
		if(lines.length > 0){
			var m = lines[0].match(/^\t+/);
			if(m){
				baseIndent = m[0];
			}
		}

		// 構築し直し
		var re = new RegExp("^" + baseIndent);
		html = '';
		lines.forEach(function(line){
			line = line.replace(re, "");
			line = line.replace(/\t/g, "&nbsp;&nbsp;&nbsp;&nbsp;");
			html += line + "<br/>\n";
		});

		// html = html.replace(/\n/g, "<br/>\n");
		//
		// 適用
		td.html(html);
	});
});

function mytext(str){
	return str.replace(/\t/, '&nbsp;&nbsp;&nbsp;&nbsp;');
}
