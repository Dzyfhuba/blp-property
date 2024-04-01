<x-filament-widgets::widget>
    <x-filament::section>
        <form id="pairwise-comparison" wire:submit="submit">
            <div class="overflow-x-auto scrollbar-hide pt-16 pr-1 !bg-transparent">
                <div class="grid grid-cols-{{ count($this->criterion) + 1 }} gap-1 min-w-[1000px]" {{-- x-data="{}"
                    x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('pairwise-comparison'))]" --}}>
                    <div></div>
                    @foreach ($this->criterion as $criteria)
                        <div class="-rotate-45 -translate-y-7">{{ $criteria }}</div>
                    @endforeach
                    @foreach ($this->criterion as $key1 => $criteriaVertical)
                        <div class="rotate-[30deg] flex justify-end -translate-y-4">{{ $criteriaVertical }}</div>
                        @foreach ($this->criterion as $key2 => $criteriaHorizontal)
                            <div>
                                {{-- @if ($key1 >= $key2)
                                <x-filament::input.wrapper class="h-full px-3 py-[6px]" disabled>
                                    {{ $this->pairwiseComparison->$criteriaVertical->$criteriaHorizontal }}
                                </x-filament::input.wrapper>
                                @else --}}
                                    <x-filament::input.wrapper
                                    disabled="{{ $key1 == $key2 }}"
                                    {{-- $this->pairwiseComparison->$criteriaVertical->$criteriaHorizontal < 1 --}}
                                    >
                                        <x-filament::input min="0" max="10" :name="$criteriaHorizontal . $criteriaVertical" :id="$criteriaHorizontal . $criteriaHorizontal . $criteriaVertical"
                                            wire:model.live.number.debounce="pairwiseComparison.{{ $criteriaVertical }}.{{ $criteriaHorizontal }}"
                                            :criteria1="$criteriaVertical" :criteria2="$criteriaHorizontal"
                                            {{-- :readonly="$key1 >= $key2"  --}}
                                            :readonly="$key1 == $key2"
                                            />
                                    </x-filament::input.wrapper>
                                {{-- @endif --}}
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <x-filament::button type="submit">
                Save
            </x-filament::button>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
