<x-app-layout>
    <x-slot name="header">
        <div class="flex mx-auto items-center justify-between">
            <div class="inline-flex font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
            </div>
            <div class="inline-flex  bg-gray-600 rounded-lg">
                <form method="GET" action="{{ route('dashboard') }}">
                @csrf
                    <div class="inline-flex">
                        <select name="company" class="w-52 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                            @foreach(\Auth::user()->companies as $company)
                                <option value='{{ $company->id }}' {{ ($company->id == session('company_id')) ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="inline-flex">
                        <button class="bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline px-4 hover:text-blue-200" type="submit">Go</button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>


<div class="py-3 bg-gray-600">
    @if(Auth::user()->companies()->first())
        <div class="text-white px-8 py-2">Welcome, {{Auth::user()->name}}</div>
    @else
        <div class="text-white px-8 py-2">First <a href="{{url('company')}}">create a Company</a></div>
    @endif
    <div class="flex mx-auto">
        <div class="inline-flex py-2 px-4 bg-gray-800 m-4 rounded-lg shadow-lg overflow-hidden md:w-1/3 w-full">
            <ul class="list-disc ml-4 text-white">
                <li>
                    First, <a class="hover:text-blue-200" href="{{url('company')}}">create a Company</a>.
                </li>
                <table  class="border-white border-solid rounded-lg shadow-lg bg-gray-700">
                    <tr>
                        <td>
                        <li>
                            Second, <a class="hover:text-blue-200" href="{{url('group')}}">create Account Groups</a>.
                        </li>
                        <li>
                            Then <a class="hover:text-blue-200" href="{{url('account')}}">create some accounts</a>.
                        </li>
                        </td>
                        <td>
                        OR
                        </td>
                        <td>
                        Press "Generate Default accounts" button in Groups
                        </td>
                    </tr>
                </table>
                <li>
                    Third, <a class="hover:text-blue-200" href="{{url('doctype')}}">create Voucher Types</a> as you desire.
                </li>
                <li>
                    Now, <a class="hover:text-blue-200" href="{{url('doc')}}">start entering Transactions</a>.
                </li>
            </ul>
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

        <div class="inline-flex py-2 px-4 bg-gray-800 text-white m-4 rounded-lg shadow-lg overflow-hidden md:w-1/3 w-full">
            <table style="border-collapse: collapse;">
                    <thead>
                    <tr>
                        <th style="border-bottom:2pt solid white;">
                            <strong></strong>
                        </th>
                        <th style="border-bottom:2pt solid white;" align="centre">
                            <strong>Rupees</strong>
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
    </div>
</div>


</x-app-layout>
