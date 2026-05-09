<section class="df-panel p-6">
    <h2 class="df-title text-xl">Comments</h2>
    <div class="mt-4 space-y-3">
        @forelse ($comments as $comment)
            <article class="rounded-lg bg-slate-950/50 p-3">
                <div class="flex items-center gap-2 text-xs text-slate-400">
                    <span>{{ $comment->user?->name }}</span>
                    @if($comment->is_verified)
                        <span class="text-green-300">tested</span>
                    @endif
                </div>
                <p class="mt-1 text-sm">{{ $comment->body }}</p>
            </article>
        @empty
            <p class="text-slate-400">No comments yet.</p>
        @endforelse
    </div>
</section>

