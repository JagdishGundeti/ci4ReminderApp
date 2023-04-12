<?php  namespace App\Controllers;


use App\Models\StatusInfoModel;

use App\Models\ProcessModel;
use App\Entities\Process;

class ProcessController extends GoBaseController { 

    protected static $primaryModelName = 'ProcessModel';
    protected static $singularObjectName = 'Process';
    protected static $singularObjectNameCc = 'process';
    protected static $singularObjectNameSc = 'process';
    protected static $pluralObjectName = 'Process';
    protected static $pluralObjectNameCc = 'process';
    protected static $pluralObjectNameSc = 'process';
    protected static $controllerSlug = 'process';

    protected static $viewPath = 'processViews/';

    protected $indexRoute = 'process';

    protected $formValidationRules = [
    /*
		'notes' => 'trim|max_length[16313]',
		'first_name' => 'trim|required|max_length[40]',
		'birth_date' => 'valid_date|permit_empty',
		'email_address' => 'trim|max_length[50]|valid_email|permit_empty',
		'last_name' => 'trim|required|max_length[50]',
		'phone_number' => 'trim|max_length[20]',
		'sex' => 'trim',
		'score' => 'decimal|permit_empty',
		'middle_name' => 'trim|max_length[40]',
		'process_type' => 'max_length[31]',
    */
		];

    public function index() {

         $this->viewData['usingClientSideDataTable'] = true;
         $this->viewData['pendingAssignmnet'] = $this->primaryModel->findAllWithCities('*');
         $this->viewData['processList'] = $this->primaryModel->findAllProcessList('*');

         parent::index();

    }

    public function add() {

        $processModel = $this->primaryModel; // = new ProcessModel();

        $requestMethod = $this->request->getMethod();

        if ($requestMethod === 'post') :

            $postData = $this->request->getPost();
            $sanitizedData = [];
        
            foreach ($postData as $k => $v) :
                $sanitizationResult = goSanitize($v);
                $sanitizedData[$k] = $sanitizationResult[0];
            endforeach;

            $process = new Process($sanitizedData);
            

            $noException = true;

            $formValid = $this->canValidate();
            
            if ($formValid) :
                try {
                    $successfulResult = $processModel->save($process);
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

            // if ($formValid && !$successfulResult && !is_numeric($process->{$this->primaryModel->getPrimaryKeyName()}) && $noException) :
			if ($formValid && !$successfulResult && $noException) :
			$successfulResult = true; // Work around CodeIgniter bug returning falsy value from insert operation in case of alpha-numeric PKs
			endif;

            $thenRedirect = true;

            if ($successfulResult) :

                $insertedId = $this->primaryModel->db->insertID();
                $theId = $insertedId;

                $message = 'The ' . strtolower(static::$singularObjectName) . ' was successfully saved' . (empty($this->primaryModel::$labelField) ? 'with name <i>' . $process->{$this->primaryModel::$labelField} . '</i>' : '').'. ';
                $message .= anchor(route_to('editProcess', $theId), 'Continue editing?');

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
        
        $this->viewData['process'] = $process ?? new Process();
		$this->viewData['processTypeList'] = $this->getProcessTypeOptions();


        $this->viewData['formAction'] = route_to('createProcess');

        $this->displayForm(__METHOD__);
    }
    public function addEntries($param1, $param2) {

        $processModel = $this->primaryModel; // = new ProcessModel();
        $requestMethod = $this->request->getMethod();

		// Call the before event and check for a return
		$eventData = [
			'hr_sub_task_id' => $param1,
			'process_group_id'   => $param2,
			'process_group'   => 'CAND',
		];

        $sanitizedData = [];
        foreach ($eventData as $k => $v) :
            $sanitizationResult = goSanitize($v);
            $sanitizedData[$k] = $sanitizationResult[0];
        endforeach;
        $process = new Process($sanitizedData);

        $noException = true;

        $formValid = $this->canValidate();
        
        if ($formValid) :
            try {
                $successfulResult = $processModel->save($process);
                return $this->redirect2listView();
            } catch (\Exception $e) {
		}
        else:
            $successfulResult = false;
            $this->viewData['errorMessage'] .= "The errors on the form need to be corrected: ";
        endif;
    }

    public function edit($requestedId = null) {

        if ($requestedId == null) :
            return $this->redirect2listView();
        endif;
        $id = filter_var($requestedId, FILTER_SANITIZE_URL);
        $process = $this->primaryModel->find($id);

        if ($process == false) :
            $message = 'No such process ( with identifier ' . $id . ') was found in the database.';
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
        
            $process = $process->mergeAttributes($sanitizedData);

            $thenRedirect = true;

            if ($successfulResult) :
                //create History table and insert previous data into it
                $successfulResult = $this->primaryModel->insertCandidateIntoT2PH($id, $sanitizedData);

                $theId = $process->id;
                $message = 'The ' . strtolower(static::$singularObjectName) . (!empty($this->primaryModel::$labelField) ? ' named <b>' . $process->{$this->primaryModel::$labelField} . '</b>' : '');
                $message .= ' was successfully updated. ';
                $message .= anchor(route_to('editProcess', $theId), 'Continue editing?');

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

        $this->viewData['process'] = $process;
        $this->viewData['statusInfoList'] = $this->getStatusInfoListItems();
        $this->viewData['processTypeList'] = $this->getProcessTypeOptions();
        $this->viewData['processItem'] = $this->primaryModel->findAllProcessList('*',$requestedId);

        
        $theId = $id;
        $this->viewData['formAction'] = route_to('updateProcess', $theId);

        $this->displayForm(__METHOD__, $id);
    } // function edit(...)


	protected function getStatusInfoListItems() { 
		$statusInfoModel = new StatusInfoModel();
		$onlyActiveOnes = 1;
		//$data = $statusInfoModel->getAllForMenu('status_info_id, text','active', $onlyActiveOnes );
		$data = $statusInfoModel->getAllForMenu('status_info_id, text', $onlyActiveOnes );

		return $data;
	}


	protected function getProcessTypeOptions() { 
		$processTypeOptions = [ 
				'' => 'Please select...',
				'unspecified' => 'unspecified',
				'colleague' => 'colleague',
				'process' => 'process',
				'customer' => 'customer',
				'friend' => 'friend',
			];
		return $processTypeOptions;
	}




}
