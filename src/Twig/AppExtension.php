<?php


namespace App\Twig;


use Twig\TwigTest;

class AppExtension extends \Twig\Extension\AbstractExtension
{
    public function getTests()
    {
        return [
            new TwigTest('instanceof', [$this, 'isInstanceof'])
        ];
    }

    /**
     * @param $var
     * @param $instance
     * @return bool
     */
    public function isInstanceof($var, $instance) {
        return  $var instanceof $instance;
    }
}