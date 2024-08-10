<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class Alerts extends Cell
{
    public function render():string
    {
        return view('components/alerts');
    }
}
