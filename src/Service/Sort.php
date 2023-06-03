<?php
namespace App\Service;

class Sort
{
    public function sortTable($data, $sortBy): array
    {
        usort($data, function ($item1, $item2) use ($sortBy) {
            return $item1[$sortBy] <=> $item2[$sortBy];
        });
        

        return $data;
    }
}