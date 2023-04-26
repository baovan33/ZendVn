<?php

 function getCategory($data, $id = 0, $text = '', &$list = [])
 {
     foreach ($data as $key => $item) {
         if ($item->parent_id == $id) {
             $list[] = [
                 'id' => $item->id,
                 'name' => $text . $item->name,
             ];
             unset($data[$key]);
              getCategory($data, $item->id, $text . '-', $list);
         }
     }

     return $list;

 }


