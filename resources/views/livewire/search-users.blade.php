<div x-data="{isOpen:false}">
    <input wire:model="search" type="text" placeholder="Search users..." x-on:keyup="isOpen=($event.target.value!='')?true:false" @click="isOpen=true" @click.away="isOpen=false" @keydown.escape="isOpen=false"/>
    <ul>
        <div x-show="isOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="absolute bg-white rounded-md shadow-md border-gray-500 border p-2"
        >
        @foreach($users as $user)
            <li>{{ $user->title }} {{$user->body}}</li>
        @endforeach
        <div>
    </ul>
</div>