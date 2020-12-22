<div class="fixed inset-0 z-10 bg-gray-500 bg-opacity-75 flex">
    <div class="flex mx-auto items-start mt-10 mb-10 overflow-auto">
      <div class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        <form>
        <div class="flex flex-col md:flex-row bg-gray-800">
            <div class="bg-gray-800 px-4 pt-2 pb-1">
              <div class="">
                    <div class="mb-1">
                    <label class="block text-white text-sm font-bold mb-2">Date Start:</label>
                      <span class="date" id="dstart">
                        <input type="text" id="istart" onkeydown="return allow(event)" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model.lazy="begin">
                      </span>
                    </div>
              </div>
            </div>
            <div class="bg-gray-800 px-4 pt-2 pb-1">
              <div class="">
                    <div class="mb-1">
                    <label class="block text-white text-sm font-bold mb-2">Date End:</label>
                      <span class="date" id="dend">
                        <input type="text" id="iend" onkeydown="return allow(event)" class="shadow appearance-none rounded w-52 py-1 px-3 bg-gray-600 text-white leading-tight focus:outline-none focus:shadow-outline" wire:model.lazy="end">
                      </span>
                    </div>
              </div>
            </div>
          </div>

          <div class="bg-gray-400 px-4 py-2 sm:px-6 sm:flex sm:flex-row rounded-b-lg">
            <div class="mt-1 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
              <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-green-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-600 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                Save
              </button>
            </div>
            <div class="mt-1 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
              <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-gray-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-gray-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                Cancel
              </button>
            </div>
          <span class="inline-flex text-white font-extrabold animate-pulse ml-6 mt-1">{{ $errors->first() }}</span>
          </div>
        </form>
      </div>
  </div>
  <script>
        
        $(document).ready(function() {

        <?php $year = \App\Models\Year::where('company_id',session('company_id'))->where('enabled',1)->first(); ?>
        var start = "<?php echo $year->begin; ?>";
        var end = "<?php echo $year->end; ?>";
        var startf = new Date(start);
        var endf = new Date(end);

            $('.date').datepicker({
                    autoclose: true,
                    format: "yyyy-mm-dd",
  //                  startDate: startf ,
  //                  endDate: endf ,
                    immediateUpdates: true,
                });

            $('#dstart').datepicker().on('change', function (e) {
                $('#istart').change(e);
            });

            $('#istart').change(function(e){
                $('#dstart').datepicker('hide');
                @this.set('begin', e.target.value);
            });

            $('#dend').datepicker().on('change', function (e) {
                $('#iend').change(e);
            });

            $('#iend').change(function(e){
                $('#dend').datepicker('hide');
                @this.set('end', e.target.value);
            });

        });

    </script>
</div>