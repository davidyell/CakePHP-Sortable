<?php
/**
 * Description of SortableComponent
 *
 * @author David Yell <neon1024@gmail.com>
 */
App::uses('Component', 'Controller');

class SortableComponent extends Component {
    
/**
 * Settings for this Component
 *
 * @var array
 */
	public $settings = array();

/**
 * Constructor
 *
 * @param ComponentCollection $collection A ComponentCollection this component can use to lazy load its components
 * @param array $settings Array of configuration settings.
 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
        // Set the default to the current model, unless overridden
        $this->settings = array(
            'model' => $collection->getController()->modelClass
        );
        $settings = array_merge($this->settings, $settings);
        
        parent::__construct($collection, $settings);
	}

 /**
 * Take a comma seperated list of id's and save them in the matching order
 *
 * @param Controller $controller
 */
    public function startup(Controller $controller) {
        parent::startup($controller);

        $postedRanks = Hash::extract($controller->request->data, '{s}.updated-ranks');

        if ($controller->request->is('post') && !empty($postedRanks)) {
            $ranks = explode(',', $postedRanks[0]);

            $i = 0;
            foreach($ranks as $order => $rowId){
                $data[$i][$this->settings['model']]['id'] = $rowId;
                $data[$i][$this->settings['model']]['sortorder'] = $order+1; // As arrays count from 0, but our ranks count from 1
                $i++;
            }

            $controller->loadModel($this->settings['model']);
            if ($controller->{$this->settings['model']}->saveAll($data)) {
                $controller->Session->setFlash($this->settings['model'] . ' order updated', 'NiceAdmin.alert-box', array('class' => 'alert-success'));
                $controller->redirect($controller->referer());
            } else {
                $controller->Session->setFlash($this->settings['model'] . ' order could not be updated, please try again', 'NiceAdmin.alert-box', array('class' => 'alert-error'));
            }
        }
    }

}