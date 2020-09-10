<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class UserWorkflow extends Model
{
    use WorkflowTrait;

    protected $table = "user_workflow";

    protected $casts = [
        'marking' => 'array',
        'current_place' => 'array'
    ];
    private $currentPlace;

    // getter/setter methods must exist for property access by the marking store

    public function getCurrentPlace()
    {
        return $this->currentPlace;
    }

    public function setCurrentPlace($currentPlace, $context = [])
    {
        $this->currentPlace = $currentPlace;
    }
}
