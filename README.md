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

If the model is controlled by the relation widget (example of the child model "Offers" in the parent model "Products"), and we want to create a button to change the order of these records:

```php
// modify SortableController->reorder() method:
public function reorder($product_id = null)
{
    // ...
    
    $this->prepareVars();
    
    if (!empty($product_id)) {
        $reorderRecords = $this->getRecords();
        $this->vars['reorderRecords'] = $reorderRecords->where('product_id', $product_id);
    }
}

// extend controller for parent model
Products::extend(function ($controller) {
    $controller->relationConfig = '$/author/plugin/controllers/products/config_relation.yaml';
}

// config_relation.yaml
offer:
  # ...
  view:
    # ...
    toolbarPartial: $/author/plugin/models/offer/toolbar_relation.htm

// toolbar_relation.htm
<div data-control="toolbar">
    <?php foreach ($relationToolbarButtons as $button): ?>
        <?= $this->relationMakePartial('button_' . $button) ?>
    <?php endforeach ?>
    <a
        href="/backend/author/plugin/offers/reorder/<?= $this->vars['formModel']->id ?>"
        class="btn btn-sm btn-default oc-icon-reorder">
        Sorting
    </a>
</div>

```
