<x-app-layout>
    <div class="mx-auto max-w-2xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="rounded-xl bg-white p-6 shadow-md sm:p-8">
            <h1 class="mb-6 text-2xl font-bold text-gray-900">
                Neem contact op
            </h1>

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="mb-2 block text-sm font-medium text-gray-700">
                        Naam
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="naam"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                    >
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="je@email.nl"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                    >
                </div>

                <div>
                    <label for="message" class="mb-2 block text-sm font-medium text-gray-700">
                        Bericht
                    </label>
                    <textarea
                        id="message"
                        name="message"
                        rows="5"
                        placeholder="Typ hier je bericht..."
                        class="w-full resize-y rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                    ></textarea>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-lg bg-indigo-600 px-5 py-2.5 font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Versturen
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
