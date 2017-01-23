<?phpuse Formbuilder\Controller\Action;use Formbuilder\Model\Form;use Formbuilder\Lib\Frontend as FormFrontEnd;use Formbuilder\Lib\Mailer;class Formbuilder_AjaxController extends Action {    public $languages = NULL;    public function parseAction()    {        $formId = $this->_getParam('_formId');        $locale = $this->_getParam('_language');        $templateId = $this->_getParam('_mailTemplate');        $valid = FALSE;        $redirect = FALSE;        $message = '';        $validationData = FALSE;        $mainList = new Form();        $formData = $mainList->getById( $formId );        if( $formData instanceof Form )        {            $frontendLib = new FormFrontEnd();            $form = $frontendLib->getForm($formData->getId(), $locale, true);            $frontendLib->addDefaultValuesToForm( $form, array( 'formId' => $formId, 'locale' => $locale, 'mailTemplate' => $templateId) );            $params = $frontendLib->parseFormParams( $this->getAllParams(), $form );            $formValid = TRUE;            $valid = FALSE;            if( $frontendLib->hasRecaptchaV2() )            {                $formValid = $form->isValid( $params, $frontendLib->getRecaptchaV2Key() );            }            if( $formValid === TRUE )            {                $valid = $form->isValid( $params );            }            if( $valid )            {                if( $templateId !== null )                {                    $send = Mailer::sendForm( $templateId, array('data' => $form->getValues() ) );                    if( $send === TRUE )                    {                        $return = $this->afterSend($templateId);                        $valid = $return['valid'];                        $redirect = $return['redirect'];                        $message = $valid === FALSE ? $return['message'] : $return['html'];                    }                }            }            else            {                $validationData = $form->getMessages();            }        }        $this->_helper->json(array(            'success'           => $valid,            'message'           => $message,            'validationData'    => $validationData,            'redirect'          => $redirect        ));    }    private function afterSend( $mailTemplateId )    {        $redirect = FALSE;        $error = FALSE;        $successMessage = '';        $statusMessage = '';        $mailTemplate = \Pimcore\Model\Document::getById( $mailTemplateId );        $afterSuccess = $mailTemplate->getProperty('mail_successfully_sent');        //get the content from a snippet        if( $afterSuccess instanceof \Pimcore\Model\Document\Snippet )        {            $params['document'] = $afterSuccess;            if( $this->view instanceof \Pimcore\View )            {                try                {                    $successMessage = $this->view->action($afterSuccess->getAction(), $afterSuccess->getController(), $afterSuccess->getModule(), $params);                }                catch(\Exception $e)                {                    $error = TRUE;                    $statusMessage = $e->getMessage();                }            }        }        //it's a redirect!        else if( $afterSuccess instanceof \Pimcore\Model\Document)        {            $redirect = TRUE;            $successMessage = $afterSuccess->getFullPath();        }        //it's just a string!        else if( is_string( $afterSuccess ) )        {            $successMessage = $afterSuccess;        }        return array(            'valid'     => $error === FALSE,            'message'   => $statusMessage,            'redirect'  => $redirect,            'html'      => $successMessage        );    }}