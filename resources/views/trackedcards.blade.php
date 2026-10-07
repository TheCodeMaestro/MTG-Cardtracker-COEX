<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tracked Cards') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-1xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6">
                @if ($trackedCards->isEmpty())
                    <p class="text-gray-500">You have no tracked cards.</p>
                @else
                    <div class="flex flex-wrap justify-center gap-6">
                        @foreach ($trackedCards as $trackedCard)
                            @php
                                $card = $trackedCard->card;
                            @endphp
                            <div class="card bg-gray-800 shadow-md hover:shadow-xl transition-shadow w-fit rounded-xl text-center">
                                <div class="card-body p-3 text-gray-300">
                                    <h2 class="card-title text-lg">{{ $card->card_name }}</h2>
                                    <p class="text-sm text-gray-500">{{ $card->set_name }}</p>
                                    <div class="p-2">
                                        <img src="{{ $card->normal_image_url }}" alt="{{ $card->card_name }}" class="w-[292px] h-[408px] rounded-2xl">
                                    </div>
                                    <div class="mt-2 text-sm">
                                        <div>USD: ${{ $card->usd_price }} - EUR: €{{ $card->eur_price }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
