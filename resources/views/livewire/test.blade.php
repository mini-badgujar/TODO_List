<div>
    <form wire:submit.prevent="addRecord">
        <div>
            <label for="name">Name:</label>
            <input type="text" wire:model="name" id="name">
            @error('name')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Submit</button>
    </form>

    <ul>
        @foreach ($records as $record)
            <li>{{ $record['name'] }} </li>
        @endforeach
    </ul>
</div>
