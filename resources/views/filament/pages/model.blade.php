<x-filament-panels::page>
    <x-filament::modal width="7xl" :close-button="true" id="model">
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
            <div class="overflow-x-auto">
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
                                <td class="px-1">{{ \App\Models\Product::find($model['product_id'])->name }}</td>
                                @foreach ($model['criterion'] as $criteria)
                                    <td class="px-1">{{ $criteria }}</td>
                                @endforeach
                                <td class="px-1">{{ $model['total'] }}</td>
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

    {{-- @dd($this->getLimitBatch()) --}}
    <div>
        <x-filament::button tag="a"
            href="{{ route('filament.admin.pages.model', ['batch' => $this->getBatch() - 1]) }}"
            {{-- @disabled($this->getBatch() == $this->getLimitBatch()) --}}
            >
            Previous
        </x-filament::button>
        <x-filament::button tag="a"
            href="{{ route('filament.admin.pages.model', ['batch' => $this->getBatch() + 1]) }}">
            Next
        </x-filament::button>
    </div>
    @livewire(\App\Livewire\ModelList::class)
</x-filament-panels::page>
