@if (auth('writer')->check())
    <a href={{ route('changepassword') }}>Change password</a>
    <h2>Writer Dashboard</h2>
    <table class="table-auto border-collapse border border-gray-400">
        <tr>
            <th class="border border-gray-400 px-4 py-2">Name</th>
            <td class="border border-gray-400 px-4 py-2">{{ auth('writer')->user()->name }}</td>
        </tr>
        <tr>
            <th class="border border-gray-400 px-4 py-2">Email</th>
            <td class="border border-gray-400 px-4 py-2">{{ auth('writer')->user()->email }}</td>
        </tr>
        <tr>
            <th class="border border-gray-400 px-4 py-2">Joined</th>
            <td class="border border-gray-400 px-4 py-2">{{ auth('writer')->user()->created_at->format('d M, Y') }}</td>
        </tr>
    </table>
@endif
<form action="{{ route('writer.logout') }}" method="post">
    @csrf
    @method('post')
    <button value="submit">logout</button>
</form>
