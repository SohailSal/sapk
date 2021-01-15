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
        <div class="flex">
            <div class="inline-flex">
                <button type="button" wire:click.prevent="store()" class="flex-wrap mb-2 mr-2 px-2 py-1 border border-indigo-600 rounded-lg bg-gray-600 text-white hover:bg-gray-700 focus:outline-none focus:shadow-outline">Add Fiscal Year</button>
            </div>
            <?php
            $yearsel = \App\Models\Year::where('company_id',session('company_id'))->where('enabled','=','1')->first();
            ?>
            @if( $yearsel->closed == 0)
            <div class="inline-flex">
                <a class="flex-wrap mb-2 mr-2 px-2 py-1 border border-indigo-600 rounded-lg bg-gray-600 text-white hover:bg-gray-700 focus:outline-none focus:shadow-outline" href="{{url('close')}}">Close Fiscal Year</a>
            </div>
            @endif
        </div>
    </form>
    <div class="overflow-auto">
        <table class="border-gray-400 border rounded-lg px-2">
            <tr class="border-gray-400 border px-2">
                <th class="border-gray-400 border px-2">Year Begin</th>
                <th class="border-gray-400 border px-2">Year End</th>
                <th class="border-gray-400 border px-2">Active</th>
                <th class="border-gray-400 border px-2 text-center" colspan='2'>Tasks</th>
            </tr>
            @foreach($years as $year)
            <tr class="border-gray-400 border rounded-lg px-2">
                <td class="border-gray-400 border rounded-lg px-2">{{$year->begin}}</td>
                <td class="border-gray-400 border rounded-lg px-2">{{$year->end}}</td>
                <td class="border-gray-400 border rounded-lg px-2 text-center">
                    <input type="radio" name="result" value="{{$year->enabled}}"  wire:click="activate({{ $year->id }})" {{($year->enabled == 1)? 'checked':''}}>
                </td>
                <td class="border-b px-4 text-center">
                    <button wire:click="edit({{ $year->id }})" class="bg-gray-600 hover:bg-gray-700 rounded-lg px-4 py-1 text-white focus:outline-none focus:shadow-outline">Edit</button>
                </td>
                <td class="border-b px-4 text-center">
                    @if(! \App\Models\Document::where('company_id',session('company_id'))->where('date','>=',$year->begin)->where('date','<=',$year->end)->first())
                    <button wire:click="delete({{ $year->id }})" class="delbutton bg-red-600 hover:bg-red-700 rounded-lg px-4 py-1 text-white focus:outline-none focus:shadow-outline">Delete</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
