<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

abstract class AbstractModel
{
    public static function findByColumn($column, $value)
    {
        // Find the row in the database
        foreach (static::$data as $row) {

            // If this is the row...
            if ($row[$column] == $value) {

                // Create a new instance of the actual class
                $instance = new static;

                // Hydrate the instance with the row contents
                foreach ($row as $key => $value) {
                    $instance->{$key} = $value;
                }

                // Return the new instance
                return $instance;
            }
        }
        return false;
    }

    public function persist()
    {
        foreach (static::$data as & $row) {
            if ($row['id'] == $this->id) {
                foreach ($this as $key => $value) {
                    $row[$key] = $value;
                }
            }
        }
    }
}
