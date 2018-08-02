<?php
/**
 * CfcExamesPraticosCalendarForm Form
 * @author  <your name here>
 */
class CfcExamesPraticosCalendarFormView extends TPage
{
    private $fc;

    /**
     * Page constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->fc = new TFullCalendar(date('Y-m-d'), 'month');
        $this->fc->enableDays([1,2,3,4,5]);
        $this->fc->setReloadAction(new TAction(array($this, 'getEvents')));
        $this->fc->setDayClickAction(new TAction(array('CfcExamesPraticosCalendarForm', 'onStartEdit')));
        $this->fc->setEventClickAction(new TAction(array('CfcExamesPraticosCalendarForm', 'onEdit')));
        $this->fc->setEventUpdateAction(new TAction(array('CfcExamesPraticosCalendarForm', 'onUpdateEvent')));
        $this->fc->setCurrentView('agendaWeek');
        $this->fc->setTimeRange('07:00', '19:00');

        parent::add( $this->fc );
    }

    /**
     * Output events as an json
     */
    public static function getEvents($param=NULL)
    {
        $return = array();
        try
        {
            TTransaction::open('exames');

            $criteria = new TCriteria(); 

            $criteria->add(new TFilter('inicio', '>=', $param['start'].' 00:00:00'));
            $criteria->add(new TFilter('fim', '<=', $param['end'].' 23:59:59'));

            $events = CfcExamesPraticos::getObjects($criteria);

            if ($events)
            {
                foreach ($events as $event)
                {
                    $event_array = $event->toArray();
                    $event_array['start'] = str_replace( ' ', 'T', $event_array['inicio']);
                    $event_array['end'] = str_replace( ' ', 'T', $event_array['fim']);
                    $event_array['color'] = $event_array['valor'];

                    $return[] = $event_array;
                }
            }
            TTransaction::close();
            echo json_encode($return);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }

    /**
     * Reconfigure the callendar
     */
    public function onReload($param = null)
    {
        if (isset($param['view']))
        {
            $this->fc->setCurrentView($param['view']);
        }

        if (isset($param['date']))
        {
            $this->fc->setCurrentDate($param['date']);
        }
    }

}

