<?php

namespace App\Cells;
use CodeIgniter\View\Cells\Cell;

class Navbar extends Cell
{
    public function render():string
    {
        return view('components/navbar');
    }
}
