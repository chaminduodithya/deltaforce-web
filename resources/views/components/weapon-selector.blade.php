<label class="block">
    <span class="mb-2 block text-sm text-slate-300">Primary Weapon</span>
    <select name="primary_weapon_id" class="df-input" required>
        <option value="">Select primary weapon</option>
        @foreach ($categories as $category)
            @continue($category->weapons->isEmpty())
            <optgroup label="{{ $category->name }}">
                @foreach ($category->weapons as $weapon)
                    <option value="{{ $weapon->id }}" @selected((string) old('primary_weapon_id') === (string) $weapon->id)>{{ $weapon->name }}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
    @error('primary_weapon_id')
        <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
    @enderror
</label>

