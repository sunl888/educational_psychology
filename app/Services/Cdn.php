<?php

namespace App\Services;


use Symfony\Component\Finder\Finder;

class Cdn
{
    protected $config = [];

    protected $finder;

    public function __construct(Finder $finder, $config)
    {
        $this->finder = $finder;
        $this->config = $config;
        $this->init();
    }

    private function init()
    {
        $include = $this->config['include'];
        $this->finder->files()->in($include['directories']);
        foreach ($include['extensions'] as $extension) {
            $this->finder->name("*.$extension");
        }
        foreach ($include['patterns'] as $pattern) {
            $this->finder->name($pattern);
        }


        $exclude = $this->config['exclude'];
        $this->finder->exclude($exclude['directories']);
        foreach ($exclude['files'] as $file) {
            $this->finder->notName($file);
        }
        foreach ($exclude['extensions'] as $extension) {
            $this->finder->notName("*.$extension");
        }
        foreach ($exclude['patterns'] as $pattern) {
            $this->finder->notName($pattern);
        }

        $this->finder->ignoreDotFiles($exclude['hidden']);
    }

    public function getAssets()
    {
        return $this->finder;
    }
}
