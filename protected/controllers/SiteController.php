<?php


class SiteController extends Controller
{
	const PAGE_SIZE=12;		// # of houses per page
	const MAX_PAGE_SIZE=25; // API returns MAX 25 objects per request 
	const START_PAGE=1;    
	
	/* 
	 * Some handy variables 
	 */
	public $pNumber; 		// $pageNumber is a reserved variable name
	public $totalPages;		
	public $totalObjects;
	public $apiURL;
	public $cacheFile;
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	/*
	 * Displays the Map
	 */
	public function actionShowMap($center, $adres)
	{
		$this->renderPartial('_map',array(
	        'center'=>$center,
	        'adres'=>$adres
	    ));
	}
	
	/*
	 * Displays the Image of the Map in the JS tooltip
	 */
	public function actionShowImageMap($center, $adres)
	{
		$this->renderPartial('_map_image',array(
	        'center'=>$center,
	        'adres'=>$adres
	    ));
	}
	
	/*
	 * Handles the API parameters request
	 */ 
	public function actionloadAPIResponse($page=self::START_PAGE, $filter=null)
	{
		$data = array();
		$data['page'] = $page;
		if(isset($filter)) $data['filter'] = $filter;
		
		$objects = self::apiRequest($data);
	
		$myhouses=House::getMyHouses();
		
		$this->renderPartial('_objects',array(
	        'objects'=>$objects,
	        'page'=>$this->pNumber,
	        'myhouses'=>$myhouses
	    ));
	}
	
	/*
	 * Performs the API Request 
	 */ 
	private function apiRequest($data = array())
	{
		/*
		 * API Request Parameters
		 */ 
		$plaatsnaam = isset($data['plaatsnaam']) ? $data['plaatsnaam'] : "amsterdam" ;
		$filter     = isset($data['filter'])     ? $data['filter']     : null ;
		$page       = isset($data['page'])       ? $data['page']       : self::START_PAGE ;
		$pagesize   = isset($data['pagesize'])   ? $data['pagesize']   : self::PAGE_SIZE ;
		
		/*
		 * Construct the API URL
		 */ 
		//$apiURL="http://partnerapi.funda.nl/feeds/Aanbod.svc/json/a001e6c3ee6e4853ab18fe44cc1494de/?type=koop&zo=/amsterdam/tuin/&page=1&pagesize=25";
		$apiURL = $this->getBaseAPIurl();         								// http://partnerapi.funda.nl/feeds/Aanbod.svc/
		$apiURL .= $this->getResponseType();      								// json
		$apiURL .= "/" . $this->getAPIToken();   								// /a001e6c3ee6e4853ab18fe44cc1494de
		$apiURL .= "/?" . $this->getSearchOptions($plaatsnaam, $filter) . "/"; // /?type=koop&zo=/amsterdam/tuin/
		$apiURL .= "&" . $this->getPageNumber($page); 							// &page=1
		$apiURL .= "&" . $this->getPageSize($pagesize);     					// &pagesize=25
		
		/*	to create a cache of the API Data we need to  create a cache file per each kind of API call */
		// $apiData = file_get_contents($apiURL);
		// type=koop&zo=/amsterdam/tuin/&page=1&pagesize=25
		// type_koop_zo_amsterdam_tuin_page_1_pagesize_25
		// api_data_type_koop_zo_amsterdam_tuin_page_1_pagesize_25.json
		$regex = "/[^a-zA-Z0-9 ]/";
		$cacheFile = 'cache/';
		$cacheFile .=  preg_replace($regex, "_",  $this->getSearchOptions($plaatsnaam, $filter)); 
		$cacheFile .= preg_replace($regex, "_",  $this->getPageNumber($page)); 
		$cacheFile .= preg_replace($regex, "_",  $this->getPageSize($pagesize)); 
		$cacheFile .= '.json';
		
		$cacheFor = 60; // cache results for * minutes
		
		$apiCache = new APICache($apiURL, $cacheFor, $cacheFile); // Instantiates the class APICache (Components)
		
		$apiData = $apiCache->get_api_cache();

		$jsonData = json_decode($apiData);
		$objects = $jsonData->Objects;
		
		/*
		 * Set the handy variables
		 */ 
		$this->pNumber  = $jsonData->Paging->HuidigePagina;
		$this->totalPages   = $jsonData->Paging->AantalPaginas;
		$this->totalObjects = $jsonData->TotaalAantalObjecten;
		$this->apiURL = $apiURL;
		$this->cacheFile = $cacheFile;
	
		return $objects;
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$objects = self::apiRequest();
		
		$this->render('index',array(
	        'objects'=>$objects,
	        'page'=>$this->pNumber
	    ));
	}
	
	private function getBaseAPIurl()
	{
		return 	"http://example.com/api";
	}
	
	private function getResponseType($type = "json")
	{
		// this version of API Funda Web Application only supports json
		return ($type == "json") ? "json" : ""; 
	}
	
	private function getAPIToken()
	{
		return "I will tell you later";
	}
	
	private function getPageNumber($page = self::START_PAGE)
	{
		return "page=" . $page;
	}
	
	private function getPageSize($pageSize = self::PAGE_SIZE)
	{
		return ($pageSize > self::MAX_PAGE_SIZE) ? "pagesize=" . self::MAX_PAGE_SIZE : "pagesize=" . $pageSize;
	}
	
	private function getLocation($location = "amsterdam")
	{
		// this version of API Funda Web Application only supports amsterdam as a location
		return $location;
	}
	
	private function getSearchOptions($location = "amsterdam", $zo = "")
	{
		$q = "type=koop&zo=/" . $this->getLocation($location);
		if(!empty($zo)) return $q .= "/" . $zo;
		return $q;
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}