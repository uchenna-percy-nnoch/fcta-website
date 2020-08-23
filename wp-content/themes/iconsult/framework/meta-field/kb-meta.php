<?php
/*-----------------------------------------------------------------------------------*/
/*	 KNOWLEDGE BASE 
/*-----------------------------------------------------------------------------------*/

add_action( 'cmb2_admin_init', 'iconsult__kb_attachment' );
function iconsult__kb_attachment() {

    $prefix = '__iconsult_';

    $cmb = new_cmb2_box( array(
        'id'            => 'page_kb_attachment',
        'title'         => esc_html__( 'Attached Files', 'iconsult' ),
        'object_types'  => array( 'iconsult_kb', ), 
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ) );
	
	$cmb->add_field( array(
	    'name'    => esc_html__( 'Allow attached files access to only login users', 'iconsult' ),
		'id'      => $prefix.'attachement_access_status',
		'desc' => 'If checked only login users can download attachment',
		'type'    => 'checkbox',
	) );

	$cmb->add_field( array(
	    'name'    => esc_html__( 'Login Message', 'iconsult' ),
		'desc' => 'Your short description',
		'id'      => $prefix.'attachement_access_login_msg',
		'type'    => 'text',
	) );

	
	$bind_attachment_field_id = $cmb->add_field( array(
		'id'          => $prefix.'page_kb_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'File {#}', 'iconsult' ), 
			'add_button'    => esc_html__( 'Add Another File', 'iconsult' ),
			'remove_button' => esc_html__( 'Remove Add File', 'iconsult' ),
			'sortable'      => true, // beta
			'closed'        => true, // true to have the groups closed by default
		),
	) );
	
	$cmb->add_group_field( $bind_attachment_field_id, array(
		'name' => esc_html__( 'Upload Files/Image', 'iconsult' ), 
		'id'   => 'image',
		'type' => 'file',
	) );


}

?>