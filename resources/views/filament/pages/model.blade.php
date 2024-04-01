<x-filament-panels::page>
    <x-filament::modal width="7xl" :close-button="true" id="model" slide-over>
        <x-slot name="trigger">
            <x-filament::button wire:click="generateModel">
                Generate Model
            </x-filament::button>
        </x-slot>

        <x-slot name="heading">
            Model Preview Before Storing
        </x-slot>

        {{-- Modal content --}}
        @if (count($this->model))
            {{-- Normalized Pairwise Comparison --}}
            <div class="overflow-x-auto">
                <h2 class="text-xl font-black">Normalized Paiwise Comparison</h2>
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-1">#</th>
                            @foreach ($this->criterion as $criteria)
                                <th class="px-1">C:{{ $criteria }}</th>
                            @endforeach
                            <th class="px-1">Priority</th>
                            <th class="px-1">Line Quality</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->model[0]['pairwise_comparison_normalized'] as $key => $row)
                            <tr>
                                <td class="px-1 font-black">{{ $key }}</td>
                                @foreach ($row as $item)
                                    <td class="px-1">{{ $item }}</td>
                                @endforeach
                                <td class="px-1 font-black">{{ $this->model[0]['pairwise_comparison_priority'][$key] }}
                                </td>
                                <td class="px-1 font-black">
                                    {{ $this->model[0]['pairwise_comparison_line_quality'][$key] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Consistency Ratio --}}
            <div>
                @php
                    $cr = $this->model[0]['pairwise_comparison_consistency_ratio'];
                @endphp
                <h2 class="text-xl font-black">Consistency Ratio: {{ $cr }} @if ($cr <= 0.1)
                        (<span class="text-green-500">Consistent</span>)
                    @else(<span class="text-red-500">Inconsistent</span>)
                    @endif
                </h2>
                <small>Consistency Ratio must be below 0.1</small>
            </div>

            {{-- Criterion --}}
            <div class="overflow-x-auto">
                <h2 class="text-xl font-black">Criterion and Score Alternatives</h2>
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-1">Product</th>
                            @foreach ($this->criterion as $criteria)
                                <th class="px-1">C:{{ $criteria }}</th>
                            @endforeach
                            <th class="px-1">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->model as $model)
                            <tr>
                                <td class="px-1 whitespace-nowrap">
                                    {{ \App\Models\Product::find($model['product_id'])->name }}</td>
                                @foreach ($model['criterion'] as $key => $criteria)
                                    <td class="px-1">
                                        {{-- {{\App\Helper::formatAndTrimZeros($criteria, 3)}} --}}
                                        {{ $criteria }}
                                    </td>
                                @endforeach
                                <td class="px-1 font-black">{{ $model['total'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {{-- Modal content end --}}
        <x-filament::button class="ml-auto" wire:click='saveModel'>
            Save Model
        </x-filament::button>
    </x-filament::modal>

    {{-- @dd($this->getPreviousBatch()) --}}
    <div class="flex">
        <x-filament::button tag="a" :disabled="!$this->getPreviousBatch()" class="rounded-r-none w-[84px]"
            href="{{ route('filament.admin.pages.model', ['batch' => $this->getPreviousBatch()]) }}"
            {{-- @disabled($this->getBatch() == $this->getLimitBatch()) --}}>
            Previous
        </x-filament::button>
        <x-filament::input.wrapper class="w-max rounded-none">
            <x-filament::input.select onchange="" id="select-batch">
                @foreach ($this->getAllBatchs() as $value)
                    <option value="{{ $value }}" @selected($this->getBatch() == $value)>{{ $value }}</option>
                @endforeach
            </x-filament::input.select>
        </x-filament::input.wrapper>
        <x-filament::button tag="a" :disabled="!$this->getNextBatch()" class="rounded-l-none w-[84px]"
            href="{{ route('filament.admin.pages.model', ['batch' => $this->getNextBatch()]) }}">
            Next
        </x-filament::button>
    </div>
    @livewire(\App\Livewire\ModelList::class)
</x-filament-panels::page>


@script
<script>
    document.querySelector('select#select-batch').addEventListener('change', (e) => {
        window.location.href = window.location.href.split('?')[0] + `?query=${e.target.value}`
    })
</script>
@endscript
