/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	 //Define changes to default configuration here. For example:
	 config.language = 'es';
	 config.uiColor = '#e5e5e9';
	 config.enterMode = CKEDITOR.ENTER_BR;
	 config.height = '150px';
	 //config.width = '900px';
	 config.resize_enabled = false;


	 	config.toolbar = [
		{ name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
		{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'editing', items: [ 'Find' '-', 'SelectAll', '-', 'Scayt' ] },

	
	];




};


/*
CKEDITOR.editorConfig = function( config )
{
 
config.language = 'es';
config.uiColor = '#f9f9f9';
config.skin = 'kama';
config.enterMode = CKEDITOR.ENTER_BR;
config.colorButton_colors = '4A5A73,c54747,00773d,555555';
config.height = '350px';
config.width = '600px';
config.resize_enabled = false;
 
}

*/