<?php namespace ANIKIN\ExtendedSortable\Behaviors;

class SortableController extends \Backend\Behaviors\ReorderController
{
    /**
     * @inheritDoc
     */
    public function reorder()
    {
        $this->addJs('/modules/backend/behaviors/reordercontroller/assets/js/october.reorder.js', 'core');

        $this->controller->pageTitle = $this->controller->pageTitle
            ?: \Lang::get($this->getConfig('title', 'backend::lang.reorder.default_title'));

        $this->validateModel();
        $this->prepareVars();

        return $this->makeView('$/anikin/extendedsortable/behaviors/sortablecontroller/reorder');
    }

    /**
     * @inheritDoc
     */
    protected function validateModel()
    {
        $model = $this->controller->reorderGetModel();
        if (in_array(SortableModel::class, $model->implement)) {
            $this->sortMode = 'simple';
            return $model;
        }

        return parent::validateModel();
    }
}
