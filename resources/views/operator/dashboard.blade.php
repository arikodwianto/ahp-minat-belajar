<h1>Dashboard Operator</h1>
<p>Halo, {{ auth()->user()->name }}! Anda login sebagai Operator.</p>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" style="padding: 8px 16px; background-color: #f44336; color: white; border: none; cursor: pointer;">
        Logout
    </button>
</form>
