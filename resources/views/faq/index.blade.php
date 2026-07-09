<x-app-layout>
    @foreach ($categories as $category)
        <div class="mb-8">

            @auth
                @if(auth()->user()->isAdmin())
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold text-blue-600">
                            {{ $category->name }}
                        </h2>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <h2 class="text-xl font-semibold text-blue-600 mb-4">
                        {{ $category->name }}
                    </h2>
                @endif
            @endauth

            @guest
                <h2 class="text-xl font-semibold text-blue-600 mb-4">
                    {{ $category->name }}
                </h2>
            @endguest

            @forelse ($category->faqs as $faq)
                <div class="bg-white rounded-lg border p-4 mb-3">

                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="flex gap-6 justify-end">
                                <a href="{{ route('admin.faq.edit', $faq->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth

                    <p class="font-semibold text-gray-800">{{ $faq->question }}</p>

                    @if ($faq->answer)
                        <p class="text-gray-600 mt-2">{{ $faq->answer }}</p>
                    @else
                        <p class="text-gray-400 mt-2 italic">Nog geen antwoord.</p>
                    @endif
                </div>
            @empty
                <p class="text-gray-400 italic">Geen vragen in deze categorie.</p>
            @endforelse

        </div>
    @endforeach
</x-app-layout>
