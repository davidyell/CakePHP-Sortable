#CakePHP-Sortable
A small component to implement sortable tables with id's in a Cake view. This allows you to easily attach sorting to any table.  

It includes the [jQuery StupidTable](https://github.com/joequery/Stupid-Table-Plugin) plugin to facilitate the sorting, and also a component to deal with the saving.

##Installation
Install this as you would any other plugin using `CakePlugin::load('Sortable');` unless you are already using `CakePlugin::loadAll()`.

##Requirements
This makes use of the [NiceAdmin](https://github.com/davidyell/CakePHP-NiceAdmin) alert-box element.

##Usage
In your controller you will need to include it in your components array.  
```php
public $components = array(
    'Sortable.Sortable'
);
```  

Also you'll want to include the field on the view in order to submit the updated ranks to the component.  

```php
<?php
echo $this->Form->create();
echo $this->Form->input('updated-ranks', array('id' => 'updated-ranks', 'type' => 'hidden'));
echo $this->Form->submit('Save sort order', array('class' => 'btn btn-success', 'div' => false));
echo $this->Html->link('Cancel', array('action' => 'index'), array('class' => 'btn'));
?>
```
##Todo
* Consider refactoring the data management into a behaviour

##License
The MIT License (MIT)

Copyright (c) 2013 David Yell

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
