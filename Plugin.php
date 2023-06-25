<?php namespace ANIKIN\ExtendedSortable;

class Plugin extends \System\Classes\PluginBase
{
    public function pluginDetails(): array
    {
        return [
            'name' => 'ANIKIN.ExtendedSortable',
            'description' => 'Extend sortable functionality for OctoberCMS plugins.',
            'author' => 'Constantine Anikin',
            'icon' => 'icon-diamond'
        ];
    }
}