<?php

class SkinSFWikiDarkVector extends SkinDarkVector {
	public $skinname = 'sfwikidarkvector';
	public $stylename = 'SFWikiDarkVector';
	public $template = 'SFWikiDarkVectorTemplate';
	/**
	 * @var Config
	 */
	private $sfwikidarkvectorConfig;
	private $darkvectorConfig;
	
	
	public function __construct( $options ) 
	{
		$this->darkvectorConfig = ConfigFactory::getDefaultInstance()->makeConfig( 'darkvector' );
		$this->sfwikidarkvectorConfig = ConfigFactory::getDefaultInstance()->makeConfig( 'sfwikidarkvector' );
		$options['bodyOnly'] = true;
		parent::__construct( $options );
	}
	
	
	public function initPage( OutputPage $out )
	{
		parent::initPage( $out );
		global $wgLang,$wgSitename,$wgLanguageCode,$wgCategoryTreeSidebarRoot;
		
		if ( $this->darkvectorConfig->get( 'DarkVectorResponsive' ) ) {
			$out->addMeta( 'viewport', 'width=device-width, initial-scale=1' );
			$out->addModuleStyles( 'skins.sfwikidarkvector.styles.responsive' );
		}
		
		$out->addModules( array( 'skins.sfwikidarkvector.js' ) );
	}
	
	
	public function getDefaultModules()
	{
		$modules = parent::getDefaultModules();
		
		$styles = array( 'mediawiki.skinning.interface', 'skins.darkvector.styles', 'skins.sfwikidarkvector.styles' );
		
		$this->getHookContainer()->run( 'SkinDarkVectorStyleModules', array( $this, &$styles ) );
		
		$modules['styles']['skin'] = $styles;
		return $modules;
	}
	
	
	public function setupTemplate( $classname, $repository = false, $cache_dir = false )
	{
		return new $classname( $this->sfwikidarkvectorConfig );
	}
	
};