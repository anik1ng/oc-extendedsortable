# ExtendedSortable

Simple plugin to add sorting functionality to any OctoberCMS plugin. 

Original idea and code — https://github.com/LeMaX10/oc-extendedsortable
_(I modified code to work with OctoberCMS v3, and add minor changes)._

## Sample

```php
\Author\Plugin\Controllers\Products::extend(function ($controller) {
    $controller->implement = array_merge(
        $controller->implement, ['ANIKIN\ExtendedSortable\Behaviors\SortableController']
    );
    $controller->addDynamicProperty('reorderConfig', '$/anikin/extendedsortable/config/reorder_products.yaml');
});

\Author\Plugin\Models\Product::extend(function ($model) {
    $model->implement = array_merge(
        $model->implement, ['ANIKIN\ExtendedSortable\Behaviors\SortableModel']
    );
});
```