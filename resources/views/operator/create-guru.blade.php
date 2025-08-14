<h1>Tambah User Guru</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('operator.guru.store') }}" method="POST">
    @csrf
    <label>Nama:</label>
    <input type="text" name="name" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Password:</label>
    <input type="password" name="password" required><br><br>

    <label>Konfirmasi Password:</label>
    <input type="password" name="password_confirmation" required><br><br>

    <button type="submit">Simpan Guru</button>
</form>
