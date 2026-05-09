<section class="rounded-lg border border-tactical-line bg-slate-950/40 p-4">
    <h2 class="df-title text-lg">Attachment Picker</h2>
    <div class="mt-3 grid gap-3 md:grid-cols-2">
        @foreach ($attachmentSlots as $slot)
            <label class="block">
                <span class="mb-1 block text-xs text-slate-400">{{ $slot->name }}</span>
                <select name="attachments[{{ $slot->slug }}]" class="df-input">
                    <option value="">None</option>
                    @foreach ($slot->attachments as $attachment)
                        <option value="{{ $attachment->id }}" @selected((string) old("attachments.{$slot->slug}") === (string) $attachment->id)>
                            {{ $attachment->name }}
                        </option>
                    @endforeach
                </select>
                @error("attachments.{$slot->slug}")
                    <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                @enderror
            </label>
        @endforeach
    </div>
</section>

