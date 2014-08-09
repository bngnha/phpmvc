<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

class HomeController extends Controller
{
    public function indexAction($params)
    {
        // Find the requested person in the database
	    $params[1] = 1;
        $person = Person::findByColumn('id', $params[1]);

        $this->view->assign($person);
	    $this->view('home/index');
    }

	public function setLayout()
	{
		$this->layout = 'this is layout';
	}
}

