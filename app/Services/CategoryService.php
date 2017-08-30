<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function allCategoryIndent($type = null, $indentStr = '-')
    {
        if (is_null($indentStr)) {
            $indentStr = '-';
        }
        //
        $allCategory = Category::orderBy('parent_id', 'ASC')->ordered()->ancient()->get()->toArray();
        $res = [];
        $this->treeByIndent($allCategory, $res, $indentStr, 0, 0);
        if(!is_null($type)) {
            $res = array_filter($res, function ($category) use($type){
                if($category['parent_id'] != 0 && $category['type'] != $type){
                    return false;
                }else{
                    // todo return $category['type'] == $type ||
                    return true;
                }
            });
        }
        $res = array_values($res);
        return $res;
    }


    private function treeByIndent(&$allNav, &$res, $indentStr = '-', $parentId = 0, $level = 0)
    {
        foreach ($allNav as $value) {
            if ($value['parent_id'] == $parentId) {
                $value['level'] = $level;
                $value['indent_str'] = str_repeat($indentStr, $level);
                $res[] = $value;
                $this->treeByIndent($allNav, $res, $indentStr, $value['id'], $level + 1);
            }
        }
    }
}