<?php

namespace App\Service;

use Symfony\Component\HttpKernel\KernelInterface;

class Helper
{
    protected $projectDir;

    public function __construct(KernelInterface $kernel)
    {
        $this->projectDir = $kernel->getProjectDir();
    }

    public function showProjectDir()
    {
       return $this->projectDir;
    }
}