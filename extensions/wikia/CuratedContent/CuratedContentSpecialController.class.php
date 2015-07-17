<?php

class CuratedContentSpecialController extends WikiaSpecialPageController {
	public function __construct() {
		parent::__construct( 'CuratedContent', '', false );
	}

	public function index() {
		if ( !$this->wg->User->isAllowed( 'curatedcontent' ) ) {
			$this->displayRestrictionError();
			return false; // skip rendering
		}

		$this->response->setTemplateEngine( WikiaResponse::TEMPLATE_ENGINE_MUSTACHE );

		$title = wfMessage( 'wikiacuratedcontent-content-title' );
		$this->wg->Out->setPageTitle( $title );
		$this->wg->Out->setHTMLTitle( $title );

		$this->wg->Out->addModules( [
			'jquery.autocomplete',
			'jquery.ui.sortable',
			'wikia.yui',
			'wikia.aim'
		] );

		$assetManager = AssetsManager::getInstance();

		$styles = $assetManager->getURL( [
			'extensions/wikia/CuratedContent/css/CuratedContentManagmentTool.scss',
			'extensions/wikia/WikiaMiniUpload/css/WMU.scss'
		] );

		foreach ( $styles as $s ) {
			$this->wg->Out->addStyle( $s );
		}

		$scripts = $assetManager->getURL( [
			'/extensions/wikia/CuratedContent/js/CuratedContentManagmentTool.js',
			'/extensions/wikia/WikiaMiniUpload/js/WMU.js'
		] );

		foreach ( $scripts as $s ) {
			$this->wg->Out->addScriptFile( $s );
		}

		JSMessages::enqueuePackage( 'CuratedContentMsg', JSMessages::INLINE );

		$this->response->setVal( 'descriptions', [
			wfMessage( 'wikiacuratedcontent-content-description-items' ),
			wfMessage( 'wikiacuratedcontent-content-description-supported-items-for-sections' ),
			wfMessage( 'wikiacuratedcontent-content-description-tag-needs-image' ),
			wfMessage( 'wikiacuratedcontent-content-description-section' ),
			wfMessage( 'wikiacuratedcontent-content-description-organize' ),
			wfMessage( 'wikiacuratedcontent-content-description-no-section' ),
			wfMessage( 'wikiacuratedcontent-content-description-items-input' )
		] );

		$this->response->setVal( 'addSection', wfMessage( 'wikiacuratedcontent-content-add-section' ) );
		$this->response->setVal( 'addItem', wfMessage( 'wikiacuratedcontent-content-add-item' ) );
		$this->response->setVal( 'save', wfMessage( 'wikiacuratedcontent-content-save' ) );

		$this->response->setVal( 'section_placeholder', wfMessage( 'wikiacuratedcontent-content-section' ) );
		$this->response->setVal( 'item_placeholder', wfMessage( 'wikiacuratedcontent-content-item' ) );
		$this->response->setVal( 'name_placeholder', wfMessage( 'wikiacuratedcontent-content-name' ) );

		$itemTemplate = $this->sendSelfRequest( 'item' )->toString();
		$sectionTemplate = $this->sendSelfRequest( 'section' )->toString();


		$this->wg->Out->addJsConfigVars( [
			'itemTemplate' => $itemTemplate,
			'sectionTemplate' => $sectionTemplate
		] );

		$sections = $this->wg->WikiaCuratedContent;

		if ( !empty( $sections ) ) {
			$list = '';

			foreach ( $sections as $section ) {
				if ( isset( $section[ 'featured' ] ) && $section[ 'featured' ] ) {
					$featuredSection = $this->buildSection( $section );
				} else {
					$list .= $this->buildSection( $section );
				}
			}
			if ( !isset( $featuredSection ) ) {
				// add featured section if not yet exists
				$featuredSection = $this->sendSelfRequest( 'featuredSection' );
			}
			// prepend featured section
			$list = $featuredSection . $list;

			$this->response->setVal( 'list', $list );
		} else {
			$this->response->setVal( 'featured', $this->sendSelfRequest( 'featuredSection' ) );
			$this->response->setVal( 'section', $sectionTemplate );
			$this->response->setVal( 'item', $itemTemplate );
		}

		return true;
	}

	public function featuredSection() {
		$this->response->setTemplateEngine( WikiaResponse::TEMPLATE_ENGINE_MUSTACHE );

		$imageId = $this->request->getVal( 'image_id', 0 );

		$this->response->setVal( 'value', wfMessage( 'wikiacuratedcontent-featured-section-name' ) );
		$this->response->setVal( 'image_id', $imageId );
		$this->response->setVal( 'image_url', CuratedContentHelper::getImageUrl( $imageId ) );
		if ( $imageId != 0 ) {
			$this->response->setVal( 'image_set', true );
		}
	}

	public function section() {
		$this->response->setTemplateEngine( WikiaResponse::TEMPLATE_ENGINE_MUSTACHE );

		$imageId = $this->request->getVal( 'image_id', 0 );

		$this->response->setVal( 'value', $this->request->getVal( 'value' , '' ) );
		$this->response->setVal( 'image_id', $imageId );
		$this->response->setVal( 'image_url', CuratedContentHelper::getImageUrl( $imageId ) );
		if ( empty( $imageId ) ) {
			$this->response->setVal( 'image_set', true );
		}

		$this->response->setVal( 'section_placeholder', wfMessage( 'wikiacuratedcontent-content-section' ) );
	}

	public function item() {
		$this->response->setTemplateEngine( WikiaResponse::TEMPLATE_ENGINE_MUSTACHE );

		$imageId = $this->request->getVal( 'image_id', 0 );
		$item = $this->request->getVal( 'item_value', '' );

		$this->response->setVal( 'item_value', $item );
		$this->response->setVal( 'name_value', $this->request->getVal( 'name_value', '' ) );
		$this->response->setVal( 'image_id', $imageId );


		if ( empty( $imageId ) && !empty( $item ) ) {
			// image_id is 0 - that means it should be taken from page
			$imageId = CuratedContentHelper::getIdFromCategoryName( $item );
		} else {
			$this->response->setVal( 'image_set', true );
		}

		$this->response->setVal( 'image_url', CuratedContentHelper::getImageUrl( $imageId ) );
		$this->response->setVal( 'item_placeholder', wfMessage( 'wikiacuratedcontent-content-item' ) );
		$this->response->setVal( 'name_placeholder', wfMessage( 'wikiacuratedcontent-content-name' ) );
	}

	public function save() {
		if ( !$this->wg->User->isAllowed( 'curatedcontent' ) ) {
			$this->displayRestrictionError();
			return false; // skip rendering
		}
		$this->response->setFormat( 'json' );

		$helper = new CuratedContentHelper();

		$sections = $helper->processLogic( $this->request->getArray( 'sections' ) );
		$errors = ( new CuratedContentValidator( $sections ) )->getErrors();


		if ( !empty( $errors ) ) {
			$this->response->setVal( 'error', $errors );
		} else {
			$status = WikiFactory::setVarByName( 'wgWikiaCuratedContent', $this->wg->CityId, $sections );
			$this->response->setVal( 'status', $status );

			if ( $status ) {
				wfRunHooks( 'CuratedContentSave', [ $sections ] );
			}
		}
		return true;
	}

	private function buildSection( $section ) {
		$result = '';
		$sectionTemplate = 'section';
		if ( isset( $section[ 'featured' ] ) && $section[ 'featured' ] ) {
			$sectionTemplate = 'featuredSection';
		}
		$result .= $this->sendSelfRequest( $sectionTemplate, [
			'value' => $section[ 'title' ],
			'image_id' => $section[ 'image_id' ]
		] );
		if ( !empty( $section[ 'items' ] ) ) {
			foreach ( $section[ 'items' ] as $item ) {
				$result .= $this->sendSelfRequest( 'item', [
					'item_value' => $item[ 'title' ],
					'name_value' => !empty( $item[ 'label' ] ) ? $item[ 'label' ] : '',
					'image_id' => $item[ 'image_id' ]
				] );
			}
		}
		return $result;
	}

	public function getImage() {
		$file = $this->request->getVal( 'file', '' );
		$url = '';
		$imageId = 0;

		if ( !empty( $file ) ) {
			$imageTitle = Title::newFromText( $file );

			if ( !empty( $imageTitle ) && $imageTitle instanceof Title && $imageTitle->exists() ) {
				$imageId = $imageTitle->getArticleID();
			}
		}

		if ( !empty( $imageId ) ) {
			$url = CuratedContentHelper::getImageUrl( $imageId );
		}

		$this->response->setVal( 'url', $url );
		$this->response->setVal( 'id', $imageId );
	}
}
