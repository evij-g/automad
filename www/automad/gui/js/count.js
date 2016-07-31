/*
 *	                  ....
 *	                .:   '':.
 *	                ::::     ':..
 *	                ::.         ''..
 *	     .:'.. ..':.:::'    . :.   '':.
 *	    :.   ''     ''     '. ::::.. ..:
 *	    ::::.        ..':.. .''':::::  .
 *	    :::::::..    '..::::  :. ::::  :
 *	    ::'':::::::.    ':::.'':.::::  :
 *	    :..   ''::::::....':     ''::  :
 *	    :::::.    ':::::   :     .. '' .
 *	 .''::::::::... ':::.''   ..''  :.''''.
 *	 :..:::'':::::  :::::...:''        :..:
 *	 ::::::. '::::  ::::::::  ..::        .
 *	 ::::::::.::::  ::::::::  :'':.::   .''
 *	 ::: '::::::::.' '':::::  :.' '':  :
 *	 :::   :::::::::..' ::::  ::...'   .
 *	 :::  .::::::::::   ::::  ::::  .:'
 *	  '::'  '':::::::   ::::  : ::  :
 *	            '::::   ::::  :''  .:
 *	             ::::   ::::    ..''
 *	             :::: ..:::: .:''
 *	               ''''  '''''
 *	
 *
 *	AUTOMAD
 *
 *	Copyright (c) 2016 by Marc Anton Dahmen
 *	http://marcdahmen.de
 *
 *	Licensed under the MIT license.
 *	http://automad.org/license
 */


/*
 *	Count items matching a selector and replace the content of the element with the returned number. 
 */
	
+function(Automad, $) {
	
	Automad.count = {
		
		dataAttr: 'data-automad-count',
		
		get: function(e) {
			
			var	c = Automad.count;
			
			$('[' + c.dataAttr + ']').each(function(){
			
				var	$counter = $(this),
					target = $counter.data(Automad.util.dataCamelCase(c.dataAttr));
				
				$counter.text($(target).length);
				
			});
			
		}, 
		
		init: function() {
			
			var	c = Automad.count,
				$doc = $(document);
				
			$doc.on('ready ajaxComplete', c.get);	
			
		}
		
	}
	
	Automad.count.init();
	
}(window.Automad = window.Automad || {}, jQuery);