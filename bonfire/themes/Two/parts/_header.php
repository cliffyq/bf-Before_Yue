<?php
// Setup our default assets to load.
Assets::add_js( 'bootstrap.min.js' );
Assets::add_css( array('bootstrap.css', 'bootstrap-responsive.css','main.css'));

$inline  = '$(".dropdown-toggle").dropdown();';
$inline .= '$(".tooltips").tooltip();';
$inline .= '$(".login-btn").click(function(e){ e.preventDefault(); $("#modal-login").modal(); });';

Assets::add_js( $inline, 'inline' );

Template::block('header', 'parts/head');

Template::block('topbar', 'parts/topbar');
?>
