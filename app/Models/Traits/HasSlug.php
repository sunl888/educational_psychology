<?php

namespace App\Models\Traits;


use App\Services\SlugGenerator;

trait HasSlug
{
    protected $slugKey = 'slug';

    protected $delimiter = '-';

    private $slugMode = '';

    public function slug(): string
    {
        return $this->attributes[$this->slugKey];
    }

    public function generateSlug($text)
    {
        if (!$this->slugMode && method_exists($this, 'slugMode')) {
            $this->slugMode = $this->slugMode();
        }

        return app(SlugGenerator::class)
            ->setSlugIsUniqueFunc($this->getTable(), $this->slugKey, $this->exists ? $this->getKey() : null, $this->getKeyName())
            ->generate($text, $this->slugMode, $this->delimiter);
    }

    public function scopeBySlug($query, $slug)
    {
        $query->where($this->slugKey, $slug);
    }

}
