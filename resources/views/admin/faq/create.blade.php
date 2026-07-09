<x-app-layout>
    <div>

        <div>
            <h2>Nieuwe categorie</h2>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Categorienaam" value="{{ old('name') }}">
                <button type="submit">Toevoegen</button>
            </form>

            @error('name')
            <p>{{ $message }}</p>
            @enderror

            @if (session('success'))
                <p>{{ session('success') }}</p>
            @endif
        </div>


        <div>
            <h2>FAQ toevoegen</h2>

            <form action="{{ route('admin.faq.store') }}" method="POST">
                @csrf

                <div>
                    <label>Vraag</label>
                    <input type="text" name="question" value="{{ old('question') }}" required>
                    @error('question')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label>Antwoord</label>
                    <textarea name="answer" rows="4">{{ old('answer') }}</textarea>
                    @error('answer')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label>Categorie</label>
                    <select name="category_id">
                        <option value="">— Geen categorie —</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit">Opslaan</button>
            </form>
        </div>
    </div>
</x-app-layout>
