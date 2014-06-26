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
    public $settings = array(
		'model' => '',
		'field' => 'id',
		'sortField' => 'sortorder',
		'useNiceAdmin' => true
	);

/**
 * Constructor
 *
 * @param ComponentCollection $collection A ComponentCollection this component can use to lazy load its components
 * @param array $settings Array of configuration settings.
 */
    public function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $this->settings);
		
        // Set the default to the current model, unless overridden
		if (!isset($settings['model'])) {
			$this->settings['model'] = $collection->getController()->modelClass;
		}
        $this->settings = array_merge($this->settings, $settings);
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
            foreach ($ranks as $order => $rowId) {
                $data[$i][$this->settings['model']][$this->settings['field']] = $rowId;
                $data[$i][$this->settings['model']][$this->settings['sortField']] = $order + 1; // As arrays count from 0, but our ranks count from 1
                $i++;
            }
			
			$element = 'default';
			if ($this->settings['useNiceAdmin']) {
				$element = 'NiceAdmin.alert-box';
			}

            $controller->loadModel($this->settings['model']);
            if ($controller->{$this->settings['model']}->saveAll($data, array('validate' => false))) {
                $controller->Session->setFlash($this->settings['model'].' order updated', $element, array('class' => 'alert-success'));
                $controller->redirect($controller->referer());
            } else {
                $controller->Session->setFlash($this->settings['model'].' order could not be updated, please try again', $element, array('class' => 'alert-error'));
            }
        }
    }

}