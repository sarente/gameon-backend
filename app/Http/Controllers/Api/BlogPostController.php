<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Workflow;

class BlogPostController extends Controller
{
    function index() {
        $post = BlogPost::find(2);
// or get it directly from the trait
        $workflow = $post->workflow_get();
        $workflow->apply($post, 't3');
        $post->save();
//dd($workflow->getEnabledTransitions($post));
        //dd($workflow->can($post, 'a')); // False
        /*foreach ($post->workflow_transitions() as $transition) {
            dd($post->workflow_transitions());
        }
        dd($post->workflow_can('t2')); // True*/


    }
}
