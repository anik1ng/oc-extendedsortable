<?php namespace ANIKIN\ExtendedSortable\Behaviors;

use October\Rain\Database\SortableScope;

class SortableModel extends \October\Rain\Extension\ExtensionBase
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
        $this->bootSortable();
    }

    /**
     * Boot the sortable trait for this model.
     */
    public function bootSortable(): void
    {
        $this->model::created(function ($model) {
            $sortOrderColumn = $model->getSortOrderColumn();

            if (is_null($model->$sortOrderColumn)) {
                $model->setSortableOrder($model->getKey());
            }
        });

        $this->model->addGlobalScope(new SortableScope);
    }

    /**
     * Sets the sort order of records to the specified orders. If the orders is
     * undefined, the record identifier is used.
     */
    public function setSortableOrder(mixed $itemIds, array $itemOrders = null): void
    {
        if (!is_array($itemIds)) {
            $itemIds = [$itemIds];
        }

        if ($itemOrders === null) {
            $itemOrders = $itemIds;
        }

        if (count($itemIds) !== count($itemOrders)) {
            throw new \Exception('Invalid setSortableOrder call - count of itemIds do not match count of itemOrders');
        }

        foreach ($itemIds as $index => $id) {
            $order = $itemOrders[$index];
            $this->model->newQuery()
                ->where($this->model->getKeyName(), $id)
                ->update([
                    $this->getQualifiedSortOrderColumn() => $order
                ]);
        }
    }

    /**
     * Get the name of the "sort order" column.
     */
    public function getQualifiedSortOrderColumn(): string
    {
        return defined($this->model . '::SORT_ORDER') ? $this->model::SORT_ORDER : 'sort_order';
    }
}
