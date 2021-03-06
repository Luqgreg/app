/*!
 * VisualEditor UserInterface HistoryTool classes.
 *
 * @copyright 2011-2014 VisualEditor Team and others; see http://ve.mit-license.org
 */

/**
 * UserInterface history tool.
 *
 * @class
 * @extends ve.ui.Tool
 * @constructor
 * @param {OO.ui.ToolGroup} toolGroup
 * @param {Object} [config] Configuration options
 */
ve.ui.HistoryTool = function VeUiHistoryTool( toolGroup, config ) {
	// Parent constructor
	ve.ui.Tool.call( this, toolGroup, config );

	// Events
	this.toolbar.getSurface().getModel().connect( this, { history: 'onHistory' } );

	// Initialization
	this.setDisabled( true );
};

/* Inheritance */

OO.inheritClass( ve.ui.HistoryTool, ve.ui.Tool );

/* Methods */

/**
 * @inheritdoc
 */
ve.ui.HistoryTool.prototype.onSelect = function () {
	ve.track( 'tool.history.select', { name: this.constructor.static.name } );
	ve.ui.Tool.prototype.onSelect.apply( this, arguments );
};

/**
 * Handle history events on the surface model
 */
ve.ui.HistoryTool.prototype.onHistory = function () {
	this.onUpdateState( this.toolbar.getSurface().getModel().getFragment() );
};

/**
 * @inheritdoc
 */
ve.ui.HistoryTool.prototype.destroy = function () {
	this.toolbar.getSurface().getModel().disconnect( this );
	ve.ui.HistoryTool.super.prototype.destroy.call( this );
};

/**
 * UserInterface undo tool.
 *
 * @class
 * @extends ve.ui.HistoryTool
 * @constructor
 * @param {OO.ui.ToolGroup} toolGroup
 * @param {Object} [config] Configuration options
 */
ve.ui.UndoHistoryTool = function VeUiUndoHistoryTool( toolGroup, config ) {
	ve.ui.HistoryTool.call( this, toolGroup, config );
};
OO.inheritClass( ve.ui.UndoHistoryTool, ve.ui.HistoryTool );
ve.ui.UndoHistoryTool.static.name = 'undo';
ve.ui.UndoHistoryTool.static.group = 'history';
ve.ui.UndoHistoryTool.static.icon = 'undo';
ve.ui.UndoHistoryTool.static.title =
	OO.ui.deferMsg( 'visualeditor-historybutton-undo-tooltip' );
ve.ui.UndoHistoryTool.static.commandName = 'undo';
ve.ui.toolFactory.register( ve.ui.UndoHistoryTool );

/**
 * UserInterface redo tool.
 *
 * @class
 * @extends ve.ui.HistoryTool
 * @constructor
 * @param {OO.ui.ToolGroup} toolGroup
 * @param {Object} [config] Configuration options
 */
ve.ui.RedoHistoryTool = function VeUiRedoHistoryTool( toolGroup, config ) {
	ve.ui.HistoryTool.call( this, toolGroup, config );
};
OO.inheritClass( ve.ui.RedoHistoryTool, ve.ui.HistoryTool );
ve.ui.RedoHistoryTool.static.name = 'redo';
ve.ui.RedoHistoryTool.static.group = 'history';
ve.ui.RedoHistoryTool.static.icon = 'redo';
ve.ui.RedoHistoryTool.static.title =
	OO.ui.deferMsg( 'visualeditor-historybutton-redo-tooltip' );
ve.ui.RedoHistoryTool.static.commandName = 'redo';
ve.ui.toolFactory.register( ve.ui.RedoHistoryTool );
