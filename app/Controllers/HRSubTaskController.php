<?php  namespace App\Controllers;


use App\Models\CityModel;

use App\Models\HRSubTaskModel;
use App\Entities\HRSubTask;

class HRSubTaskController extends GoBaseController { 

    protected static $primaryModelName = 'HRSubTaskModel';
    protected static $singularObjectName = 'HRSubTask';
    protected static $singularObjectNameCc = 'hrSubTask';
    protected static $singularObjectNameSc = 'hrSubTask';
    protected static $pluralObjectName = 'HRSubTask';
    protected static $pluralObjectNameCc = 'hrSubTask';
    protected static $pluralObjectNameSc = 'hrSubTask';
    protected static $controllerSlug = 'hrSubTask';

    protected static $viewPath = 'hrSubTaskViews/';

    protected $indexRoute = 'hrSubTask';

    protected $formValidationRules = [
		];

    public function index() {

         $this->viewData['usingClientSideDataTable'] = true;
         
		 $this->viewData['hrSubTaskList'] = $this->primaryModel->findAllWithCities('*');
/*
         $viewData = [
                'pageTitle' => 'HR Task',
                'pageSubTitle' => 'Manage HR Task',
                'hrSubTaskList' => $this->primaryModel->findAllWithCities('*'),
            ];
    
         $viewData = array_merge($this->viewData, $viewData);
*/
         parent::index();

    }

    public function add() {

        $HRSubTaskModel = $this->primaryModel; // = new HRSubTaskModel();

        $requestMethod = $this->request->getMethod();

        if ($requestMethod === 'post') :

            $postData = $this->request->getPost();
            $sanitizedData = [];
        
            foreach ($postData as $k => $v) :
                $sanitizationResult = goSanitize($v);
                $sanitizedData[$k] = $sanitizationResult[0];
            endforeach;

            $hrSubTask = new HRSubTask($sanitizedData);
            

            $noException = true;

            $formValid = $this->canValidate();
            
            if ($formValid) :
                try {
                    $successfulResult = $HRSubTaskModel->save($hrSubTask);
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

            // if ($formValid && !$successfulResult && !is_numeric($hrSubTask->{$this->primaryModel->getPrimaryKeyName()}) && $noException) :
			if ($formValid && !$successfulResult && $noException) :
			$successfulResult = true; // Work around CodeIgniter bug returning falsy value from insert operation in case of alpha-numeric PKs
			endif;

            $thenRedirect = true;

            if ($successfulResult) :

                $insertedId = $this->primaryModel->db->insertID();
                $theId = $insertedId;

                $message = 'The ' . strtolower(static::$singularObjectName) . ' was successfully saved' . (empty($this->primaryModel::$labelField) ? 'with name <i>' . $hrSubTask->{$this->primaryModel::$labelField} . '</i>' : '').'. ';
                $message .= anchor(route_to('editHRSubTask', $theId), 'Continue editing?');

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
        
        $this->viewData['hrSubTask'] = $hrSubTask ?? new HRSubTask();
		$this->viewData['cityList'] = $this->getCityListItems();
		$this->viewData['hrSubTaskTypeList'] = $this->getHRSubTaskTypeOptions();
		$this->viewData['sexList'] = $this->getSexOptions();


        $this->viewData['formAction'] = route_to('createHRSubTask');

        $this->displayForm(__METHOD__);
    }

    public function edit($requestedId = null) {

        if ($requestedId == null) :
            return $this->redirect2listView();
        endif;
        $id = filter_var($requestedId, FILTER_SANITIZE_URL);
        $hrSubTask = $this->primaryModel->find($id);

        if ($hrSubTask == false) :
            $message = 'No such hrSubTask ( with identifier ' . $id . ') was found in the database.';
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
        
            $hrSubTask = $hrSubTask->mergeAttributes($sanitizedData);

            $thenRedirect = true;

            if ($successfulResult) :
                $theId = $hrSubTask->id;
                $message = 'The ' . strtolower(static::$singularObjectName) . (!empty($this->primaryModel::$labelField) ? ' named <b>' . $hrSubTask->{$this->primaryModel::$labelField} . '</b>' : '');
                $message .= ' was successfully updated. ';
                $message .= anchor(route_to('editHRSubTask', $theId), 'Continue editing?');

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

        $this->viewData['hrSubTask'] = $hrSubTask;
		//$this->viewData['cityList'] = $this->getCityListItems();
		$this->viewData['hrSubTaskTypeList'] = $this->getHRSubTaskTypeOptions();
		//$this->viewData['sexList'] = $this->getSexOptions();

        
        $theId = $id;
		$this->viewData['formAction'] = route_to('updateHRSubTask', $theId);

        
        $this->displayForm(__METHOD__, $id);
    } // function edit(...)

	protected function getCityListItems() { 
		$cityModel = new CityModel();
		$onlyActiveOnes = true;
		$data = $cityModel->getAllForMenu('id, city_name','city_name', $onlyActiveOnes );

		return $data;
	}



	protected function getHRSubTaskTypeOptions() { 
		$hrSubTaskTypeOptions = [ 
				'' => 'Please select...',
				'unspecified' => 'unspecified',
				'colleague' => 'colleague',
				'hrSubTask' => 'hrSubTask',
				'customer' => 'customer',
				'friend' => 'friend',
			];
		return $hrSubTaskTypeOptions;
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
