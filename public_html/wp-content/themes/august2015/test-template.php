add_filter( 'template_include', 'portfolio_page_template', 99 );

function portfolio_page_template( $template ) {

	if ( is_page( 'portfolio' )  ) {
		$new_template = locate_template( array( 'portfolio-page-template.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}
	}

	return $template;
}