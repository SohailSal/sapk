<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
        </h2>
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
                            First, create a Company.
                        </li>
                        <li>
                            Second, create Account Groups.
                        </li>
                        <li>
                            Then create some accounts.
                        </li>
                        <li>
                            Third, create Voucher Types as you desire.
                        </li>
                        <li>
                            Now, start entering Transactions.
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <form method="GET" action="{{ route('dashboard') }}">
                    @csrf
                    <div class="mb-1">
                        <label class="block text-white text-sm font-bold mb-2">Select Company:</label>
                        <select name="company" class="shadow w-52 py-1 px-3 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                            @foreach(\Auth::user()->companies as $company)
                                <option value='{{ $company->id }}' {{ ($company->id == session('company_id')) ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-jet-button type="submit">submit</x-jet-button>
                    </form>
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

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">


    <table width="100%" style="border-collapse: collapse;">
            <thead>
            <tr>
                <th style="width: 70%;border-bottom:2pt solid black;">
                    <strong></strong>

                </th>
                <th style="width: 15%;border-bottom:2pt solid black;" align="centre">
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
            <td style="width: 15%;">
                {{$group->name}}
            </td>
            <td style="width: 10%; border-left: 1pt solid black;" align="right">
                {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency($gbalance[$loop->index],'Rs.'))}}
            </td>
        </tr>
        @endforeach
        </tbody>

    </table>



                </div>
            </div>
        </div>

</x-app-layout>
