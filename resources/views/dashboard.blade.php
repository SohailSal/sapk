<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="inline-flex font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
            </div>

            <div class="inline-flex mx-auto bg-blue-700 rounded-lg p-1">
                <form method="GET" action="{{ route('dashboard') }}">
                @csrf
                    <div class="inline-flex">
                        <select name="company" class="shadow w-52 bg-gray-600 text-white h-9 rounded leading-tight focus:outline-none focus:shadow-outline">
                            @foreach(\Auth::user()->companies as $company)
                                <option value='{{ $company->id }}' {{ ($company->id == session('company_id')) ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="inline-flex">
                        <x-jet-button type="submit">Go</x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

@if(Auth::user()->companies()->first())
    <div class="text-white">Welcome, {{Auth::user()->name}}</div>
@else
    <div class="text-white">First <a href="{{url('company')}}">create a Company</a></div>
@endif

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <ul class="list-disc ml-4">
                        <li>
                            First, <a href="{{url('company')}}">create a Company</a>.
                        </li>
                        <li>
                            Second, <a href="{{url('group')}}">create Account Groups</a>.
                        </li>
                        <li>
                            Then <a href="{{url('account')}}">create some accounts</a>.
                        </li>
                        <li>
                            Third, <a href="{{url('doctype')}}">create Voucher Types</a> as you desire.
                        </li>
                        <li>
                            Now, <a href="{{url('doc')}}">start entering Transactions</a>.
                        </li>
                    </ul>
                </div>
            </div>
        </div>


<?php

            $fmt = new NumberFormatter( 'en_GB', NumberFormatter::CURRENCY );
            $amt = new NumberFormatter( 'en_GB', NumberFormatter::SPELLOUT );
            $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
            $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');

                $id= \App\Models\AccountType::where('name','Revenue')->first()->id;
                $grps = \App\Models\AccountGroup::where('company_id',session('company_id'))->where('type_id',$id)->get();
                $gbalance = [];
                $gite = 0;
                foreach($grps as $group){
                    $balance = 0;
                    $lastbalance = 0;
                    foreach($group->accounts as $account){
                        foreach ($account->entries as $entry){
                            $balance= $lastbalance + floatval($entry->debit) - floatval($entry->credit);
                            $lastbalance = $balance;
                        }
                    }
                    $gbalance[$gite++] = $balance;
                }
?>

             <div class="inline-flex bg-white shadow-xl rounded-lg py-2 px-4">
                <table style="border-collapse: collapse;">
                        <thead>
                        <tr>
                            <th style="border-bottom:2pt solid black;">
                                <strong></strong>

                            </th>
                            <th style="border-bottom:2pt solid black;" align="centre">
                                <strong>Amount</strong>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                    @foreach ($grps as $group)
                            @if($gbalance[$loop->index]==0)
                            @continue
                            @endif
                    <tr>
                        <td >
                            {{$group->name}}
                        </td>
                        <td  align="right">
                            {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency($gbalance[$loop->index],'Rs.'))}}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

</x-app-layout>
