<?php

namespace HRis\PIM\Traits;

trait UsesBaum
{
    // 'parent_id' column name
    protected $parentColumnName = 'reports_to_id';
    
    // 'lft' column name
    protected $leftColumnName = 'lft';

    // 'rgt' column name
    protected $rightColumnName = 'rgt';
}
