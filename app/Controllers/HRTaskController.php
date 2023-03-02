<?php  namespace App\Controllers;


use App\Models\CityModel;

use App\Models\HRTaskModel;
use App\Entities\HRTask;

class HRTaskController extends GoBaseController { 

    protected static $primaryModelName = 'HRTaskModel';
    protected static $singularObjectName = 'HRTask';
    protected static $singularObjectNameCc = 'hrTask';
    protected static $singularObjectNameSc = 'hrTask';
    protected static $pluralObjectName = 'HRTask';
    protected static $pluralObjectNameCc = 'hrTask';
    protected static $pluralObjectNameSc = 'hrTask';
    protected static $controllerSlug = 'hrTask';

    protected static $viewPath = 'hrTaskViews/';

    protected $indexRoute = 'hrTask';

    protected $formValidationRules = [
		];

    public function index() {

         $this->viewData['usingClientSideDataTable'] = true;
         
		 $this->viewData['hrTaskList'] = $this->primaryModel->findAllWithCities('*');
/*
         $viewData = [
                'pageTitle' => 'HR Task',
                'pageSubTitle' => 'Manage HR Task',
                'hrTaskList' => $this->primaryModel->findAllWithCities('*'),
            ];
    
         $viewData = array_merge($this->viewData, $viewData);
*/
         parent::index();

    }

    public function add() {

        $hrTaskModel = $this->primaryModel; // = new HRTaskModel();

        $requestMethod = $this->request->getMethod();

        if ($requestMethod === 'post') :

            $postData = $this->request->getPost();
            $sanitizedData = [];
        
            foreach ($postData as $k => $v) :
                $sanitizationResult = goSanitize($v);
                $sanitizedData[$k] = $sanitizationResult[0];
            endforeach;

            $hrTask = new HRTask($sanitizedData);
            

            $noException = true;

            $formValid = $this->canValidate();
            
            if ($formValid) :
                try {
                    $successfulResult = $hrTaskModel->save($hrTask);
                } catch (\Exception $e) {
                    $noException = false;
                    $successfulResult = false;
                    $query = $this->primaryModel->db->getLastQuery()->getQuery();
                    $dbError = $this->primaryModel->db->error();
                    $userFriendlyErrMsg = 'An error occurred in an attempt to save a new '.static::$singularObjectName.' to the database : ';
                    if ($dbError['code'] == 1062) :
                        $userFriendlyErrMsg .= PHP_EOL.'There is an existing '.static::$singularObjectName.' on our database with the same data.';
                    endif;
                    $result['error'] = $userFriendlyErrMsg;
                    log_message('error', $userFriendlyErrMsg.PHP_EOL.$e->getMessage().PHP_EOL.$query);
                    if (!empty($dbError['message'])) :
                        log_message('error', $dbError['code'].' : '.$dbError['message']);
                        $result['error'] .= '<br><br>'.$dbError['code'].' : '.$dbError['message'];
                    endif;
                }
            else:
                $successfulResult = false;
                $this->viewData['errorMessage'] .= "The errors on the form need to be corrected: ";
            endif;

            // if ($formValid && !$successfulResult && !is_numeric($hrTask->{$this->primaryModel->getPrimaryKeyName()}) && $noException) :
			if ($formValid && !$successfulResult && $noException) :
			$successfulResult = true; // Work around CodeIgniter bug returning falsy value from insert operation in case of alpha-numeric PKs
			endif;

            $thenRedirect = true;

            if ($successfulResult) :

                $insertedId = $this->primaryModel->db->insertID();
                $theId = $insertedId;

                $message = 'The ' . strtolower(static::$singularObjectName) . ' was successfully saved' . (empty($this->primaryModel::$labelField) ? 'with name <i>' . $hrTask->{$this->primaryModel::$labelField} . '</i>' : '').'. ';
                $message .= anchor(route_to('editHRTask', $theId), 'Continue editing?');

                if ($thenRedirect) :
                    if (!empty($this->indexRoute)) :
                        return redirect()->to(route_to($this->indexRoute))->with('successMessage', $message);
                    else:
                        return $this->redirect2listView('successMessage', $message);
                    endif;
                else:
                    $this->viewData['successMessage'] = $message;
                endif;
            else:
                if (!$formValid) :
                    $this->viewData['errorMessage'] .= 'The ' . strtolower(static::$singularObjectName) . ' was not saved due to an erroneous value entered on the form. ';
                else:
                    $this->viewData['errorMessage'] .= 'The ' . strtolower(static::$singularObjectName) . ' was not saved because of an error. ';
                endif;
                if (!empty($result['error'])) :
                    $this->viewData['errorMessage'] = (!empty($this->viewData['errorMessage']) ? $this->viewData['errorMessage'].'<br>' : '') . $result['error'];
                endif;
            endif;
        
        endif; // ($requestMethod === 'post')
        
        $this->viewData['hrTask'] = $hrTask ?? new HRTask();
		$this->viewData['cityList'] = $this->getCityListItems();
		$this->viewData['hrTaskTypeList'] = $this->getHRTaskTypeOptions();
		$this->viewData['sexList'] = $this->getSexOptions();


        $this->viewData['formAction'] = route_to('createHRTask');

        $this->displayForm(__METHOD__);
    }

    public function edit($requestedId = null) {

        if ($requestedId == null) :
            return $this->redirect2listView();
        endif;
        $id = filter_var($requestedId, FILTER_SANITIZE_URL);
        $hrTask = $this->primaryModel->find($id);

        if ($hrTask == false) :
            $message = 'No such hrTask ( with identifier ' . $id . ') was found in the database.';
            return $this->redirect2listView("errorMessage", $message);
        endif;

        $requestMethod = $this->request->getMethod();

        if ($requestMethod === 'post') :
            $postData = $this->request->getPost();
            $sanitizedData = [];
            foreach ($postData as $k => $v) :
                $sanitizationResult = goSanitize($v);
                $sanitizedData[$k] = $sanitizationResult[0];
            endforeach;
        
            if ($this->request->getPost('enabled') == null ) {
                $sanitizedData['enabled'] = false;
            }

        
            $noException = true; // for now
        
            $formValid = $this->canValidate();

            if ($formValid) :
                try {
                    $successfulResult = $this->primaryModel->update($id, $sanitizedData);
                } catch (\Exception $e) {
                    $noException = false;
                    $successfulResult = false;
                    $query = $this->primaryModel->db->getLastQuery()->getQuery();
                    $dbError = $this->primaryModel->db->error();
                    $userFriendlyErrMsg = 'An error occurred in an attempt to update the '.static::$singularObjectName.' with ID '.$id.' to the database : ';
                    if ($dbError['code'] == 1062) :
                        $userFriendlyErrMsg .= PHP_EOL.'There is an existing '.static::$singularObjectName.' on our database with the same data.';
                    endif;
                    $result['error'] = $userFriendlyErrMsg;
                    log_message('error', $userFriendlyErrMsg.PHP_EOL.$e->getMessage().PHP_EOL.$query);
                    if (!empty($dbError['message'])) :
                        log_message('error', $dbError['code'].' : '.$dbError['message']);
                        $result['error'] .= '<br><br>'.$dbError['code'].' : '.$dbError['message'];
                    endif;
                }
            else:
                $successfulResult = false;
                $this->viewData['errorMessage'] .= "The errors on the form need to be corrected: ";
            endif;
        
            $hrTask = $hrTask->mergeAttributes($sanitizedData);

            $thenRedirect = true;

            if ($successfulResult) :
                $theId = $hrTask->id;
                $message = 'The ' . strtolower(static::$singularObjectName) . (!empty($this->primaryModel::$labelField) ? ' named <b>' . $hrTask->{$this->primaryModel::$labelField} . '</b>' : '');
                $message .= ' was successfully updated. ';
                $message .= anchor(route_to('editHRTask', $theId), 'Continue editing?');

                if ($thenRedirect) :
                    if (!empty($this->indexRoute)) :
                        return redirect()->to(route_to($this->indexRoute))->with('successMessage', $message);
                    else:
                        return $this->redirect2listView('successMessage', $message);
                    endif;
                else:
                    $this->viewData['successMessage'] = $message;
                endif;
            else: // ($successfulResult == false)
                if (!$formValid) :
                    $this->viewData['errorMessage'] .= 'The ' . strtolower(static::$singularObjectName) . ' was not saved due to an erroneous value entered on the form. ';
                else:
                    $this->viewData['errorMessage'] .= 'The ' . strtolower(static::$singularObjectName) . ' was not saved because of an error. ';
                endif;
                if (!empty($result['error'])) :
                    $this->viewData['errorMessage'] = (!empty($this->viewData['errorMessage']) ? $this->viewData['errorMessage'].'<br>' : '') . $result['error'];
                endif;
            endif; // ($successfulResult)
        endif; // ($requestMethod === 'post')

        $this->viewData['hrTask'] = $hrTask;
		//$this->viewData['cityList'] = $this->getCityListItems();
		$this->viewData['hrTaskTypeList'] = $this->getHRTaskTypeOptions();
		//$this->viewData['sexList'] = $this->getSexOptions();

        
        $theId = $id;
		$this->viewData['formAction'] = route_to('updateHRTask', $theId);

        
        $this->displayForm(__METHOD__, $id);
    } // function edit(...)

	protected function getCityListItems() { 
		$cityModel = new CityModel();
		$onlyActiveOnes = true;
		$data = $cityModel->getAllForMenu('id, city_name','city_name', $onlyActiveOnes );

		return $data;
	}



	protected function getHRTaskTypeOptions() { 
		$hrTaskTypeOptions = [ 
				'' => 'Please select...',
				'unspecified' => 'unspecified',
				'colleague' => 'colleague',
				'hrTask' => 'hrTask',
				'customer' => 'customer',
				'friend' => 'friend',
			];
		return $hrTaskTypeOptions;
	}



	protected function getSexOptions() { 
		$sexOptions = [ 
				'' => 'Please select...',
				'F' => 'Female',
				'M' => 'Male',
			];
		return $sexOptions;
	}


}
