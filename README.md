#CakePHP-Sortable
A small component to implement sortable tables with id's in a Cake view. This allows you to easily attach sorting to any table.  

It includes the [jQuery StupidTable](https://github.com/joequery/Stupid-Table-Plugin) plugin to facilitate the sorting, and also a component to deal with the saving.

##Installation
Install this as you would any other plugin using `CakePlugin::load('Sortable');` unless you are already using `CakePlugin::loadAll()`.

##Requirements
This makes use of the [NiceAdmin](https://github.com/davidyell/CakePHP-NiceAdmin) alert-box element.

##Usage
In your controller you will need to include it in your components array.  
```
    public $components = array(
        'Sortable'
    );
```  

Also you'll want to include the field on the view in order to submit the updated ranks to the component.  

```
    <?php
    echo $this->Form->create();
    echo $this->Form->input('updated-ranks', array('id' => 'updated-ranks', 'type' => 'hidden'));
    echo $this->Form->submit('Save sort order', array('class' => 'btn btn-success', 'div' => false));
    echo $this->Html->link('Cancel', array('action' => 'index'), array('class' => 'btn'));
    ?>
```
