<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
          {{ session('message') }}
        </div>
    @endif
    <form>
    @csrf
        <div class="">
            <div class="inline-flex">
                <input type="text" class="bg-gray-600 text-white m-1" placeholder="Begin date" wire:model="begin">
                @error('begin') <span class="">{{ $message }}</span>@enderror
                <input type="text" class="bg-gray-600 text-white m-1" wire:model="end" placeholder="End date">
                @error('end') <span class="">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="">
            <div class="">
                <button type="button" wire:click.prevent="store()" class="border-gray-400 border-2 rounded-lg px-2">Save</button>
            </div>
        </div>
    </form>
    <table class="border-gray-400 border-2 rounded-lg px-2">
        <tr class="border-gray-400 border-2 rounded-lg px-2">
            <th class="border-gray-400 border-2 rounded-lg px-2">Year Begin</th>
            <th class="border-gray-400 border-2 rounded-lg px-2">Year End</th>
        </tr>
        @foreach($years as $year)
        <tr class="border-gray-400 border-2 rounded-lg px-2">
            <td class="border-gray-400 border-2 rounded-lg px-2">{{$year->begin}}</td>
            <td class="border-gray-400 border-2 rounded-lg px-2">{{$year->end}}</td>
        </tr>
        @endforeach
    </table>
</div>
