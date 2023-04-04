<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Additional in-file definitions
$routes->get('countries', 'CountriesController::index', ['as' => 'countries']);
$routes->get('countries/index', 'CountriesController::index', ['as' => 'countryIndex']);
$routes->get('countries/list', 'CountriesController::index', ['as' => 'countryList']);
$routes->get('countries/add', 'CountriesController::add', ['as' => 'newCountry']);
$routes->post('countries/add', 'CountriesController::add', ['as' => 'createCountry']);
$routes->get('countries/edit/(:any)', 'CountriesController::edit/$1', ['as' => 'editCountry']);
$routes->post('countries/edit/(:any)', 'CountriesController::edit/$1', ['as' => 'updateCountry']);
$routes->get('countries/delete/(:any)', 'CountriesController::delete/$1', ['as' => 'deleteCountry']);
$routes->get('cities/add', 'CitiesController::add', ['as' => 'newCity']);
$routes->post('cities/add', 'CitiesController::add', ['as' => 'createCity']);
$routes->resource('cities', ['namespace'  => 'App\Controllers', 'controller' => 'CitiesController']);
$routes->post('cities/(:any)/edit', 'CitiesController::edit/$1', ['as' => 'updateCity']);
$routes->get('people', 'PeopleController::index', ['as' => 'people']);
$routes->get('people/index', 'PeopleController::index', ['as' => 'personIndex']);
$routes->get('people/list', 'PeopleController::index', ['as' => 'personList']);
$routes->get('people/add', 'PeopleController::add', ['as' => 'newPerson']);
$routes->post('people/add', 'PeopleController::add', ['as' => 'createPerson']);
$routes->get('people/edit/(:num)', 'PeopleController::edit/$1', ['as' => 'editPerson']);
$routes->post('people/edit/(:num)', 'PeopleController::edit/$1', ['as' => 'updatePerson']);
$routes->get('people/delete/(:num)', 'PeopleController::delete/$1', ['as' => 'deletePerson']);


$routes->get('hrTask', 'HRTaskController::index', ['as' => 'hrTask']);
$routes->get('hrTask/index', 'HRTaskController::index', ['as' => 'hrTaskIndex']);
$routes->get('hrTask/list', 'HRTaskController::index', ['as' => 'hrTaskList']);
$routes->get('hrTask/add', 'HRTaskController::add', ['as' => 'newHRTask']);
$routes->post('hrTask/add', 'HRTaskController::add', ['as' => 'createHRTask']);
$routes->get('hrTask/edit/(:num)', 'HRTaskController::edit/$1', ['as' => 'editHRTask']);
$routes->post('hrTask/edit/(:num)', 'HRTaskController::edit/$1', ['as' => 'updateHRTask']);
$routes->get('ci4sampleapp/public/hrTask/delete/(:num)', 'HRTaskController::delete/$1', ['as' => 'deleteHRTask']);
$routes->get('hrTask/delete/(:num)', 'HRTaskController::delete/$1', ['as' => 'deleteHRTask']);


$routes->get('hrSubTask', 'HRSubTaskController::index', ['as' => 'hrSubTask']);
$routes->get('hrSubTask/index', 'HRSubTaskController::index', ['as' => 'hrSubTaskIndex']);
$routes->get('hrSubTask/list', 'HRSubTaskController::index', ['as' => 'hrSubTaskList']);
$routes->get('hrSubTask/add', 'HRSubTaskController::add', ['as' => 'newHRSubTask']);
$routes->post('hrSubTask/add', 'HRSubTaskController::add', ['as' => 'createHRSubTask']);
$routes->get('hrSubTask/edit/(:num)', 'HRSubTaskController::edit/$1', ['as' => 'editHRSubTask']);
$routes->post('hrSubTask/edit/(:num)', 'HRSubTaskController::edit/$1', ['as' => 'updateHRSubTask']);
$routes->get('ci4sampleapp/public/hrSubTask/delete/(:num)', 'HRSubTaskController::delete/$1', ['as' => 'deleteHRSubTask']);
$routes->get('hrSubTask/delete/(:num)', 'HRSubTaskController::delete/$1', ['as' => 'deleteHRSubTask']);


$routes->get('candidate', 'CandidateController::index', ['as' => 'candidate']);
$routes->get('candidate/index', 'CandidateController::index', ['as' => 'candidateIndex']);
$routes->get('candidate/list', 'CandidateController::index', ['as' => 'candidateList']);
$routes->get('candidate/add', 'CandidateController::add', ['as' => 'newCandidate']);
$routes->post('candidate/add', 'CandidateController::add', ['as' => 'createCandidate']);
$routes->get('candidate/edit/(:num)', 'CandidateController::edit/$1', ['as' => 'editCandidate']);
$routes->post('candidate/edit/(:num)', 'CandidateController::edit/$1', ['as' => 'updateCandidate']);
$routes->get('ci4sampleapp/public/candidate/delete/(:num)', 'CandidateController::delete/$1', ['as' => 'deleteCandidate']);
$routes->get('candidate/delete/(:num)', 'CandidateController::delete/$1', ['as' => 'deleteCandidate']);

$routes->get('candidateHist', 'CandidateHistController::index', ['as' => 'candidateHist']);
$routes->get('candidateHist/view/(:num)', 'CandidateHistController::view/$1', ['as' => 'candidateHistview']);



$routes->get('process', 'ProcessController::index', ['as' => 'process']);
$routes->get('process/index', 'ProcessController::index', ['as' => 'processIndex']);
$routes->get('process/list', 'ProcessController::index', ['as' => 'processList']);
$routes->get('process/add', 'ProcessController::add', ['as' => 'newProcess']);
$routes->post('process/add', 'ProcessController::add', ['as' => 'createProcess']);
$routes->get('process/edit/(:num)', 'ProcessController::edit/$1', ['as' => 'editProcess']);
$routes->post('process/edit/(:num)', 'ProcessController::edit/$1', ['as' => 'updateProcess']);
$routes->get('ci4sampleapp/public/process/delete/(:num)', 'ProcessController::delete/$1', ['as' => 'deleteProcess']);
$routes->get('process/delete/(:num)', 'ProcessController::delete/$1', ['as' => 'deleteProcess']);
//$routes->get('process/addEntries/:any/:any', 'ProcessController::addEntries/$1/$2', ['as' => 'addEntries']);
$routes->get('process/addEntries/(:num)/(:any)', 'ProcessController::addEntries/$1/$2', ['as' => 'addEntries']);




/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}