<?php

namespace App\Services;


use App\Models\Type;

class TypeService
{
    private function filter(array &$data)
    {
        if (isset($data['model_name'])) {
            $data['model_name'] = Type::$modelMapWithType[$data['model_name']];
        }
        $data['description'] = e($data['description']);
        return $data;
    }

    public function create(array $data)
    {
        $this->filter($data);
        $type = Type::create($data);
        return $type;
    }

    public function update(Type $type, array $data)
    {
        $this->filter($data);
        $type->update($data);
        return $type;
    }
}
