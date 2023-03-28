<?php

namespace App\Controllers;

class Home extends BaseController {

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
		$this->viewData['currentModule'] = 'Dashboard';
		parent::initController($request, $response, $logger);
	}

	/**
	* Index Page for this controller.
	*
	* @return string
	*/
	public function index() {

		$this->viewData['pageTitle'] = 'Welcome';

		$countryModel = new \App\Models\CountryModel();

		$cityModel = new \App\Models\CityModel();

		$personModel = new \App\Models\PersonModel();

		$hrTaskModel = new \App\Models\HRTaskModel();

		$this->viewData['totalNrOfCountries'] = 0;

		$this->viewData['countryList'] = 0;

		$this->viewData['totalNrOfCities'] = 0;

		$this->viewData['cityList'] = 0;

		$this->viewData['totalNrOfPeople'] = 0;

		$this->viewData['totalNrOfEmployee'] = 0;

		$this->viewData['totalNrOfHRTask'] = $hrTaskModel->getCount();

		$this->viewData['personList'] = 0;

		return view('dashboardHome', $this->viewData);
	}
}