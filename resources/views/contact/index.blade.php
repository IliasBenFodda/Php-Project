<form action="{{ route('contact.send') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Naam">
    <input type="email" name="email" placeholder="Email">
    <textarea name="message" placeholder="Bericht"></textarea>

    <button type="submit">Versturen</button>
</form>
