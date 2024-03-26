<x-filament-panels::page>
    <x-filament::modal width="screen" :close-button="true">
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
                            <th class="px-3">Product</th>
                            @foreach ($this->criterion as $criteria)
                                <th class="px-3">C:{{ $criteria }}</th>
                            @endforeach
                            <th class="px-3">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->model as $model)
                            <tr>
                                <td class="px-3">{{ \App\Models\Product::find($model['product_id'])->name }}</td>
                                @foreach ($model['criterion'] as $criteria)
                                    <td class="px-3">{{$criteria}}</td>
                                @endforeach
                                <td class="px-3">{{$model['total']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {{-- Modal content end --}}
        <x-filament::button class="ml-auto">
            Save Model
        </x-filament::button>
    </x-filament::modal>


    @livewire(\App\Livewire\ModelList::class)
</x-filament-panels::page>
