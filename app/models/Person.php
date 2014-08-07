<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

class Person extends AbstractModel
{
    public static $data = array(
        array(
            'id' => 1,
            'name' => 'Johnny Greensmith',
            'fav_colour' => 'Green'
        ),

        array(
            'id' => 2,
            'name' => 'Mary Blueton',
            'fav_colour' => 'Blue'
        )
    );
}
