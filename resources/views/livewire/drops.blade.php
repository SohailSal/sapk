<div>
    <div class="mb-8">
        <label class="inline-block w-32 font-bold">Account Type:</label>
        <select wire:model="type" class="border shadow p-2 bg-white">
            <option value=''>Choose a Type</option>
            @foreach($types as $type)
                <option value={{ $type->id }}>{{ $type->name }}</option>
            @endforeach
        </select>
    </div>
    @if($groups)
        <div class="mb-8">
            <label class="inline-block w-32 font-bold">Group:</label>
            <select wire:model="group" 
                class="p-2 px-4 py-2 pr-8 leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                <option value=''>Choose a group</option>
                @foreach($groups as $group)
                    <option value={{ $group->id }}>{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>
