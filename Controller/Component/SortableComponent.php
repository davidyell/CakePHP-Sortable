<?php
/**
 * Description of SortableComponent
 *
 * @author David Yell <neon1024@gmail.com>
 */
App::uses('Component', 'Controller');

class SortableComponent extends Component {

/**
 * Take a comma seperated list of id's and save them in the matching order
 *
 * @param Controller $controller
 */
    public function startup(Controller $controller) {
        parent::startup($controller);

        if ($controller->request->is('post') && !empty($controller->request->data[$controller->modelClass]['updated-ranks'])) {
            $ranks = explode(',', $controller->request->data[$controller->modelClass]['updated-ranks']);

            $i = 0;
            foreach($ranks as $order => $rowId){
                $data[$i][$controller->modelClass]['id'] = $rowId;
                $data[$i][$controller->modelClass]['sortorder'] = $order+1; // As arrays count from 0, but our ranks count from 1
                $i++;
            }

            if ($controller->{$controller->modelClass}->saveAll($data)) {
                $controller->Session->setFlash($controller->modelClass . ' order updated', 'NiceAdmin.alert-box', array('class' => 'alert-success'));
                $controller->redirect(array('action' => 'index'));
            } else {
                $controller->Session->setFlash($controller->modelClass . ' order could not be updated, please try again', 'NiceAdmin.alert-box', array('class' => 'alert-error'));
            }
        }
    }

}