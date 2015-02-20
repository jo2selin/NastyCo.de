<?php

namespace Nastycode\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NastycodeUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}