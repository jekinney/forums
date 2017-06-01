<section class="panel panel-default">
    <header class="panel-heading level">
        <h2 class="panel-title">{{ $profileUser->name }} replied to 
        	<a href="{{  $activity->subject->thread->path()}}">{{ $activity->subject->thread->title }}</a>
        </h2>
    </header>

    <article class="panel-body">
		{{ $activity->subject->body }}
    </article>
</section>