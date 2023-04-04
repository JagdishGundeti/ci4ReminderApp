<?php  namespace App\Controllers;

use App\Models\CandidateHistModel;
use App\Entities\CandidateHist;

class CandidateHistController extends GoBaseController { 

    protected static $primaryModelName = 'CandidateHistModel';
    protected static $singularObjectName = 'CandidateHist';
    protected static $singularObjectNameCc = 'candidateHist';
    protected static $singularObjectNameSc = 'candidateHist';
    protected static $pluralObjectName = 'CandidateHist';
    protected static $pluralObjectNameCc = 'candidateHist';
    protected static $pluralObjectNameSc = 'candidateHist';
    protected static $controllerSlug = 'candidateHist';

    protected static $viewPath = 'candidateHistViews/';

    protected $indexRoute = 'candidateHist';

    protected $formValidationRules = [

		];

    public function index() {

         $this->viewData['usingClientSideDataTable'] = true;
         
		 $this->viewData['candidateHistList'] = $this->primaryModel->findAllCandidates('*');

         parent::index();

    }

    public function add() {

        $candidateHistModel = $this->primaryModel; // = new CandidateHistModel();

        $requestMethod = $this->request->getMethod();

        if ($requestMethod === 'post') :

            $postData = $this->request->getPost();
            $sanitizedData = [];
        
            foreach ($postData as $k => $v) :
                $sanitizationResult = goSanitize($v);
                $sanitizedData[$k] = $sanitizationResult[0];
            endforeach;

            $candidateHist = new CandidateHist($sanitizedData);
            

            $noException = true;

            $formValid = $this->canValidate();
            
            if ($formValid) :
                try {
                    $successfulResult = $candidateHistModel->save($candidateHist);
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

            // if ($formValid && !$successfulResult && !is_numeric($candidateHist->{$this->primaryModel->getPrimaryKeyName()}) && $noException) :
			if ($formValid && !$successfulResult && $noException) :
			$successfulResult = true; // Work around CodeIgniter bug returning falsy value from insert operation in case of alpha-numeric PKs
			endif;

            $thenRedirect = true;

            if ($successfulResult) :

                $insertedId = $this->primaryModel->db->insertID();
                $theId = $insertedId;

                $message = 'The ' . strtolower(static::$singularObjectName) . ' was successfully saved' . (empty($this->primaryModel::$labelField) ? 'with name <i>' . $candidateHist->{$this->primaryModel::$labelField} . '</i>' : '').'. ';
                $message .= anchor(route_to('editCandidateHist', $theId), 'Continue editing?');

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
        
        $this->viewData['candidateHist'] = $candidateHist ?? new CandidateHist();
		$this->viewData['candidateHistTypeList'] = $this->getCandidateHistTypeOptions();


        $this->viewData['formAction'] = route_to('createCandidateHist');

        $this->displayForm(__METHOD__);
    }

    public function edit($requestedId = null) {

        if ($requestedId == null) :
            return $this->redirect2listView();
        endif;
        $id = filter_var($requestedId, FILTER_SANITIZE_URL);
        $candidateHist = $this->primaryModel->find($id);

        if ($candidateHist == false) :
            $message = 'No such candidateHist ( with identifier ' . $id . ') was found in the database.';
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
        
            $candidateHist = $candidateHist->mergeAttributes($sanitizedData);

            $thenRedirect = true;

            if ($successfulResult) :
                $theId = $candidateHist->id;
                $message = 'The ' . strtolower(static::$singularObjectName) . (!empty($this->primaryModel::$labelField) ? ' named <b>' . $candidateHist->{$this->primaryModel::$labelField} . '</b>' : '');
                $message .= ' was successfully updated. ';
                $message .= anchor(route_to('editCandidateHist', $theId), 'Continue editing?');

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

        $this->viewData['candidateHist'] = $candidateHist;
		$this->viewData['candidateHistTypeList'] = $this->getCandidateHistTypeOptions();

        
        $theId = $id;
		$this->viewData['formAction'] = route_to('updateCandidateHist', $theId);

        
        $this->displayForm(__METHOD__, $id);
    } // function edit(...)
    public function view($requestedId = null) {

        if ($requestedId == null) :
            return $this->redirect2listView();
        endif;
        
        
         $this->viewData['usingClientSideDataTable'] = true;
         
		 $this->viewData['candidateHistList'] = $this->primaryModel->findAllCandidates('*');

		 $id = filter_var($requestedId, FILTER_SANITIZE_URL);
		 //$candidateHist = $this->primaryModel->findCandidateHist($id);
		 $this->viewData['candidateHist'] = $this->primaryModel->findCandidateHist($id);



        $requestMethod = $this->request->getMethod();


        
        $this->displayForm(__METHOD__, $id);
    } // function edit(...)


	protected function getCandidateHistTypeOptions() { 
		$candidateHistTypeOptions = [ 
				'' => 'Please select...',
				'unspecified' => 'unspecified',
				'colleague' => 'colleague',
				'candidateHist' => 'candidateHist',
				'customer' => 'customer',
				'friend' => 'friend',
			];
		return $candidateHistTypeOptions;
	}

}
