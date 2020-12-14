<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
          {{ session('message') }}
        </div>
    @endif
    @if($isOpen)
       @include('livewire.yearcreate')
    @endif
    <form>
    @csrf
        <div class="">
            <div class="">
                <button type="button" wire:click.prevent="store()" class="border-gray-400 border-2 rounded-lg px-2">Add Fiscal Year</button>
            </div>
        </div>
    </form>
    <table class="border-gray-400 border-2 rounded-lg px-2">
        <tr class="border-gray-400 border-2 rounded-lg px-2">
            <th class="border-gray-400 border-2 rounded-lg px-2">Year Begin</th>
            <th class="border-gray-400 border-2 rounded-lg px-2">Year End</th>
            <th class="border-gray-400 border-2 rounded-lg px-2">Active</th>
        </tr>
        @foreach($years as $year)
        <tr class="border-gray-400 border-2 rounded-lg px-2">
            <td class="border-gray-400 border-2 rounded-lg px-2">{{$year->begin}}</td>
            <td class="border-gray-400 border-2 rounded-lg px-2">{{$year->end}}</td>
            <td class="border-gray-400 border-2 rounded-lg px-2">
                <input type="radio" name="result" value="{{$year->enabled}}"  wire:click="activate({{ $year->id }})" {{($year->enabled == 1)? 'checked':''}}>
            </td>
            <td>
                <div class="flex justify-between">
                    <x-jet-button wire:click="edit({{ $year->id }})" >Edit</x-jet-button>

                    @if(! \App\Models\Document::where('company_id',session('company_id'))->where('date','>=',$year->begin)->where('date','<=',$year->end)->first())
                    <x-jet-danger-button wire:click="delete({{ $year->id }})" >Delete</x-jet-danger-button>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>
