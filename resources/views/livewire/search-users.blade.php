<div x-data="{isOpen:false}">
    <input wire:model="search" type="text" placeholder="Search users..." x-on:keyup="isOpen=true"/>
    <ul>
        <div x-show="isOpen">
        @foreach($users as $user)
            <li>{{ $user->title }} {{$user->body}}</li>
        @endforeach
        <div>
    </ul>
</div>