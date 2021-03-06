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
                        <select name="company" class="w-52 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline" onchange="this.form.submit()">
                            @foreach(\Auth::user()->companies as $company)
                                <option value='{{ $company->id }}' {{ ($company->id == session('company_id')) ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
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

        <div class="flex mx-auto flex-col md:flex-row">

            <div class="inline-flex py-2 px-4 bg-gray-800 m-4 rounded-lg shadow-lg overflow-auto md:w-1/2 w-full">
                <ul class="list-disc ml-1 text-white ">
                    <li>
                        First, <a class="text-gray-400 hover:text-blue-200 " href="{{url('company')}}">create a Company</a>.
                    </li>
                    <table>
                        <tr>
                            <td  class="border-gray-600 border-2" width="40%">
                            <li>
                                Second, create Account Groups.
                            </li>
                            <li>
                                Then create some accounts.
                            </li>
                            </td>
                            <td class="px-4">
                            OR
                            </td>
                            <td class="border-gray-600 border-2">
                            Press "Auto Generate" button in Groups (This option is only available if no Account Groups have been created!)
                            </td>
                        </tr>
                    </table>
                    <li>
                        Third, create Voucher Types as you desire.
                    </li>
                    <li>
                        Now, start entering Transactions.
                    </li>
                </ul>
            </div>

            @if(session('company_id'))
            @can('isAdmin', App\Models\Company::where('id',session('company_id'))->first())
            <div class="inline-flex py-2 px-4 bg-gray-800 text-white m-4 rounded-lg shadow-lg overflow-auto md:w-1/2 w-full">
                <form method="GET" action="{{ route('dashboard') }}">
                    @csrf
                    <div class="flex-col m-2">
                        <h3>Assign usage rights to another user</h3>
                    </div>
                    <div class="flex-col m-2">
                        <label class="inline-flex text-white mb-2 w-20">Email:</label>
                        <input name="email" type="text" class="bg-gray-600 text-white rounded focus:outline-none focus:shadow-outline px-1 hover:text-blue-200 w-52" placeholder="Enter Email of User">
                    </div>
                    <div class="flex-col m-2">
                        <label class="inline-flex text-white mb-2 w-20">Company:</label>
                        <select name="comp" class=" w-52 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                            @foreach(\Auth::user()->companies as $company)
                                @foreach($company->settings as $setting)
                                    @if(($setting->key == 'role') && ($setting->value == 'admin')&& ($setting->user_id == Auth::user()->id))
                                        <option value='{{ $company->id }}' {{ ($company->id == session('company_id')) ? 'selected' : '' }}>{{ $company->name }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-col m-2">
                        <label class="inline-flex text-white mb-2 w-20">Role:</label>
                        <select name="role" class="w-52 bg-gray-600 text-white rounded leading-tight focus:outline-none focus:shadow-outline">
                            <option value='manager'>Manager</option>
                            <option value='user'>Read Only</option>
                        </select>
                    </div>
                    <div class="flex-col m-2">
                        <button class="flex-wrap mb-2 ml-20 px-4 py-1 rounded-lg bg-gray-600 text-white hover:bg-gray-700 focus:outline-none focus:shadow-outline" type="submit">Assign</button>
                    </div>
                </form>
            </div>
            @endcan
            @endif
        </div>


        <div class="flex mx-auto flex-col md:flex-row">
            @if(session('company_id'))
            @can('isAdmin', App\Models\Company::where('id',session('company_id'))->first())
            <div class="inline-flex py-2 px-4 bg-gray-800 text-white m-4 rounded-lg shadow-lg overflow-auto md:w-1/2 w-full">
            <livewire:years/>
            </div>
            @endcan
            @endif

            <?php
            $fmt = new NumberFormatter( 'en_GB', NumberFormatter::CURRENCY );
            $amt = new NumberFormatter( 'en_GB', NumberFormatter::SPELLOUT );
            $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
            $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
            if(session('company_id') && App\Models\Document::where('company_id',session('company_id'))->first()){

                $year =  \App\Models\Year::where('company_id',session('company_id'))->where('enabled',1)->first();
                $id4= \App\Models\AccountType::where('name','Revenue')->first()->id;
                $grps4 = \App\Models\AccountGroup::where('company_id',session('company_id'))->where('type_id',$id4)->get();
                $gbalance4 = [];
                $gite4 = 0;
                foreach($grps4 as $group){
                    $balance = 0;
                    $lastbalance = 0;
                    foreach($group->accounts as $account){

                        $entries = Illuminate\Support\Facades\DB::table('documents')
                            ->join('entries', 'documents.id', '=', 'entries.document_id')
                            ->whereDate('documents.date', '>=', $year->begin)
                            ->whereDate('documents.date', '<=', $year->end)
                            ->where('documents.company_id',session('company_id'))
                            ->where('entries.account_id','=',$account->id)
                            ->select('entries.debit', 'entries.credit')
                            ->get();

                        $cnt = count($entries);
                        foreach ($entries as $entry){
                            if((--$cnt <= 0) && ($year->closed)){
                                break;
                            }
                            $balance= $lastbalance + floatval($entry->debit) - floatval($entry->credit);
                            $lastbalance = $balance;
                        }
                    }
                    $gbalance4[$gite4++] = $balance;
                }


/*                $id= \App\Models\AccountType::where('name','Revenue')->first()->id;
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
*/


            }
            ?>
            @if(session('company_id') && App\Models\Document::where('company_id',session('company_id'))->first())
            <div class="inline-flex py-2 px-4 bg-gray-800 text-white m-4 rounded-lg shadow-lg overflow-auto md:w-1/2 w-full">
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
                    @foreach ($grps4 as $group)
                        @if($gbalance4[$loop->index]==0)
                        @continue
                        @endif
                        <tr>
                            <td >
                                {{$group->name}}
                            </td>
                            <td  align="right">
                                {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency(($gbalance4[$loop->index] * -1),'Rs.'))}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>

    </div>

</x-app-layout>
