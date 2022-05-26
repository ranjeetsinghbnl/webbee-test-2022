<?php
// MenuRepository

namespace App\Repositories;
use App\Models\MenuItem;
use App\Http\Resources\MenuCollection;

class MenuRepository
{
  /**
   * function
   * @name Menus
   * @description Get all menu items
   * @return Menu Object
   */
  public function Menus($isCollection = false) {
    $menus = MenuItem::all();
    return $isCollection === true ? new MenuCollection($menus) : $menus->toArray();
  }

  /**
   * function
   * @name MenuItems
   * @description Get menu tree with parent and child, if formatting is one
   * @return Array
   */
  public function MenuItems($isFormat = true) {
    return $isFormat === true ? $this->buildMenuTree($this->Menus()) : $this->Menus();
  }


  /**
   * function
   * @name buildMenuTree
   * @description Build nested menu tree with parent and child
   * @return Array
   */
  public function buildMenuTree(array $elements, $parentId = 0)
    {
        $branch = [];
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildMenuTree($elements, $element['id']);
                $element['children'] = $children ?: []; 
                $branch[] = $element;
            }
        }
        return $branch;
    }
}