
	$( '.new_wnd' ).each( function() {
			
			$( this ).click( function(e ) {
				
				e.preventDefault();
				wnd_box = 'width=200,height=300';
				
				if ( ( new_wnd_box = $( this ).data ( 'wnd_box' ) ) !== undefined ) {
				
					wnd_box = new_wnd_box;
				}
				
				window.open ( $( this ).attr ( 'href' ), '', wnd_box  );
			});
		});