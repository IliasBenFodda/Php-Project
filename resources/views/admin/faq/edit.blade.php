<x-app-layout>
    <div>
        <h2>FAQ bewerken</h2>

        <form action="{{ route('admin.faq.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label>Vraag</label>
                <input
                    type="text"
                    name="question"
                    value="{{ old('question', $faq->question) }}"
                    required
                >

                @error('question')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label>Antwoord</label>

                <textarea name="answer" rows="4">{{ old('answer', $faq->answer) }}</textarea>

                @error('answer')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label>Categorie</label>

                <select name="category_id">
                    <option value="">— Geen categorie —</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $faq->category_id) == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit">
                Opslaan
            </button>
        </form>
    </div>
</x-app-layout>
