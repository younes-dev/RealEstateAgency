<?php

namespace App\Service;

use Symfony\Component\HttpKernel\KernelInterface;

class Helper
{
    // References  :  https://stackoverflow.com/questions/48585265/symfony-4-how-to-get-public-from-rootdir
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