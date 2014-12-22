yiiBootstrapDualListBox
=======================
This widget uses jquery plugin Bootstrap Dual Listbox http://www.virtuosoft.eu/code/bootstrap-duallistbox/

### Example of usage
```php
$this->widget('ext.yiiBootstrapDualListBox.YiiBootstrapDualListBoxWidget', array(
  'model'=>$model,
  'name'=>'test',
  'htmlOptions'=>array(
    'class'=>'test-select'
  ),
  // jquery plugin options
  'options'=>array(
    'moveOnSelect'=>false
  ),
  'data'=>array(
    'item1'=>'Label 1',
    'item2'=>'Label 2',
    'item3'=>'Label 3'
  )
));
```
