<!--give me code for about propety profile widget -->
<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        <form wire:submit="submit">
            {{$this->form}}

            <x-filament::modal icon="heroicon-o-question-mark-circle" alignment="center" id="confirm">
                <x-slot name="heading">
                    Jadi disimpan?
                </x-slot>
                <x-slot name="trigger">
                    <x-filament::button>
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

        </form>
    </x-filament::section>
</x-filament-widgets::widget>