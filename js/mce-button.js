(function() {
	tinymce.PluginManager.add('wa_qrcode', function( editor, url ) {
		var sh_tag = 'wa_qrcode';

		//helper functions 
		function getAttr(s, n) {
			n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s);
			return n ?  window.decodeURIComponent(n[1]) : '';
		};

		function html( cls, data ,con) {
                    var  ts = getAttr(data,'type');
			var placeholder = url + '/img/' + (ts =='yes'?'qrcode_shadow':'bar') + '.png';
			data = window.encodeURIComponent( data );
			content = window.encodeURIComponent( con );

			return '<img src="' + placeholder + '" class="mceItem ' + cls + '" ' + 'data-sh-attr="' + data + '" data-sh-content="'+ con+'" data-mce-resize="false" data-mce-placeholder="1" />';
		}

		function replaceShortcodes( content ) {
			return content.replace( /\[wa_qrcode([^\]]*)\]([^\]]*)\[\/wa_qrcode\]/g, function( all,attr,con) {
				return html( 'wp-wa_qrcode', attr , con);
			});
		}

		function restoreShortcodes( content ) {
			return content.replace( /(?:<p(?: [^>]+)?>)*(<img [^>]+>)(?:<\/p>)*/g, function( match, image ) {
				var data = getAttr( image, 'data-sh-attr' );
				var con = getAttr( image, 'data-sh-content' );

				if ( data ) {
					return '<p>[' + sh_tag + data + ']' + con + '[/'+sh_tag+']</p>';
				}
				return match;
			});
		}

		//add popup
		editor.addCommand('wa_barcode_panel', function(ui, v) {
			//setup defaults
			var barcodealt = '';
			if (v.barcodealt)
				barcodealt = v.barcodealt;
			var size = '';
			if (v.size)
				size = v.size;
			var type = 'default';
			if (v.type)
				type = v.type;
			var content = '';
			if (v.content)
				content = v.content;

			editor.windowManager.open( {
				title: 'QR Code Shortcode',
				body: [
					{
						type: 'textbox',
						name: 'barcodealt',
						label: 'Barcode Alt',
						value: barcodealt,
						tooltip: 'This will display on hover barcode Leave blank for none'
					},
					{
						type: 'textbox',
						name: 'size',
						label: 'Barcode Size(PX)',
						value: size,
						tooltip: 'Put Barcode Size in Px. Leave blank for none default(100) px'
					},
					{
						type: 'listbox',
						name: 'type',
						label: 'Shadow',
						value: type,
						'values': [
							{text: 'NO', value: 'No'},
							{text: 'Yes', value: 'Yes'}
							
						],
						tooltip: 'This will add shadow arround box'
					},
					{
						type: 'textbox',
						name: 'content',
						label: 'Panel Content',
						value: content,
						multiline: true,
						minWidth: 300,
						minHeight: 100
					}
				],
				onsubmit: function( e ) {
					var shortcode_str = '[' + sh_tag + ' shadow="'+e.data.type+'"';
					//check for barcodealt
					if (typeof e.data.barcodealt != 'undefined' && e.data.barcodealt.length)
						shortcode_str += ' alt="' + e.data.barcodealt + '"';
					//check for size
					if (typeof e.data.size != 'undefined' && e.data.size.length)
						shortcode_str += ' size="' + e.data.size + '"';

					//add panel content
					shortcode_str += ']' + e.data.content + '[/' + sh_tag + ']';
					//insert shortcode to tinymce
					editor.insertContent( shortcode_str);
				}
			});
	      	});

		//add button
		editor.addButton('wa_qrcode', {
			icon: 'wa_qrcode',
			tooltip: 'BootStrap Panel',
                         image: url + '/img/qrcode.png',
			onclick: function() {
				editor.execCommand('wa_barcode_panel','',{
					barcodealt : 'Scan Code',
					size : '75',
					type   : 'default',
					content: ''
				});
			}
		});

		//replace from shortcode to an image placeholder
		editor.on('BeforeSetcontent', function(event){ 
			event.content = replaceShortcodes( event.content );
		});

		//replace from image placeholder to shortcode
		editor.on('GetContent', function(event){
			event.content = restoreShortcodes(event.content);
		});

		//open popup on placeholder double click
		editor.on('DblClick',function(e) {
			var cls  = e.target.className.indexOf('wp-wa_qrcode');
			if ( e.target.nodeName == 'IMG' && e.target.className.indexOf('wp-wa_qrcode') > -1 ) {
				var title = e.target.attributes['data-sh-attr'].value;
				title = window.decodeURIComponent(title);
				console.log(title);
				var content = e.target.attributes['data-sh-content'].value;
				editor.execCommand('wa_barcode_panel','',{
					barcodealt : getAttr(title,'barcodealt'),
					size : getAttr(title,'size'),
					type   : getAttr(title,'type'),
					content: content
				});
			}
		});
	});
})();