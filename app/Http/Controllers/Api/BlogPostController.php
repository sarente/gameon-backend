<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Workflow;

class BlogPostController extends Controller
{
    function index() {
        $post = BlogPost::find(1);
        $workflow = Workflow::get($post);
// or get it directly from the trait
        $workflow = $post->workflow_get();

        $workflow->can($post, 'publish'); // False
        $workflow->can($post, 'to_review'); // True
        $transitions = $workflow->getEnabledTransitions($post);

// Apply a transition
        $workflow->apply($post, 'to_review');
        $post->save(); // Don't forget to persist the state

// Get the workflow directly

// Using the WorkflowTrait
        $post->workflow_can('publish'); // True
        $post->workflow_can('to_review'); // False

// Get the post transitions
        foreach ($post->workflow_transitions() as $transition) {
            echo $transition->getName();
        }

// Apply a transition
        $post->workflow_apply('publish');
        $post->save();
    }
}
