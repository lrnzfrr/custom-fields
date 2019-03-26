# CustomFields plugin for CakePHP

With this plugin you can easy add custom fields to all your records!

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

```
composer require lrnzfrr/custom-fields
```

Load the plugin:

```php
bin/cake plugin load lrnzfrr/CustomFields
```

## Use the Plugin

First of all be sure your entity has custom_fields accessible

Launch migration for the plugin:

```
bin/cake migrations migrate -p lrnzfrr/CustomFields
```

Add the behavior in Model Table:

```php
        $this->addBehavior('lrnzfrr/CustomFields.CustomFieldable',
                          ['accessibleFields'=>['article_type','article_status']  // custom fields accessible
                          ]);
```

Use the finder method in Controller:

```php
    $articles = $this->Articles->find('withCustomFields');
```


in the view:

```php
        echo $this->Form->hidden('custom_fields.0.name',['value'=>'article_type']);
        echo $this->Form->text('custom_fields.0.value',['value'=>'','label'=>'article_type','placeholder'=>'Article Type']);

        echo $this->Form->hidden('custom_fields.1.name',['value'=>'article_status']);
        echo $this->Form->text('custom_fields.1.value',['value'=>'','label'=>'article_status','placeholder'=>'Article Status']);
```

If you prefer you can also get the custom fields inside entity with assoc key => value with getCustomFieldsAssoc method:

inside entity:

```php
use lrnzfrr\CustomFields\Model\Traits\CustomFieldTrait;

class ....
use CustomFieldTrait;
protected $_virtual = ['custom_fields_assoc'];

    /*
    ** Create a virtual property with custom Fields
    */
    protected function _getCustomFieldsAssoc()
    {
        return $this->getCustomFieldsAssoc();
    }
```
That's all!

[composer](https://getcomposer.org)

[cakephp](https://cakephp.org/)

[flor.it](https://www.flor.it)



