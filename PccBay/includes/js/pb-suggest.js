function pb_suggest(input, options){
	// Set Default Variables
	var defaults = $.extend({
		order: "asc",
		minchar: 3,
		showAllOnini: false,
		classPrefix: 'pb-autocomplete-',
		results: [],
		onOpen : function(input){},
		onClose : function(input){},
		onChoose: function(input, opt){}
	}, options );
	input=$(input);
	input.on('keyup', function(){
		if(defaults.showAllOnini){
			autoOptions('show', true);
		}else{
			if( input.val().length >= defaults.minchar){
				autoOptions('show');
			}else{
				autoOptions('hide');
			}
		}
	});
	$('body').on('click', '.'+defaults.classPrefix+'option', function(e){
		e.preventDefault();
		autoOptions('hide'); 
		$(input).closest('label').find('input').val( $(this).text() );
		defaults.onChoose(input, $(this).text());
	});
	var usedResults=[];
	function autoOptions(display, showall){
		if(display=='show'){
			defaults.onOpen(input);
			if( input.next().attr('class') !== defaults.classPrefix+'wrapper' ){
				$(defaults.classPrefix+'wrapper').width( input.width() )
				input.after('<div class="'+defaults.classPrefix+'wrapper"><div class="'+defaults.classPrefix+'result"><ul></ul></div></div>');
			}
			$.each( defaults.results, function( key, option ) {
				if(!showall){
					if( option.toLowerCase().indexOf( input.val().toLowerCase() ) == -1 ){  }else{
						addResult(option);
					}
				}else{
					addResult(option);
				}
			});
		}else{ input.next().remove(); usedResults=[]; defaults.onClose(input); }
	}
	function addResult(option){
		if($.inArray(option, usedResults) !== -1){  }else{
			input.next().find('ul').append('<li><a href="#" class="'+defaults.classPrefix+'option">'+option+'</a></li>');
			usedResults.push(option);
		}
	}
}