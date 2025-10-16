<?php

namespace App\Models;

class Model1
{
    public function PenampilanModel()
    {
        echo "Hello model laravel";
    }

    public function ProsedureModel($a, $b)
    {
        $c = $a + $b;
        echo "Hasil : " . $c;
    }

    public function FungsinyaModel($a, $b)
    {
        $c = $a + $b;
        return $c;
    }
}
