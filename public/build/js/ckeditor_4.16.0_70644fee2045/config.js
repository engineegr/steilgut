/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.contentsCss = '/build/js/ckeditor_4.16.0_70644fee2045/css/fonts.css';
	//the next line add the new font to the combobox in CKEditor
	config.font_names = "Steilgut Cormorant/steilgut_cormorant;Steilgut Opensans/steilgut_opensans;" + config.font_names;
};
