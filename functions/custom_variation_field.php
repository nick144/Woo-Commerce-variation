<?php

//Display Fields
add_action( 'woocommerce_product_after_variable_attributes', 'variable_fields', 10, 2 );
//JS to add fields for new variations
add_action( 'woocommerce_product_after_variable_attributes_js', 'variable_fields_js' );
//Save variation fields
add_action( 'woocommerce_process_product_meta_variable', 'save_variable_fields', 10, 1 );

/**
 * Create new fields for variations
 *
*/
function variable_fields( $loop, $variation_data ) {
?>
	<tr>
		<td>
			<?php
			// Text Field
			woocommerce_wp_text_input( 
				array( 
					'id'          => '_number_field['.$loop.']', 
					'label'       => __( 'Quantity', 'woocommerce' ),
					'desc_tip'    => 'true',
					'description' => __( 'Enter Variation Quantity.', 'woocommerce' ),
					'value'       => $variation_data['_number_field'][0],
					'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
								)
				)
			);
			?>
		</td>
	</tr>
	
	
	<tr>
		<td>
			<?php
			// Hidden field
			woocommerce_wp_hidden_input(
			array( 
				'id'    => '_hidden_field['.$loop.']', 
				'value' => 'hidden_value'
				)
			);
			?>
		</td>
	</tr>
<?php
}

/**
 * Create new fields for new variations
 *
*/
function variable_fields_js() {
?>
	<tr>
		<td>
			<?php
			// Number Field
			woocommerce_wp_text_input( 
				array( 
					'id'                => '_number_field[ + loop + ]', 
					'label'       		=> __( 'Quantity', 'woocommerce' ),
					'desc_tip'          => 'true',
					'description' => __( 'Enter Variation Quantity.', 'woocommerce' ),
					'value'             => $variation_data['_number_field'][0],
					'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
								) 
				)
			);
			?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php
			// Hidden field
			woocommerce_wp_hidden_input(
			array( 
				'id'    => '_hidden_field[ + loop + ]', 
				'value' => 'hidden_value'
				)
			);
			?>
		</td>
	</tr>
<?php
}

/**
 * Save new fields for variations
 *
*/
function save_variable_fields( $post_id ) {
	if (isset( $_POST['variable_sku'] ) ) :

		$variable_sku          = $_POST['variable_sku'];
		$variable_post_id      = $_POST['variable_post_id'];
		
		// Text Field
		$_text_field = $_POST['_text_field'];
		for ( $i = 0; $i < sizeof( $variable_sku ); $i++ ) :
			$variation_id = (int) $variable_post_id[$i];
			if ( isset( $_text_field[$i] ) ) {
				update_post_meta( $variation_id, '_text_field', stripslashes( $_text_field[$i] ) );
			}
		endfor;
		
		// Number Field
		$_number_field = $_POST['_number_field'];
		for ( $i = 0; $i < sizeof( $variable_sku ); $i++ ) :
			$variation_id = (int) $variable_post_id[$i];
			if ( isset( $_text_field[$i] ) ) {
				update_post_meta( $variation_id, '_number_field', stripslashes( $_number_field[$i] ) );
			}
		endfor;
		
		// Textarea
		$_textarea = $_POST['_textarea'];
		for ( $i = 0; $i < sizeof( $variable_sku ); $i++ ) :
			$variation_id = (int) $variable_post_id[$i];
			if ( isset( $_textarea[$i] ) ) {
				update_post_meta( $variation_id, '_textarea', stripslashes( $_textarea[$i] ) );
			}
		endfor;
		
		// Select
		$_select = $_POST['_select'];
		for ( $i = 0; $i < sizeof( $variable_sku ); $i++ ) :
			$variation_id = (int) $variable_post_id[$i];
			if ( isset( $_select[$i] ) ) {
				update_post_meta( $variation_id, '_select', stripslashes( $_select[$i] ) );
			}
		endfor;
		
		// Checkbox
		$_checkbox = $_POST['_checkbox'];
		for ( $i = 0; $i < sizeof( $variable_sku ); $i++ ) :
			$variation_id = (int) $variable_post_id[$i];
			if ( isset( $_checkbox[$i] ) ) {
				update_post_meta( $variation_id, '_checkbox', stripslashes( $_checkbox[$i] ) );
			}
		endfor;
		
		// Hidden field
		$_hidden_field = $_POST['_hidden_field'];
		for ( $i = 0; $i < sizeof( $variable_sku ); $i++ ) :
			$variation_id = (int) $variable_post_id[$i];
			if ( isset( $_hidden_field[$i] ) ) {
				update_post_meta( $variation_id, '_hidden_field', stripslashes( $_hidden_field[$i] ) );
			}
		endfor;
		
	endif;
}