<x-filament-widgets::widget>
    <x-filament::section
    collapsible
    collapsed
    persist-collapsed
    id="weight-product-criterion"
    >
        <x-slot name="heading">
            Bobot setiap kriteria produk
        </x-slot>

        {{-- Widget content --}}
        <form wire:submit="submit">
            {{$this->form}}

            <x-filament::modal icon="heroicon-o-question-mark-circle" alignment="center" id="confirm">
                <x-slot name="heading">
                    Jadi disimpan?
                </x-slot>
                <x-slot name="trigger">
                    <x-filament::button class="mt-3">
                        Save
                    </x-filament::button>
                </x-slot>

                {{-- Modal content --}}
                <div class="flex gap-3">
                    <x-filament::button wire:click="closeModal" color="gray">
                        Cancel
                    </x-filament::button>
                    <x-filament::button type="submit" class="grow">
                        Save
                    </x-filament::button>
                </div>
            </x-filament::modal>
            <span>Total weight: {{$this->total()}}</span>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
