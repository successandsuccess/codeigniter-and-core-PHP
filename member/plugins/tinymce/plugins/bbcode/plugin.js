/**
 * plugin.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/*global tinymce:true */

(function() {
	tinymce.create('tinymce.plugins.BBCodePlugin', {
		init: function(ed) {
			var self = this, dialect = ed.getParam('bbcode_dialect', 'punbb').toLowerCase();

			ed.on('beforeSetContent', function(e) {
				e.content = self['_' + dialect + '_bbcode2html'](e.content);
			});

			ed.on('postProcess', function(e) {
				if (e.set) {
					e.content = self['_' + dialect + '_bbcode2html'](e.content);
				}

				if (e.get) {
					e.content = self['_' + dialect + '_html2bbcode'](e.content);
				}
			});
		},

		getInfo: function() {
			return {
				longname: 'BBCode Plugin',
				author: 'Ephox Corp',
				authorurl: 'http://www.tinymce.com',
				infourl: 'http://www.tinymce.com/wiki.php/Plugin:bbcode'
			};
		},

		// Private methods

		// HTML -> BBCode in PunBB dialect
		_punbb_html2bbcode: function(s) {
			s = tinymce.trim(s);

			function rep(re, str) {
				s = s.replace(re, str);
			}

			// example: <strong> to [b]
			rep(/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/gi, "[url=$1]$2[/url]");
			rep(/<font.*?color=\"(.*?)\".*?class=\"codeStyle\".*?>(.*?)<\/font>/gi, "[code][color=$1]$2[/color][/code]");
			rep(/<font.*?color=\"(.*?)\".*?class=\"quoteStyle\".*?>(.*?)<\/font>/gi, "[quote][color=$1]$2[/color][/quote]");
			rep(/<font.*?class=\"codeStyle\".*?color=\"(.*?)\".*?>(.*?)<\/font>/gi, "[code][color=$1]$2[/color][/code]");
			rep(/<font.*?class=\"quoteStyle\".*?color=\"(.*?)\".*?>(.*?)<\/font>/gi, "[quote][color=$1]$2[/color][/quote]");
			rep(/<span style=\"color: ?(.*?);\">(.*?)<\/span>/gi, "[color=$1]$2[/color]");
			rep(/<font.*?color=\"(.*?)\".*?>(.*?)<\/font>/gi, "[color=$1]$2[/color]");
			rep(/<span style=\"font-size:(.*?);\">(.*?)<\/span>/gi, "[size=$1]$2[/size]");
			rep(/<font>(.*?)<\/font>/gi, "$1");
			rep(/<img.*?src=\"(.*?)\".*?\/>/gi, "[img]$1[/img]");
			rep(/<span class=\"codeStyle\">(.*?)<\/span>/gi, "[code]$1[/code]");
			rep(/<span class=\"quoteStyle\">(.*?)<\/span>/gi, "[quote]$1[/quote]");
			rep(/<strong class=\"codeStyle\">(.*?)<\/strong>/gi, "[code][b]$1[/b][/code]");
			rep(/<strong class=\"quoteStyle\">(.*?)<\/strong>/gi, "[quote][b]$1[/b][/quote]");
			rep(/<em class=\"codeStyle\">(.*?)<\/em>/gi, "[code][i]$1[/i][/code]");
			rep(/<em class=\"quoteStyle\">(.*?)<\/em>/gi, "[quote][i]$1[/i][/quote]");
			rep(/<u class=\"codeStyle\">(.*?)<\/u>/gi, "[code][u]$1[/u][/code]");
			rep(/<u class=\"quoteStyle\">(.*?)<\/u>/gi, "[quote][u]$1[/u][/quote]");
			rep(/<\/(strong|b)>/gi, "[/b]");
			rep(/<(strong|b)>/gi, "[b]");
			rep(/<\/(em|i)>/gi, "[/i]");
			rep(/<(em|i)>/gi, "[i]");
			rep(/<\/u>/gi, "[/u]");
			rep(/<span style=\"text-decoration: ?underline;\">(.*?)<\/span>/gi, "[u]$1[/u]");
			rep(/<u>/gi, "[u]");
			rep(/<blockquote[^>]*>/gi, "[quote]");
			rep(/<\/blockquote>/gi, "[/quote]");
			rep(/<br \/>/gi, "\n");
			rep(/<br\/>/gi, "\n");
			rep(/<br>/gi, "\n");
			rep(/<p>/gi, "");
			rep(/<\/p>/gi, "\n");
			rep(/&nbsp;|\u00a0/gi, " ");
			rep(/&quot;/gi, "\"");
			rep(/&lt;/gi, "<");
			rep(/&gt;/gi, ">");
			rep(/&amp;/gi, "&");

			return s;
		},

		// BBCode -> HTML from PunBB dialect
		_punbb_bbcode2html: function(s) {
			s = tinymce.trim(s);

			function rep(re, str) {
				s = s.replace(re, str);
			}

			// example: [b] to <strong>
			rep(/\n/gi, "<br />");
			rep(/\[b\]/gi, "<strong>");
			rep(/\[\/b\]/gi, "</strong>");
			rep(/\[i\]/gi, "<em>");
			rep(/\[\/i\]/gi, "</em>");
			rep(/\[u\]/gi, "<u>");
			rep(/\[\/u\]/gi, "</u>");
			rep(/\[url=([^\]]+)\](.*?)\[\/url\]/gi, "<a href=\"$1\">$2</a>");
			rep(/\[url\](.*?)\[\/url\]/gi, "<a href=\"$1\">$1</a>");
			rep(/\[img\](.*?)\[\/img\]/gi, "<img src=\"$1\" />");
			rep(/\[color=(.*?)\](.*?)\[\/color\]/gi, "<font color=\"$1\">$2</font>");
			rep(/\[code\](.*?)\[\/code\]/gi, "<span class=\"codeStyle\">$1</span>&nbsp;");
			rep(/\[quote.*?\](.*?)\[\/quote\]/gi, "<span class=\"quoteStyle\">$1</span>&nbsp;");

			return s;
		}
	});

	// Register plugin
	tinymce.PluginManager.add('bbcode', tinymce.plugins.BBCodePlugin);
})();