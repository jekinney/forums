<reply :attributes="{{ $reply }}" inline-template v-cloak>
   <section id="reply-{{ $reply->id }}" class="panel panel-default">
                            
        <header class="panel-heading">
            <div class="level">

                <h5 class="flex">
                    <a href="{{ route('profile', $reply->owner) }}" >{{ $reply->owner->name }} </a> replied
                    {{ $reply->created_at->diffForHumans() }}...
                </h5>
                
                @if(auth()->check())
                    <favorite :reply="{{ $reply }}"></favorite>
                @endif
                
            </div>
        </header>

        <article class="panel-body">
            <div v-if="editing">
                <textarea v-model="body" class="form-control"></textarea>
            </div>
            <div v-else v-html="body"></div>
        </article>
        
        @can('update', $reply)
            <footer class="panel-footer">
                <div v-if="editing" class="level">
                    <button type="button" @click="editing = false" class="btn btn-xs btn-default mr-1">Cancel</button>
                    <button class="btn btn-xs btn-primary" @click="update">Save</button>
                </div>
                <div v-else class="level">
                    <button type="button" @click="editing = true" class="btn btn-xs btn-info mr-1">Edit</button>
                    <button type="button" @click="destroy" class="btn btn-xs btn-danger">Delete</button>
                </div>
            </footer>
        @endcan

    </section>
</reply>