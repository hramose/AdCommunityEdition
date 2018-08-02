<?php

class CfcExamesPraticosCalendarForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'exames';
    private static $activeRecord = 'CfcExamesPraticos';
    private static $primaryKey = 'id';
    private static $formName = 'form_CfcExamesPraticos';
    private static $startDateField = 'inicio';
    private static $endDateField = 'fim';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.80, null);
        parent::setTitle('exames');
        parent::setProperty('class', 'window_modal');

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle('exames');

        $view = new THidden('view');

        $id = new TEntry('id');
        $cfc_veiculos_id = new TEntry('cfc_veiculos_id');
        $cfc_funcionarios_id = new TEntry('cfc_funcionarios_id');
        $inicio = new TDateTime('inicio');
        $fim = new TDateTime('fim');
        $descricao = new TEntry('descricao');
        $valor = new TColor('valor');
        $observacoes = new TEntry('observacoes');
        $quem_cadastrou = new TEntry('quem_cadastrou');
        $encaixe = new TEntry('encaixe');
        $substituida = new TEntry('substituida');

        $cfc_veiculos_id->addValidation('Cfc veiculos id', new TRequiredValidator()); 
        $cfc_funcionarios_id->addValidation('Cfc funcionarios id', new TRequiredValidator()); 
        $inicio->addValidation('Inicio', new TRequiredValidator()); 
        $fim->addValidation('Fim', new TRequiredValidator()); 
        $descricao->addValidation('Descricao', new TRequiredValidator()); 
        $quem_cadastrou->addValidation('Quem cadastrou', new TRequiredValidator()); 
        $encaixe->addValidation('Encaixe', new TRequiredValidator()); 
        $substituida->addValidation('Substituida', new TRequiredValidator()); 

        $id->setEditable(false);
        $fim->setMask('dd/mm/yyyy hh:ii');
        $inicio->setMask('dd/mm/yyyy hh:ii');

        $fim->setDatabaseMask('yyyy-mm-dd hh:ii');
        $inicio->setDatabaseMask('yyyy-mm-dd hh:ii');

        $id->setSize(100);
        $fim->setSize(150);
        $valor->setSize(100);
        $inicio->setSize(150);
        $encaixe->setSize('70%');
        $descricao->setSize('70%');
        $observacoes->setSize('70%');
        $substituida->setSize('70%');
        $quem_cadastrou->setSize('70%');
        $cfc_veiculos_id->setSize('70%');
        $cfc_funcionarios_id->setSize('70%');



        $row1 = $this->form->addFields([new TLabel('Id:', null, '14px', null, '100%'),$id],[new TLabel('Cfc veiculos id:', '#ff0000', '14px', null, '100%'),$cfc_veiculos_id]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel('Cfc funcionarios id:', '#ff0000', '14px', null, '100%'),$cfc_funcionarios_id],[new TLabel('Inicio:', '#ff0000', '14px', null, '100%'),$inicio]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel('Fim:', '#ff0000', '14px', null, '100%'),$fim],[new TLabel('Descricao:', '#ff0000', '14px', null, '100%'),$descricao]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel('Valor:', null, '14px', null, '100%'),$valor],[new TLabel('Observacoes:', null, '14px', null, '100%'),$observacoes]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel('Quem cadastrou:', '#ff0000', '14px', null, '100%'),$quem_cadastrou],[new TLabel('Encaixe:', '#ff0000', '14px', null, '100%'),$encaixe]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        $row6 = $this->form->addFields([new TLabel('Substituida:', '#ff0000', '14px', null, '100%'),$substituida],[]);
        $row6->layout = ['col-sm-6','col-sm-6'];

        $this->form->addFields([$view]);

        // create the form actions
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        $btn_ondelete = $this->form->addAction('Excluir', new TAction([$this, 'onDelete']), 'fa:trash-o #dd5a43');

        parent::add($this->form);
    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            /**
            // Enable Debug logger for SQL operations inside the transaction
            TTransaction::setLogger(new TLoggerSTD); // standard output
            TTransaction::setLogger(new TLoggerTXT('log.txt')); // file
            **/

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new CfcExamesPraticos(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $messageAction = new TAction(['CfcExamesPraticosCalendarFormView', 'onReload']);
            $messageAction->setParameter('view', $data->view);
            $messageAction->setParameter('date', explode(' ', $data->inicio)[0]);

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            /**
            // To define an action to be executed on the message close event:
            $messageAction = new TAction(['className', 'methodName']);
            **/

            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'), $messageAction);

                TWindow::closeWindow(parent::getId()); 

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }
    public function onDelete($param = null) 
    {
        if(isset($param['delete']) && $param['delete'] == 1)
        {
            try
            {
                $key = $param[self::$primaryKey];

                // open a transaction with database
                TTransaction::open(self::$database);

                $class = self::$activeRecord;

                // instantiates object
                $object = new $class($key, FALSE);

                // deletes the object from the database
                $object->delete();

                // close the transaction
                TTransaction::close();

                $messageAction = new TAction(array(__CLASS__.'View', 'onReload'));
                $messageAction->setParameter('view', $param['view']);
                $messageAction->setParameter('date', explode(' ',$param[self::$startDateField])[0]);

                // shows the success message
                new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'), $messageAction);
            }
            catch (Exception $e) // in case of exception
            {
                // shows the exception error message
                new TMessage('error', $e->getMessage());
                // undo all pending operations
                TTransaction::rollback();
            }
        }
        else
        {
            // define the delete action
            $action = new TAction(array($this, 'onDelete'));
            $action->setParameters((array) $this->form->getData());
            $action->setParameter('delete', 1);
            // shows a dialog to the user
            new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);   
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new CfcExamesPraticos($key); // instantiates the Active Record 

                                $object->view = $param['view']; 

                $this->form->setData($object); // fill the form 

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

    }

    public function onShow($param = null)
    {

    } 

    public function onStartEdit($param)
    {
        TSession::setValue('{$detailId}_items', null);

        $this->form->clear(true);

        $data = new stdClass;
        $data->view = $param['view']; // calendar view
        $data->valor = '#3a87ad';

        if ($param['date'])
        {
            if(strlen($param['date']) == '10')
                $param['date'].= ' 09:00';

            $data->inicio = str_replace('T', ' ', $param['date']);

            $fim = new DateTime($data->inicio);
            $fim->add(new DateInterval('PT1H'));
            $data->fim = $fim->format('Y-m-d H:i:s');

            $this->form->setData( $data );
        }
    }

    public static function onUpdateEvent($param)
    {
        try
        {
            if (isset($param['id']))
            {
                TTransaction::open(self::$database);

                $class = self::$activeRecord;
                $object = new $class($param['id']);

                $object->inicio = str_replace('T', ' ', $param['start_time']);
                $object->fim   = str_replace('T', ' ', $param['end_time']);

                $object->store();

                // close the transaction
                TTransaction::close();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            TTransaction::rollback();
        }
    }

}

