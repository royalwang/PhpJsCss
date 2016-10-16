// enable plugins
// Enable local "newplugin" plugin from plugins/newplugin folder.
CKEDITOR.plugins.addExternal( 'youtube', 'plugins/youtube/', 'plugin.js' );
CKEDITOR.plugins.addExternal( 'videodetector', 'plugins/videodetector/', 'plugin.js' );
//CKEDITOR.plugins.addExternal( 'widget', 'plugins/widget/', 'plugin.js' );
//CKEDITOR.plugins.addExternal( 'dialog', 'plugins/dialog/', 'plugin.js' );
//CKEDITOR.plugins.addExternal( 'codesnippet', 'plugins/codesnippet/', 'plugin.js' );

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//config.extraPlugins = 'youtube,videodetector,widget,dialog,codesnippet';
	config.extraPlugins = 'youtube,videodetector';
};
