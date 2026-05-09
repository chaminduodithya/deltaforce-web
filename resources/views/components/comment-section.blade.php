<section class="df-panel p-6">
    <h2 class="df-title text-xl">Comments</h2>
    <div class="mt-4 space-y-3">
        @forelse ($comments as $comment)
            <article class="rounded-lg bg-slate-950/50 p-3">
                <div class="flex items-center gap-2">
                    {{-- Avatar placeholder --}}
                    <div class="df-avatar" aria-hidden="true">
                        {{ strtoupper(substr($comment->user?->name ?? '?', 0, 1)) }}
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="font-medium text-slate-200">{{ $comment->user?->name }}</span>
                        @if ($comment->is_verified)
                            <span
                                class="inline-flex items-center gap-0.5 rounded-full bg-green-500/10 px-1.5 py-0.5 text-[10px] font-medium text-green-300">
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                tested
                            </span>
                        @endif
                    </div>
                </div>
                <p class="mt-2 text-sm leading-relaxed text-slate-300">{{ $comment->body }}</p>
            </article>
        @empty
            <div class="rounded-lg bg-slate-950/30 p-6 text-center">
                <svg class="mx-auto h-8 w-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                    </path>
                </svg>
                <p class="mt-2 text-slate-400">No comments yet. Be the first to share your thoughts.</p>
            </div>
        @endforelse
    </div>
</section>
